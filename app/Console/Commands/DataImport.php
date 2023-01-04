<?php

namespace App\Console\Commands;

use App\Models\DataSetLoader;
use Illuminate\Console\Command;

class DataImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a set of graph data into the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $loader = new DataSetLoader('./tests/data/20221221_092324');
            $this->line($loader->configFile());
            $dataSet = $loader->store();
            $this->line('Saved data as number ' . $dataSet->id);
        }catch (\Exception $e){
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;

    }
}
