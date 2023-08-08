<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DataSet;

class DataSetTable extends DataTableComponent
{
    protected $model = DataSet::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('data-sets.show', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Created", "created_at")
                ->sortable(),
            Column::make("Updated", "updated_at")
                ->sortable(),
        ];
    }
}
