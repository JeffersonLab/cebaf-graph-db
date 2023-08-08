<?php

namespace App\Console\Commands;

use App\Models\DataSetLoader;
use Illuminate\Console\Command;

class GraphDataImport extends Command
{
    /**
     * The name and signature of the console command.
     * TODO option to append to existing data set id
     *
     * @var string
     */
    protected $signature = 'graph-data:import
                            {directory  : directory of ced2graph output}
                            {--name= : name to identify the data set}
                            {--comments= : comments about the data set}
                            {--label=   : label to apply to data set items}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a set of graph data into the database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $loader = new DataSetLoader($this->argument('directory'));
            $dataSet = $loader->store(
                $this->option('name'),
                $this->option('comments'),
                $this->option('label')
            );
            $this->line('Saved as data set number '.$dataSet->id);
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
