<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{route('books.index')}}">@lang('site.bookshop')</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          @auth
          <li class="nav-item">
            <a class="nav-link" href="{{route('books.create')}}">
              @lang('site.addbook')
            </a>
          </li>
          @endauth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @lang('site.allcats')
            </a>
            <ul class="dropdown-menu">
              @foreach ($categories as $Category)
              <li><a class="dropdown-item" href="{{route('categories.show', $Category->id)}}">{{$Category->name}}</a></li>
              @endforeach
              <li><a class="dropdown-item" style="font-weight: bold" href="{{route('categories.create')}}">+ADD NEW</a></li>
              <li><a class="dropdown-item" style="font-weight: bold" href="{{route('categories.index')}}">ALL</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav" style="margin-left: auto">
          @guest
            <li class="nav-item">
              <a class="nav-link active" href="{{route('auth.register')}}">@lang('site.Register')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('auth.login')}}">@lang('site.Login')</a>
            </li>
          @endguest
          @auth
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{Auth::user()->name}}
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('auth.logout')}}">
                        @lang('site.logout')
                  </a></li>
                </ul>
              </li>
            </ul>
          @endauth
          <li class="nav-item">
            <a class="nav-link" href="{{route('lang.en')}}">en</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('lang.ar')}}">ar</a>
          </li>
        </ul>
      </div>
    </div>
</nav>