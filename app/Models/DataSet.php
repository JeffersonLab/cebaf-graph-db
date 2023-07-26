<?php

namespace App\Models;

use App\Exceptions\StorageException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Jlab\LaravelUtilities\BaseModel;
use ZipArchive;

class DataSet extends BaseModel
{
    //TODO create a zip file containing data items
    use HasFactory;

    public $guarded = ['id'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'NEW',
        'interval' => '1h',
        'mya_deployment' => 'history',
    ];

    public static $rules = [
        'status' => 'required | inConfig:settings.data_set_statuses',
        'mya_deployment' => 'required | inConfig:settings.mya_deployments',
        'begin_at' => 'required | date',
        'ends_at' => 'nullable | date',
        'comments' => 'required',
    ];

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    public function config()
    {
        return $this->BelongsTo(Config::class);
    }

    public function exportToStorage($path = null): void
    {
        $path = $path ?: $this->exportPath();
        foreach ($this->data as $datum) {
            if (! $datum->exportToStorage($path)) {
                throw new StorageException('Failed to export Data ID '.$datum->id);
            }
        }
    }

    public function deleteFromStorage($path = null): void
    {
        $path = $path ?: $this->exportPath();
        foreach ($this->data as $datum) {
            if (! $datum->deleteFromStorage($path)) {
                throw new StorageException('Failed to delete Data ID '.$datum->id);
            }
        }
    }

    public function publicZipFile(): string
    {
        return "data-set-{$this->id}.zip";
    }

    /**
     * Write the DataSet to storage and then make a zip file of the Data Set at the specified file location.
     *
     * @throws StorageException
     */
    public function makeZipFileFromStorage($file): string
    {
        // Do an export to disk storage
        $this->exportToStorage();
        $zipArchive = new ZipArchive();
        if ($zipArchive->open($file, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new StorageException("Unable to write zip file.  Verify path and file permissions are correct.\n");
        }
        $options = ['add_path' => ' ', 'remove_all_path' => true];
        $zipArchive->addGlob(Storage::path($this->exportPath()).'/*.{pkl,json}', GLOB_BRACE, $options);
        $zipArchive->close();

        return $file;
    }

    /**
     * Write the contents of the collection of Data objects to the specified zip file.
     *
     * @throws StorageException
     */
    public function makeZipFileFromCollection(string $file, Collection $data): string
    {
        $zipArchive = new ZipArchive();
        if ($zipArchive->open($file, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new StorageException("Unable to write zip file.  Verify path and file permissions are correct.\n");
        }
        // @var $datum Data
        foreach ($data as $datum) {
            // Must "uncast" globals back to json rather than array.
            $zipArchive->addFromString($datum->exportGlobalsFileName(), json_encode($datum->globals));
            $zipArchive->addFromString($datum->exportGraphFileName(), $datum->graph);
        }
        $zipArchive->close();

        return $file;
    }

    /**
     * Make a zip file in the public storage directory containing full data set.
     *
     * @throws StorageException
     */
    public function makePublicZipFile(): string
    {
        $file = Storage::path('public').DIRECTORY_SEPARATOR.$this->publicZipFile();

        return $this->makeZipFileFromCollection($file, $this->data()->get());
    }

    public function exportPath(): string
    {
        return config('settings.data_sets_export_dir', 'data-sets').DIRECTORY_SEPARATOR.$this->id;
    }
}
