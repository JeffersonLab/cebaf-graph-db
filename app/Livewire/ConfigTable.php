<?php

namespace App\Livewire;

use App\Models\Config;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ConfigTable extends DataTableComponent
{
    protected $model = Config::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setPerPageVisibilityDisabled()
            ->setSearchDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('Name', 'name')
                ->sortable(),
            Column::make('Created', 'created_at')
                ->sortable(),
            Column::make('Updated', 'updated_at')
                ->sortable(),
        ];
    }
}
