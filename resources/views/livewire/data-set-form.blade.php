<div>
    <div class="card mt-4 w-3/4 ml-auto mr-auto">

        <div class="card-header">
            <h1 class="m-auto">Create New Data Set</h1>
        </div>


        <form wire:submit="save" class="p-4">

            <div class="form form-group">
                <label for="status">Status:</label>
                @error('status')<div class="text-red-600"> {{ $message }}</div> @enderror
                <input type="text" id="status" wire:model.defer="status" readonly class="bg-gray-100 shadow-sm sm:rounded-lg"/>
            </div>

            <div class="form-group">
                <label for="config_id">Existing Configuration:</label>
                @error('config_id')<div class="text-red-600"> {{ $message }}</div> @enderror
                <select id="config_id" wire:model.defer="config_id" class="shadow-sm sm:rounded-lg w-auto">
                    <option value="">choose..</option>
                    @foreach ($existingConfigs as $option => $label)
                        <option value="{{ $option }}">{{$option}} - {{ $label }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">
                    (Required) Mya Depolyment to use (Ops = recent, History = old)
                </small>
            </div>

            <div class="form-group">
                <label for="interval">Interval:</label>
                @error('interval')<div class="text-red-600"> {{ $message }}</div> @enderror
                <input type="text" id="interval" wire:model.defer="interval" class="shadow-sm sm:rounded-lg"/>
                <small  class="form-text text-muted">
                    (required) An interval string understood by mya (ex: 1h, 5m, 2d, etc.)
                </small>
            </div>

            <div class="form-group">
                <label for="mya-deployment">Mya Deployment:</label>
                @error('mya_deployment')<div class="text-red-600"> {{ $message }}</div> @enderror
                <select id="mya-deployment" wire:model.defer="mya_deployment" class="shadow-sm sm:rounded-lg w-32">
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
                    @error('begin_at')<div class="text-red-600"> {{ $message }}</div> @enderror
                    <input id="begin_at" type="text" class="datepicker shadow-sm sm:rounded-lg w-32 mr-10"
                           wire:model.defer="begin_at" />
                    <small class="form-text text-muted">
                       (Required) Data collection begin date
                    </small>
                </div>

                <div class="form-group">
                    <label for="end_at">End At:</label>
                    @error('end_at')<div class="text-red-600"> {{ $message }}</div> @enderror
                    <input id="end_at" type="text" class="datepicker shadow-sm sm:rounded-lg w-32"
                           wire:model="end_at" />
                    <small  class="form-text text-muted">
                        (Optional) Data collection end date.  Leave blank for ongoing.
                    </small>
                </div>


            <div class="form-group">
                <label for="comments">Comments:</label>
                @error('comments')<div class="text-red-600"> {{ $message }}</div> @enderror
                <small class="form-text text-muted">
                    (required) Describe purpose and other key details of data set
                </small>
                <textarea type="text" wire:model="comments" class="w-[40em] shadow-sm sm:rounded-lg w-32"></textarea>
            </div>

            <input class="btn btn-primary text-white bg-primary " type="submit" value="Submit"></input>

        </form>

    </div>

{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#begin_at').datepicker({format:'yyyy-mm-dd'}).on('change',function (e){
                @this.set('begin_at', e.target.value);
            });
            $('#end_at').datepicker({format:'yyyy-mm-dd'}).on('change',function (e){
                @this.set('end_at', e.target.value);
            });
        }, false);

    </script>
    </div>
</div>
