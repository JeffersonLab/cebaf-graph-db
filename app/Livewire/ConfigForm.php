<?php

namespace App\Livewire;

use App\Models\Config;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ConfigForm extends Component
{

    use AuthorizesRequests;

    /**
     * @var Config
     */
    public $config_id;  // plain $id is reserved by livewire
    public $name;
    public $yaml;
    public $comments;

    public $config;

    public function mount(Config $config=null)
    {
        if ($config){
            $this->fill($config->getAttributes());
            $this->config_id = $config->id;
            $this->config = $config;
        }else{
            $this->config = Config::make();
        }
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

        // Update existing config
        if ($this->config_id){
            $config = Config::find($this->config_id);
            $this->authorize('edit-config', $config);
            $config->fill($this->all());
        }else{
            $this->authorize('create-config');
            $config = Config::create($this->all());
        }
        if (! $config->save()){
            throw new ValidationException('Failed to save configuration');
        }

        $this->redirect(route('configs.index'));
    }
}
