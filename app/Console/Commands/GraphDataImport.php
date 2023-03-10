<?php

namespace App\Console\Commands;

use App\Models\DataSetLoader;
use Illuminate\Console\Command;

class GraphDataImport extends Command
{
    /**
     * The name and signature of the console command.
     * TODO option to append to existing data set id
     * @var string
     */
    protected $signature = 'graph-data:import
                            {directory  : directory of ced2graph output}
                            {--comment= : comment to annotate the data set}
                            {--label=   : label to apply to data set items}';

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
            $loader = new DataSetLoader( $this->argument('directory'));
            $dataSet = $loader->store($this->option('comment'), $this->option('label'));
            $this->line('Saved as data set number ' . $dataSet->id);
        }catch (\Exception $e){
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}
