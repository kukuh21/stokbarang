<!DOCTYPE html>
<html>
<head>
  <title>{{ config('app.name') }}</title>
  @include('layouts.meta')
  @include('layouts.css')
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/pwa/icon-96x96.png') }}">
  <meta name="apple-mobile-web-app-status-bar" content="#3C8DBC">
  <meta name="theme-color" content="#3C8DBC">
  <script src="{{ asset('js/pwa.js') }}"></script>
  <style>
    .radius {
      border-radius: 5px;
    }
  </style>
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
  @include('layouts.main_header')
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header text-center">MENU</li>
        <li class="@yield('active-home')">
          <a href="{{ url('/') }}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>

        @if(session('role_name') == 'Admin')
          @include('layouts.menu.menu_admin')
        @endif

        @if(session('role_name') == 'User')
          @include('layouts.menu.menu_user')
        @endif

        <li>
          <a href="{{ url('/logout') }}" class="logout-trigger">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>