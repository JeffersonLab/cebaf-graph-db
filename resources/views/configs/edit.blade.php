<x-app-layout>

    <div class="card-header tw-mt-4">
        <div class="card-header">
            <h2 class="tw-m-auto">Edit Configuration</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <livewire:config-form :config="$config" />
        </div>

    </div>

</x-app-layout>
