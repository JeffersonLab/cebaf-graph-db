<?php

namespace App\Models;

use App\Exceptions\DataExportException;
use App\Exceptions\StorageException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DataSet extends Model
{
    //TODO create a zip file containing data items
    use HasFactory;

    public $fillable = ['config', 'comment'];

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    public function exportToStorage($path = null): void
    {
        $path = $path ?: $this->exportPath();
        foreach ($this->data as $datum) {
            if (!$datum->exportToStorage($path)) {
                throw new StorageException('Failed to export Data ID ' . $datum->id);
            }
        }
    }

    public function deleteFromStorage($path = null): void
    {
        $path = $path ?: $this->exportPath();
        foreach ($this->data as $datum) {
            if (!$datum->deleteFromStorage($path)) {
                throw new StorageException('Failed to delete Data ID ' . $datum->id);
            }
        }
    }

    public function publicZipFile(): string
    {
        return Storage::path('public') . DIRECTORY_SEPARATOR . "data-set-{$this->id}.zip";
    }

    /**
     * Write the DataSet to storage and then make a zip file of the Data Set at the specified file location.
     * @throws StorageException
     */
    public function makeZipFileFromStorage($file): string
    {
        // Do an export to disk storage
        $this->exportToStorage();
        $zipArchive = new ZipArchive();
        if ($zipArchive->open($file, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            throw new StorageException("Unable to write zip file.  Verify path and file permissions are correct.\n");
        }
        $options = ['add_path' => ' ', 'remove_all_path' => TRUE];
        $zipArchive->addGlob(Storage::path($this->exportPath()) . "/*.{pkl,json}", GLOB_BRACE, $options);
        $zipArchive->close();
        return $file;
    }

    /**
     * Write the contents of the collection of Data objects to the specified zip file.
     *
     * @param string $file
     * @param Collection $data
     * @return string
     * @throws StorageException
     */
    public function makeZipFileFromCollection(string $file, Collection $data): string
    {
        $zipArchive = new ZipArchive();
        var_dump($file);
        if ($zipArchive->open($file, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            throw new StorageException("Unable to write zip file.  Verify path and file permissions are correct.\n");
        }
        // @var $datum Data
        foreach ($data as $datum){
            // Must "uncast" globals back to json rather than array.
            $zipArchive->addFromString($datum->exportGlobalsFileName(), json_encode($datum->globals));
            $zipArchive->addFromString($datum->exportGraphFileName(), $datum->graph);
        }
        $zipArchive->close();
        return $file;
    }

    /**
     * Make a zip file in the public storage directory containing full data set.
     * @throws StorageException
     */
    public function makePublicZipFile(): string
    {
        return $this->makeZipFileFromCollection($this->publicZipFile(), $this->data()->get());
    }

    public function exportPath(): string
    {
        return config('settings.data_sets_export_dir', 'data-sets') . DIRECTORY_SEPARATOR . $this->id;
    }
}
