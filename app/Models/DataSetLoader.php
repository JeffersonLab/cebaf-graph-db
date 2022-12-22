<?php

namespace App\Models;

/**
 *  Class to load a data set produced by ced2graph into the database.
 *
 * The data set to be loaded must be in the non-tree format described in the Data Directory Structure section of
 * https://github.com/JeffersonLab/ced2graph with a config.yaml file at the top level and a set of directories
 * with date and time derived names each containing a graph.pkl file.
 */
class DataSetLoader
{
    /**
     * The directory containing the data set.
     * @var string
     */
    protected $path;

    /**
     * Construct an instance.
     *
     * @param string $path
     */
    public function __construct(string $path){
        $this->path = $path;
        $this->assertPathIsReadable();
    }

    /**
     * @param string $path
     * @return void
     * @throws \Exception
     */
    protected function assertPathIsReadable(){
        if (! (is_dir($this->path) && is_readable($this->path))){
            throw new \Exception('Path to data set does not exist or is not readable.');
        }
    }

    protected function assertPathContainsConfigFile(){

    }

}
