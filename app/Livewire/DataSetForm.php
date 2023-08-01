<?php

namespace App\Livewire;

use App\Models\Config as DataSetConfig;
use Illuminate\Validation\Validator;
use App\Models\DataSet;
use Livewire\Component;

class DataSetForm extends Component
{

    // DB attributes snake case per convention
    public $status;
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


    public function mount(){
        $this->rules = DataSet::$rules;
        $dataSet = DataSet::make();
        $this->status = $dataSet->status;
        $this->interval = $dataSet->interval;
        $this->mya_deployment = $dataSet->mya_deployment;
        $this->existingConfigs = DataSetConfig::all()->sortBy('id')->pluck('comments','id');
    }

    public function render()
    {
        return view('livewire.data-set-form');
    }

    public function save()
    {
        $validated = $this->validate(DataSet::$rules);

        DataSet::create(
            $validated
        );

        return $this->redirect('/data-sets');
    }
}
