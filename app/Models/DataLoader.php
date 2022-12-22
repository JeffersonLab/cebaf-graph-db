<?php

namespace App\Models;

use App\Exceptions\LoadsFileException;
use Carbon\Carbon;
use Dflydev\DotAccessData\Exception\DataException;


class DataLoader
{
    use LoadsFile;

    public $dataSet;

    /**
     * Construct an instance.
     *
     * @param string $path
     * @throws LoadsFileException
     */
    public function __construct(string $path, DataSet $dataSet){
        $this->path = $path;
        $this->dataSet = $dataSet;

        $this->assertPathIsReadable();
        $this->assertPathHasFile($this->graphFile());
    }

    /**
     * Path to the config file.
     */
    public function graphFile() : string{
        return $this->path . DIRECTORY_SEPARATOR .config('ced2graph.graph_file');
    }


    /**
     * @throws \Throwable
     */
    public function store(string $label = null): Data{
        $data = new Data(['data_set_id' => $this->dataSet->id, 'label' => $label]);
        $data->setAttribute('timestamp', $this->timestampFromPath());
        $data->setAttribute('graph', file_get_contents($this->graphFile()));
        $data->saveOrFail();
        return $data->fresh();
    }

    public function timestampFromPath(){
        $path = basename($this->path);
        if (preg_match('/^(\d\d\d\d)(\d\d)(\d\d)_(\d\d)(\d\d)(\d\d)$/', $path, $m)){
            return Carbon::create($m[1],$m[2],$m[3],$m[4],$m[5],$m[6]);
        }
        throw new DataException('Graph data directory name not in expected YYYYMMDD_HHMMSS');
    }


}
