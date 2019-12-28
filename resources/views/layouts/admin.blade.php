<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{ asset('styles/shards-dashboards.1.1.0.min.css')}}">
    <link rel="stylesheet" href="styles/extras.1.1.0.min.css">
     <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
     @yield('css')
</head>
<body>
  {{--   <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
 <div class="container-fluid">
     <div class="row">
       <!-- Main Sidebar -->
       <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
         <div class="main-navbar">
           <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
             <a class="navbar-brand w-100 mr-0" href="/home" style="line-height: 25px;">
               <div class="d-table m-auto">
                 <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="img/gi.png" alt="Shards Dashboard">
                 <span class="d-none d-md-inline ml-1">Genz360</span>
               </div>
             </a>
             <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
               <i class="material-icons">&#xE5C4;</i>
             </a>
           </nav>
         </div>
     {{--     <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
           <div class="input-group input-group-seamless ml-3">
             <div class="input-group-prepend">
               <div class="input-group-text">
                 <i class="fas fa-search"></i>
               </div>
             </div>
             <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
         </form> --}}
         <div class="nav-wrapper">
           <ul class="nav flex-column">
             <li class="nav-item">
               <a class="nav-link active" href="{{ route('brands') }}">
                 <i class="material-icons">edit</i>
                 <span>Brand Users</span>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="{{ route('influencers') }}">
                 <i class="material-icons">vertical_split</i>
                 <span>Influencers Users</span>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="{{ route('campaigns.influencer') }}">
                 <i class="material-icons">note_add</i>
                 <span>Add New Notification</span>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="{{ route('campaigns') }}">
                 <i class="material-icons">view_module</i>
                 <span>Campanigs</span>
               </a>
             </li>

               <li class="nav-item">
               <a class="nav-link " href="{{ route('locations') }}">
                 <i class="material-icons">view_module</i>
                 <span>Locations</span>
               </a>
             </li>

                <li class="nav-item">
               <a class="nav-link " href="interests">
                 <i class="material-icons">view_module</i>
                 <span>Interests</span>
               </a>
             </li>
         {{--     <li class="nav-item">
               <a class="nav-link " href="tables.html">
                 <i class="material-icons">table_chart</i>
                 <span>Tables</span>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="user-profile-lite.html">
                 <i class="material-icons">person</i>
                 <span>User Profile</span>
               </a>
             </li> --}}
             <li class="nav-item">
               <a class="nav-link " href="errors.html" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                 <i class="material-icons">error</i>
                 <span>Logout</span>
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
               </form>
             </li> 
           </ul>
         </div>
       </aside>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

      <div class="main-navbar sticky-top bg-white">
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
          <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
            <div class="input-group input-group-seamless ml-3">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-search"></i>
                </div>
              </div>
              <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
          </form>
          <ul class="navbar-nav border-left flex-row ">
        
            <li class="nav-item ">
              <a class="nav-link text-nowrap px-3" href="#">
                <img class="user-avatar rounded-circle mr-2" src="img/gi.png" alt="User Avatar">
                    {{ Auth::user()->name }} ,  {{  Auth::user()->email}}
              </a>
            </li>
          </ul>
          <nav class="nav">
            <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
              <i class="material-icons">&#xE5D2;</i>
            </a>
          </nav>
        </nav>
      </div>

      <div class="main-content-container container-fluid px-4">
  
            @yield('content')
       </div>
            <footer class="main-footer d-flex p-2 px-3 bg-white border-top">

            <p class="copyright text-left float-left">© Copyright 2019 Studenting Era Pvt Ltd. Designed by Studenting Era Pvt Ltd.
            </p>

             <p class="text-right float-right"><a  href="#" rel="Developer" title="Designed & Developed By Rajnish">
               Rajnish Singh</a>
            </p>
          </footer>
        </main>
    </div>
 </div>

 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
 <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
 <script src="scripts/extras.1.1.0.min.js"></script>
 <script src="scripts/shards-dashboards.1.1.0.min.js"></script>
 <script src="scripts/app/app-blog-overview.1.1.0.js"></script>
   @yield('script')
</body>
</html>
