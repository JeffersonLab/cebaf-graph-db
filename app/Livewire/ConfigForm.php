<?php

namespace App\Livewire;

use App\Models\Config;
use Livewire\Component;

class ConfigForm extends Component
{

    public $name;
    public $comments;
    public $yaml;

    public $rules = [];

    public function mount()
    {
        $this->rules = Config::$rules;
    }

    public function render()
    {
        return view('livewire.config-form');
    }

    public function save()
    {
        // Instantiate a config object in order to obtain the validation rules array
        // that includes closure-based yaml validation which couldn't be placed into
        // the rules property which livewire sends to client as json.
        $rules = (Config::make())->rules();
        $this->validate($rules);
        Config::create(
            $this->all()
        );

        $this->redirect('/configs');
    }
}
