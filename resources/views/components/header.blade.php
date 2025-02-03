
@push('styles')
@vite('resources/css/header.css')

@endpush
<header>

    <div class="header-main">

      <div class="container">
        @auth
        <a href="{{ route('welcome') }}" class="header-logo">
            <img src="{{ asset('images_site/logo.jpg') }}" alt="Anon's logo" width="70" height="36">
          </a>
        @endauth
        @guest

        <a href="{{ route('guest_welcome') }}" class="header-logo">
            <img src="{{ asset('images_site/logo.jpg') }}" alt="Anon's logo" width="70" height="36">
          </a>
        @endguest
        <div class="header-user-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="action-btn"><i class="fa-regular fa-user"></i></a>
            @endauth
            @guest
                <a href="{{ route('register') }}" class="action-btn"><i class="fa-regular fa-user"></i></a>
            @endguest


          @auth
            <a class="action-btn" href="{{ route('cart_auth') }}">
                <ion-icon name="bag-handle-outline"></ion-icon>
                <span class="count">{{ session()->has('cart') ? count(session('cart')) : 0 }}</span>
            </a>
          @endauth
          @guest
            <a class="action-btn" href="{{ route('cart_guest') }}">
                <ion-icon name="bag-handle-outline"></ion-icon>
                <span class="count">{{ session()->has('cart') ? count(session('cart')) : 0 }}</span>
            </a>
          @endguest

        </div>

        <div class="header-top-actions">

            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  languages
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                      <li>
                          <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                              {{ $properties['native'] }}
                          </a>
                      </li>
                  @endforeach
              </ul>
            </div>

          </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu">
        <div class="container">
            <ul class="desktop-menu-category-list">
                <li class="menu-category">
                    <a href="{{ route('guest_welcome') }}" class="menu-title">Home</a>
                </li>

                <!-- Categories Dropdown -->
                <li class="menu-category">
                    <a href="#" class="menu-title">Categories</a>

                    <div class="dropdown-panel">
                        <ul class="dropdown-panel-list">
                            @foreach($categories as $category)
                                @auth
                                    <li class="panel-list-item">
                                        <a href="{{ route('showLivres_user', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endauth
                                @guest
                                    <li class="panel-list-item">
                                        <a href="{{ route('showLivres_guest', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endguest
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>



    <div class="mobile-bottom-navigation">
        @auth
        <a class="action-btn" href="{{ route('cart_auth') }}">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count">{{ session()->has('cart') ? count(session('cart')) : 0 }}</span>
        </a>

        @endauth
        @guest
        <a class="action-btn" href="{{ route('cart_guest') }}">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count">{{ session()->has('cart') ? count(session('cart')) : 0 }}</span>
        </a>

        @endguest

      <a class="action-btn" href="{{ route('guest_welcome') }}">
        <ion-icon name="home-outline"></ion-icon>
        </a>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

        <div class="menu-top">
          <h2 class="menu-title">Menu</h2>

          <button class="menu-close-btn" data-mobile-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <ul class="mobile-menu-category-list">
            @guest
                <li class="menu-category">
                    <a href="{{ route('guest_welcome') }}" class="menu-title">Home</a>
                </li>
            @endguest
            @auth
            <li class="menu-category">
                <a href="{{ route('welcome') }}" class="menu-title">Home</a>
            </li>
            @endauth
            @guest
                <li class="menu-category">
                    <a href="{{ route('login') }}" class="menu-title">login</a>
                </li>
                <li class="menu-category">
                    <a href="{{ route('register') }}" class="menu-title">register</a>
                </li>
            @endguest

          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">categories</p>

              <div>
                <ion-icon name="add-outline" class="add-icon"></ion-icon>
                <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
              </div>
            </button>

            <ul class="submenu-category-list" data-accordion>

                @foreach($categories as $category)
                    @guest
                    <li class="submenu-category">
                        <a class="submenu-title" href="{{ route('showLivres_guest', $category->id) }}">{{ $category->name }}</a>
                    </li>
                    @endguest
                    @auth
                    <li class="submenu-category">
                        <a class="submenu-title" href="{{ route('showLivres_user', $category->id) }}">{{ $category->name }}</a>
                    </li>
                    @endauth
                @endforeach
            </ul>

          </li>

        </ul>

        <div class="menu-bottom">

          <ul class="menu-category-list">

            <li class="menu-category">

              <button class="accordion-menu" data-accordion-btn>
                <p class="menu-title">Language</p>

                <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
              </button>

              <ul class="submenu-category-list" data-accordion>

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="submenu-category">
                    <a class="submenu-title" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
                @endforeach

              </ul>

            </li>

            <li class="menu-category">
                @auth
                    <a class="menu-title" href="{{ route('dashboard') }}" class="action-btn">Profile</a>
                @endauth
            </li>

          </ul>

        </div>

      </nav>

  </header>
