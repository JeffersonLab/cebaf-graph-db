<?php

namespace App\Livewire;

use App\Models\Config as DataSetConfig;
use App\Models\DataSet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class DataSetForm extends Component
{
    use AuthorizesRequests;

    // DB attributes snake case per convention
    public $data_set_id;
    public $status;
    public $name;
    public $begin_at;
    public $label;
    public $end_at;
    public $interval;
    public $mya_deployment;
    public $config_id;
    public $comments;

    // Component state variables camelCase
    public $useExistingConfig = true;
    public $existingConfigs;

    public $rules = [];

    public function mount(DataSet $dataSet=null){
        $this->rules = DataSet::$rules;

        if ($dataSet){
            $this->data_set_id = $dataSet->id;
        }else{
            $dataSet = DataSet::make();
        }
        $this->fill($dataSet->getAttributes());

        $this->existingConfigs = DataSetConfig::all()->sortBy('id')->pluck('name','id');

    }

    public function render()
    {
        return view('livewire.data-set-form');
    }

    public function save()
    {
        $this->validate(DataSet::$rules);

        if ($this->data_set_id){
            $dataSet = DataSet::find($this->data_set_id);
            $this->authorize('edit-data-set', $dataSet);
        }else{
            $this->authorize('create-data-set');
            $dataSet = DataSet::make();
        }
        $dataSet->fill($this->all());
        if (! $dataSet->save()){
           dd($dataSet->errors());
        }

        $this->redirect(route('data-sets.show', $dataSet->id));

    }
}
