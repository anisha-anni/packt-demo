<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Packt | Bookstore</title>
    <link rel="shortcut icon" href="{{ URL::asset('/assets/images/favicon.ico')}}"/>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/font-awesome-5.5.0.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/toastr.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/css/datepicker.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css"/>
  
<?php
    header('Content-type: text/javascript');
?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a href="{{ url('/books') }}">
                                <img alt="image"  src="{{URL::asset('/assets/images/logo-new.svg')}}" style="max-width:100px; height:auto;cursor: pointer;" class="sidemenu-logo">
                            </a>
                        </div>
                        <div class="logo-element">
                            <img alt="image"  src="{{URL::asset('/assets/images/logo-new.svg')}}" style="max-width:50px; height:auto;cursor: pointer;margin-left:-10px;" class="sidemenu-logo">
                        </div>
                    </li>
                    <li @if(Request::is('/books')) class="active" @endif>
                       <a href="{{ url('/books') }}">
                         <i class="fa fa-users"></i>
                           <span class="nav-label">Books </span>
                       </a>
                    </li>
                </ul>
            </div>
        </nav>
