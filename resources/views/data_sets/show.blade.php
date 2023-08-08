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

    <h1>Data Set #{{ $dataSet->id }}</h1>
    <h2>{{ $dataSet->comments }}</h2>
    <h3>Configuration</h3>
    <div class="row">
        <div class="col">
            <pre><code class="language-yaml">{{ $dataSet->config->yaml }}</code></pre>
        </div>
    </div>
    <h3>Models</h3>
    <div class="row">
        <div class="col">
            <p>The table below lists models trained on the current data set</p>
            <b-table :items="[]"></b-table>
        </div>
    </div>
    <h3>Data</h3>
    <div class="row">
        <div class="col">
            <p>The table below lists the graph data that comprise the data set.</p>
            <b-table :items="$dataSet->data"></b-table>
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


