<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
@vite('resources/js/app.js')
@inertiaHead
</head>
<body>
<div class="container">
<div class="row strapline">
    @include('includes.strapline')
</div>
<div class="row menubar">
    @include('includes.navbar')
</div>
@routes
@inertia
</div>
</body>
</html>
