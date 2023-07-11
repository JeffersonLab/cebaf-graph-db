<?php

namespace App\Models;

use App\Exceptions\LoadsFileException;
use App\Traits\LoadsFile;
use Illuminate\Support\Facades\DB;

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
     * store the data set and its data.
     *
     * @throws \Throwable
     */
    public function store(string $comment = null, $label=null): DataSet{
        $dataSet = new DataSet(['comments' => $comment, 'begin_at'=>'2021-09-05']);
        $dataSet->config()->associate(Config::create(['yaml' => file_get_contents($this->configFile())]));
        DB::beginTransaction();
        try{
            if ($dataSet->save()){
                $this->storeData($dataSet, $label);
            }else{
                dd($dataSet->errors());
            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return $dataSet->fresh();
    }



    /**
     * Get the list of data directories within the data set directory.
     */
    public function dataDirs(): array{
        return glob($this->path . DIRECTORY_SEPARATOR . '*_*');  // expect yyyymmdd_hhiiss
    }

    /**
     * Store the data that comprise the data set.
     *
     * @param DataSet $dataSet
     * @return void
     * @throws LoadsFileException
     * @throws \Throwable
     */
    public function storeData(DataSet $dataSet, $label = null): void{
        foreach ( $this->dataDirs() as $path) {
            $loader = new DataLoader($path, $dataSet);
            $loader->store($label);
        }
    }

    /**
     * Store the data that comprise the data set.
     *
     * @param DataSet $dataSet
     * @return void
     * @throws LoadsFileException
     * @throws \Throwable
     */
    public function replaceData(DataSet $dataSet, $label = null): void{
        foreach ( $this->dataDirs() as $path) {
            $loader = new DataLoader($path, $dataSet);
            $loader->replace($label);
        }
    }


}
