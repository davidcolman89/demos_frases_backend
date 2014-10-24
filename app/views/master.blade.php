<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', Config::get('app.name_system'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ URL::asset('bootstrap/images/favicon.png')}}">
    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/jquery-ui.css') }}
    {{ HTML::style('bootstrap/dist/css/sticky-footer-navbar.css', array('media' => 'all')) }}
    {{ HTML::style('bootstrap/dist/css/bootstrap.css', array('media' => 'all')) }}
    {{ HTML::style('bootstrap/dist/css/navbar-static-top.css', array('media' => 'all')) }}
    {{ HTML::style('assets/css/ladda-themeless.min.css') }}
    {{ HTML::style('assets/css/main.css',array('media'=>'all')) }}
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/380cb78f450/integration/bootstrap/3/dataTables.bootstrap.css">

    <style type="text/css" media="all">
        @font-face {
            font-family: 'Roboto Condensed';
            font-style: normal;
            font-weight: 700;
            src: local('Roboto Condensed Bold'), local('RobotoCondensed-Bold'), url('{{ URL::asset("assets/fonts/b9QBgL0iMZfDSpmcXcE8nCSLrGe-fkSRw2DeVgOoWcQ.woff") }}') format('woff');
        }

    </style>


</head>
<body>
<div id="div-print-logo" class="row">
    <div class="col-md-12">
        <figure id="figure-print-logo">
            <img id="img-print-logo" src="{{ URL::asset('bootstrap/images/biblioco34.jpg'); }}" width="201" height="60">
        </figure>
    </div>
</div>
<!-- Static navbar -->
<div class="navbar-inverse navbar-default navbar-fixed-top not-view-print" role="navigation">
    <div class="container" style="width:100%">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="background-image:url('{{ URL::asset('bootstrap/images/biblioco34.jpg') }}'); background-position:center left; background-repeat:no-repeat; padding-left:60px; padding-top:7px">
                {{Config::get('app.name_system')}}
                <br/>
                <span style="font-family: Arial, Helvetica, sans-serif; font-size:10px;">{{Config::get('app.sub_name_system')}}</span>
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Formularios <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('frases.create') }}">
                                <span class="glyphicon glyphicon-plus"style="margin-bottom:5px;"/></span><span style="margin-left:5px;">Frases</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Listados <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('frases.index')}} "><span class="glyphicon glyphicon-th-list"
                                                                      style="margin-bottom:5px;"></span><span
                                    style="margin-left:5px">Frases</span></a></li>


                    </ul>
                </li>


            </ul>

        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<!-- Fin Static navbar -->
<div class="container">
    @yield('contenido')
</div>

<div id="footer" style="margin-bottom:10px" class="not-view-print">
    <div class="container">
        <p class="text-muted">{{Config::get('app.sub_name_system')}} - {{Config::get('app.name_system')}}</p>
    </div>
</div>
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
{{ HTML::script('assets/js/jquery-ui.min.js') }}
{{ HTML::script('bootstrap/dist/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/fullscreen.js') }}
{{ HTML::script('assets/js/spin.min.js') }}
{{ HTML::script('assets/js/ladda.min.js') }}
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/380cb78f450/integration/bootstrap/3/dataTables.bootstrap.js"></script>
@yield('scripts')
</body>
</html>