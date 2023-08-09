<x-app-layout>

    <div class="container m-4">
        <style>
            pre {
                display: block;
                height: 400px;
                width:90%;
                resize: both;
                overflow: auto;
            }
            h3 {
                border-top: 1px solid;
            }
        </style>

        <h1>Config #{{ $config->id }}</h1>
        <h3>Comments</h3>
        <p>{{ $config->comments }}</p>
        <h3>Configuration</h3>
        <div class="row">
            <div class="col">
                <pre><code class="language-yaml">{{ $config->yaml }}</code></pre>
            </div>
        </div>
        <h3>Data Sets</h3>
        <div class="row">
            <div class="col">
                <p>The table below lists Data Sets that refer to this configuration</p>
                <b-table :items="[]"></b-table>
            </div>
        </div>

    </div>


    @push('css')
        <link rel="stylesheet" href="{{ URL::asset('css/prism.css') }}" />
    @endpush

    @push('js')
        <script src="{{URL::asset('js/prism.js')}}" />
    @endpush

</x-app-layout>


