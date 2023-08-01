<?php

namespace App\Console\Commands;

use App\Models\DataSet;
use Illuminate\Console\Command;

class GraphDataListSets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'graph-data:list-sets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List the stored data sets and their ID numbers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->table(
            ['ID', 'Created', 'Comment'],
            DataSet::all(['id', 'created_at', 'comments'])->toArray()
        );

        return Command::SUCCESS;
    }
}
