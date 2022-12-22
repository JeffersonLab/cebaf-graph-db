<?php

namespace App\Models;

use App\Exceptions\LoadsFileException;

/**
 *  Class to load a data set produced by ced2graph into the database.
 *
 * The data set to be loaded must be in the non-tree format described in the Data Directory Structure section of
 * https://github.com/JeffersonLab/ced2graph with a config.yaml file at the top level and a set of directories
 * with date and time derived names each containing a graph.pkl file.
 */
class DataSetLoader
{
    use LoadsFile;

    /**
     * Construct an instance.
     *
     * @param string $path
     * @throws LoadsFileException
     */
    public function __construct(string $path){
        $this->path = $path;
        $this->assertPathIsReadable();
        $this->assertPathHasFile($this->configFile());
    }


    /**
     * Path to the config file.
     */
    public function configFile() : string{
        return $this->path . DIRECTORY_SEPARATOR .config('ced2graph.config_file');
    }

    /**
     * @throws \Throwable
     */
    public function store(string $comment = null): DataSet{
        $dataSet = new DataSet(['comment' => $comment]);
        $dataSet->setAttribute('config', file_get_contents($this->configFile()));
        $dataSet->saveOrFail();

        return $dataSet->fresh();
    }

}
