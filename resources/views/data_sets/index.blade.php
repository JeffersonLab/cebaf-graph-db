<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Sets
        </h2>
    </x-slot>

    @foreach ($dataSets as $dataSet)
        <div class="py-2">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 text-gray-900">
                        {{$dataSet->comments}}
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
