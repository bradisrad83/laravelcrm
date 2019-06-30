<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="csrf-token" content="RZfM6pl0VW6qlLLnbgPX0ev51t4862DBfBGwLNzG"> --}}

    <title>Laravel CRM</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.css ">
</head>
<style>
    .page-header{
        width: 100%;
        background-color: #1c2b54;
        color: #ffffff;
        margin-top: 0px;
    }
</style>
<body>
    <div class="page-header">
        <div class="">
            <h1>LaravelCRM</h1>
        </div>
    </div>
    <div class=" app-container">
        <div class="row reorder-xs">
        <ul class="sidebar">
            @if($user->role->name == 'admin')
                <li role="presentation"><a href="/companies">Companies</a></li>
                <li role="presentation"><a href="/users">Users</a></li>
            @else
                <li role="presentation"><a href="/companies/{company}">Company</a></li>
                <li role="presentation"><a href="/employees">Employees</a></li>
            @endif
            <div class="signed-in">
                <i class="fa fa-user" aria-hidden="true"></i>
                <p><span>NAME</span> -  <span>ROLE</span></p>
                <a href="/logout">Log Out</a>
            </div>
        </ul>
    <div id="main" class=" ">
        <main class="">
            @yield('content')
        </main>
    </div>
    </div>
    </div>
</body>
</html>
