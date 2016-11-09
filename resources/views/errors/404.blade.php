<!DOCTYPE html>
<html>

<head>

    <title>KEEPING IT SIMPLE SOLUTIONS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('libs/bootstrap.min.css ') }}">
</head>


<body>
<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! {{ trans('adminlte_lang::message.pagenotfound') }}.</h3>
        <p>
            {{ trans('adminlte_lang::message.notfindpage') }}
            {{ trans('adminlte_lang::message.mainwhile') }} <a href='{{ url('/home') }}'>{{ trans('adminlte_lang::message.returndashboard') }}</a> {{ trans('adminlte_lang::message.usingsearch') }}
        </p>
    </div><!-- /.error-content -->
</div><!-- /.error-page -->


</body>
</html>
