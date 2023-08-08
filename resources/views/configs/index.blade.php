<x-app-layout>

    <div class="card mt-4">
        <div class="card-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Configurations
            </h2>
        </div>
        <div class="card">
            <div class="card-body">

                <div>
                    <a class="btn btn-lg btn-primary text-white bg-primary tw-mb-1"
                            href="{{route('configs.create')}}">Create</a>
                </div>

                <livewire:config-table theme="bootstrap-4"/>
            </div>

        </div>

    </div>


</x-app-layout>
