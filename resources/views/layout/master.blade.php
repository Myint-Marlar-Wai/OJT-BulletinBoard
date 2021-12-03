<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>@yield('title') | SCM Bulletinboard</title>
  
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  
  <link href="{{ asset('css/fontawesome/all.min.css') }}" rel="stylesheet">
  
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><h1 class="col01">SCM Bulletinboard</h1></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navb">
          @if (Route::has('login'))
          <ul class="navbar-nav">
            @auth
            @if (Auth::user()->type == '0')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.index') }}">Users</a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('post.index') }}">Posts</a>
            </li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle col01" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>
              
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <form action="{{ url('user/' . Auth::user()->id . '/profile' ) }}" method="POST" class="dropdown-item font-weight-bold col01">
                  @csrf
                  <button type="submit" class="nav-link"><i class="fas fa-user-alt"></i>&nbsp; Profile</button>
                </form>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="dropdown-item font-weight-bold col01">
                  @csrf
                  <button type="submit" class="nav-link"><i class="fa fa-sign-out-alt"></i>&nbsp; Logout</button>
                </form>
            </div>
          </li>
          @endauth
        </ul>
        @endif
      </div>
    </div>
  </nav>
</header>
<div class="container py-5">
  @yield('content')
</div>
<footer class="py-2 bg-gray">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <a href="#" class="ft-logo">SCM Bulletinboard</a>
      <span class="footer-copyright">
        © <?php echo date('Y') ?> Copyright
      </span>
    </div>
  </div>
</footer>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet"> 
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
  function goBack() {
    window.history.back();
  }
  </script>
</body>

</html>