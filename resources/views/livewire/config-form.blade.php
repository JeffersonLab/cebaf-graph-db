<div>
    <form wire:submit.prevent="save" class="p-4">
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
                      class="language-yaml tw-w-[40em] tw-h-[40em] tw-shadow-sm sm:tw-rounded-lg">
            </textarea>
        </div>

        <button class="btn btn-lg btn-primary text-white bg-primary " type="submit">Submit</button>

    </form>

    @push('css')
        <link rel="stylesheet" href="{{ URL::asset('css/prism.css') }}" />
    @endpush

    @push('js')
        <script src="{{URL::asset('js/prism.js')}}" />
    @endpush

</div>
