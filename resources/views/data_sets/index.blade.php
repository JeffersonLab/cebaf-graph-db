<x-app-layout>

    <div class="card">
        <div class="card-header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Sets
            </h2>
        </div>

        <div class="card-body">
            <div>
                <a class="btn btn-lg btn-primary text-white bg-primary tw-mb-1"
                   href="{{route('data-sets.create')}}">Create</a>
            </div>
            <livewire:data-set-table theme="bootstrap-4"/>
        </div>


    </div>

    </div>


</x-app-layout>
