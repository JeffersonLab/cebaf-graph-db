<style>
    #logo{
        font-size: 150%;
        vertical-align: middle;
        text-align: center;
        display: table-cell;
        min-height: 32px;
    }
    span.icon{
        padding-top: 10px;
    }

</style>

<div class="col-md-2"></div>
<div id="logo" class="col-md-8 bg-gray-100">
    <!-- logo -->
    <a href="{{ URL::route('data-sets.index') }}">
    <span class="app-title">CEBAF Graph Database</span>
{{--        <span class="icon">{!! HTML::image('favicon-32x32.png') !!}</span> CEBAF Graph DB--}}
    </a>
</div>
<div class="col-md-2">
</div>
