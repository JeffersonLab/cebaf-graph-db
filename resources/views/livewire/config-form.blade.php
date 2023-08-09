<div>
    <form wire:submit.prevent="save" class="p-4">
        @if($config_id)
            <input type="hidden" name="config_id" wire:model="{{$config_id}}">
        @endif
        <x-forms.name-field/>
        <x-forms.comments-field/>
        <div class="form-group">
            <label for="yaml">YAML:</label>
            @error('yaml')
            <div class="tw-text-red-600"> {{ $message }}</div> @enderror
            <small class="form-text text-muted">
                (Required) Paste Yaml file contents here
            </small>
            <textarea type="text" wire:model="yaml"
                      class="language-yaml tw-w-[60em] tw-h-[40em] tw-shadow-sm sm:tw-rounded-lg">
            </textarea>
        </div>

        <button class="btn btn-lg btn-primary text-white bg-primary " type="submit">Submit</button>

    </form>

</div>
