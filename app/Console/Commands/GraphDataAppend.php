<?php

namespace App\Console\Commands;

use App\Models\DataSet;
use App\Models\DataSetLoader;
use Illuminate\Console\Command;

class GraphDataAppend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph-data:append
                            {id         : id number of data being appended}
                            {directory  : directory of ced2graph output}
                            {--replace  : replace existing data at conflicting timestamps}
                            {--label=   : label to apply to data set items}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Append new graph data to an existing data set';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $loader = new DataSetLoader($this->argument('directory'));
            $dataSet = DataSet::findOrFail($this->argument('id'));
            if ($this->option('replace')) {
                $loader->replaceData($dataSet, $this->option('label'));
            } else {
                $loader->storeData($dataSet, $this->option('label'));
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    protected function dataDirs($path): array
    {
        return glob($path.DIRECTORY_SEPARATOR.'*_*');  // expect yyyymmdd_hhiiss
    }
}
