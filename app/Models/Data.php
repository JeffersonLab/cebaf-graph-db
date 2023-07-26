<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Data extends Model
{
    //TODO save graph and globals to correctly named files
    use HasFactory;

    public $timestamps = false;

    public $dates = ['timestamp'];

    public $fillable = ['timestamp', 'data_set_id', 'label', 'graph', 'globals'];

    protected $casts = [
        'globals' => 'array',
    ];

    public function dataSet()
    {
        return $this->belongsTo(DataSet::class);
    }

    public function exportToStorage($path = null): bool
    {
        $path = $path ?: $this->dataSet->exportPath();

        return $this->exportGraphToStorage($path) && $this->exportGlobalsToStorage($path);
    }

    public function deleteFromStorage($path = null): bool
    {
        $path = $path ?: $this->dataSet->exportPath();

        return $this->deleteGraphFromStorage($path) && $this->deleteGobalsFromStorage($path);
    }

    public function deleteGraphFromStorage($path): bool
    {
        return Storage::delete($path.DIRECTORY_SEPARATOR.$this->exportGraphFileName());
    }

    public function deleteGobalsFromStorage($path): bool
    {
        return Storage::delete($path.DIRECTORY_SEPARATOR.$this->exportGlobalsFileName());
    }

    public function exportGraphToStorage($path): bool
    {
        return Storage::put($path.DIRECTORY_SEPARATOR.$this->exportGraphFileName(), $this->graph);
    }

    public function exportGlobalsToStorage($path): bool
    {
        return Storage::put($path.DIRECTORY_SEPARATOR.$this->exportGlobalsFileName(), json_encode($this->globals));
    }

    public function exportGlobalsFileName()
    {
        return $this->exportBaseFileName().'_'.config('ced2graph.globals_file');
    }

    public function exportGraphFileName()
    {
        return $this->exportBaseFileName().'_'.config('ced2graph.graph_file');
    }

    protected function exportBaseFileName()
    {
        return $this->id.'_'.$this->timestamp->format('Ymd_His');
    }
}
