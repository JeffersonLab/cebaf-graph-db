<div class="form-group">
    <label for="comments">Comments:</label>
    @error('comments')
    <div class="tw-text-red-600"> {{ $message }}</div> @enderror
    <small class="form-text text-muted">
        (Optional) Comments further explaining the content or purpose.
    </small>
    <textarea type="text" wire:model="comments" class="tw-w-[40em] tw-shadow-sm sm:tw-rounded-lg"></textarea>
</div>
