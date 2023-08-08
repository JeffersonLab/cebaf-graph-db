<div>
    <form wire:submit.prevent="save" class="p-4">

        <div class="form form-group">
            <label for="status">Status:</label>
            @error('status')
            <div class="tw-tw-text-red-600"> {{ $message }}</div> @enderror
            <input type="text" id="status" wire:model.defer="status" readonly
                   class="tw-bg-gray-100 tw-tw-shadow-sm sm:tw-rounded-lg"/>
        </div>

        <div class="form-group">
            <label for="config_id">Existing Configuration:</label>
            @error('config_id')
            <div class="tw-text-red-600"> {{ $message }}</div> @enderror
            <select id="config_id" wire:model.defer="config_id" class="tw-shadow-sm sm:tw-rounded-lg w-auto">
                <option value="">choose..</option>
                @foreach ($existingConfigs as $option => $label)
                    <option value="{{ $option }}">{{$option}} - {{ $label }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">
                (Required) Mya Deployment to use (Ops = recent, History = old)
            </small>
        </div>

        <x-forms.name-field />


        <div class="form-group">
            <label for="interval">Interval:</label>
            @error('interval')
            <div class="tw-text-red-600"> {{ $message }}</div> @enderror
            <input type="text" id="interval" wire:model.defer="interval" class="tw-shadow-sm sm:tw-rounded-lg"/>
            <small class="form-text text-muted">
                (required) An interval string understood by mya (ex: 1h, 5m, 2d, etc.)
            </small>
        </div>

        <div class="form-group">
            <label for="mya-deployment">Mya Deployment:</label>
            @error('mya_deployment')
            <div class="tw-text-red-600"> {{ $message }}</div> @enderror
            <select id="mya-deployment" wire:model.defer="mya_deployment" class="tw-shadow-sm sm:tw-rounded-lg w-32">
                @foreach (config('settings.mya_deployments') as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">
                (Required) Mya Depolyment to use (Ops = recent, History = old)
            </small>
        </div>


        <div class="form-group">
            <label for="begin_at">Begin At:</label>
            @error('begin_at')
            <div class="tw-text-red-600"> {{ $message }}</div> @enderror
            <input id="begin_at" type="text" class="datepicker tw-shadow-sm sm:tw-rounded-lg tw-w-32 tw-mr-10"
                   wire:model.defer="begin_at"/>
            <small class="form-text text-muted">
                (Required) Data collection begin date
            </small>
        </div>

        <div class="form-group">
            <label for="end_at">End At:</label>
            @error('end_at')
            <div class="tw-text-red-600"> {{ $message }}</div> @enderror
            <input id="end_at" type="text" class="datepicker tw-shadow-sm sm:tw-rounded-lg tw-w-32"
                   wire:model="end_at"/>
            <small class="form-text text-muted">
                (Optional) Data collection end date. Leave blank for ongoing.
            </small>
        </div>


        <x-forms.comments-field />

        <button class="btn btn-lg btn-primary text-white bg-primary " type="submit">Submit</button>

    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#begin_at", {
                enableTime: false,
                dateFormat: "Y-m-d",
                onChange: function (selectedDates, dateStr, instance) {
                    @this.set('begin_at', dateStr);
                },
            });
            flatpickr("#end_at", {
                enableTime: false,
                dateFormat: "Y-m-d",
                onChange: function (selectedDates, dateStr, instance) {
                    @this.set('end_at', dateStr);
                },
            });
        }, false);

    </script>
</div>




