<div class="form-group">
    <label for="interval">Name:</label>
    @error('name')
    <div class="tw-text-red-600"> {{ $message }}</div> @enderror
    <input type="text" id="interval" wire:model.defer="name" class="tw-shadow-sm sm:tw-rounded-lg"/>
    <small class="form-text text-muted">
        (required) A name that identifies the data set in lists
    </small>
</div>
