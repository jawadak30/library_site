@push('styles')
@vite('resources/css/main.css')
@endpush
<main>


    <div class="banner">

      <div class="container">

        <div class="slider-container has-scrollbar">

          <div class="slider-item">

            <img src="{{ asset('images_site/first.jpg') }}" alt="women's latest fashion sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">E library</p>

              <h2 class="banner-title">Welcome to our library</h2>

              {{-- <p class="banner-text">
                starting at &dollar; <b>20</b>.00
              </p> --}}

              {{-- <a href="#" class="banner-btn">Shop now</a> --}}

            </div>

          </div>

          <div class="slider-item">

            <img src="{{ asset('images_site/two.jpg') }}" alt="modern sunglasses" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle"></p>

              <h2 class="banner-title">Modern books</h2>

              {{-- <p class="banner-text">
                starting at &dollar; <b>15</b>.00
              </p> --}}

              {{-- <a href="#" class="banner-btn">Shop now</a> --}}

            </div>

          </div>

          <div class="slider-item">

            <img src="{{ asset('images_site/3.jpg') }}" alt="new fashion summer sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle"></p>

              <h2 class="banner-title"></h2>

              {{-- <p class="banner-text">
                starting at &dollar; <b>29</b>.99
              </p> --}}

              {{-- <a href="#" class="banner-btn">Shop now</a> --}}

            </div>

          </div>

        </div>

      </div>

    </div>


    <div class="product-container">

        <div class="container">

          <div class="product-box">



            <!--
              - PRODUCT GRID
            -->

            <div class="product-main">

              <h2 class="title">{{ trans('mainTrans.books') }}</h2>

              <div class="product-grid">
                @foreach ($livres as $livre )
                <div class="showcase">

                    <div class="showcase-banner">

                      <img src="{{ asset('storage/' . $livre->image1) }}" alt="Mens Winter Leathers Jackets" width="300" class="product-img default">
                      <img src="{{ asset('storage/' . $livre->image2) }}" alt="Mens Winter Leathers Jackets" width="300" class="product-img hover">


                      <div class="showcase-actions">
                        @auth
                            <a class="btn-action view-book" href="{{ route('auth_book',$livre->id) }}"><ion-icon name="eye-outline"></ion-icon></a>
                            <form action="{{ route('addToCart_user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $livre->id }}">
                                <button type="submit" class="btn-action"><ion-icon name="bag-add-outline"></ion-icon></button>
                            </form>
                        @endauth
                        @guest
                            <a class="btn-action view-book" href="{{ route('guest_book',$livre->id) }}"><ion-icon name="eye-outline"></ion-icon></a>
                            <form action="{{ route('addToCart_guest') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $livre->id }}">
                                <button type="submit" class="btn-action"><ion-icon name="bag-add-outline"></ion-icon></button>
                            </form>
                        @endguest



                      </div>

                    </div>

                    <div class="showcase-content">
                        <a href="#" class="showcase-category">{{ trans('mainTrans.category') }} : {{ $livre->categorie->name }}</a>
                        <h3><a href="#" class="showcase-title">{{ trans('mainTrans.title') }} : {{ $livre->titre }}</a></h3>


                    </div>

                  </div>
                @endforeach
              </div>
              <div class="pagination-links">
                {{ $livres->links() }}
            </div>

            </div>

          </div>

        </div>

      </div>
      </div>


    {{-- <div class="blog">

      <div class="container">

        <div class="blog-container has-scrollbar">

          <div class="blog-card">

            <a href="#">
              <img src="./assets/images/blog-1.jpg" alt="Clothes Retail KPIs 2021 Guide for Clothes Executives" width="300" class="blog-banner">
            </a>

            <div class="blog-content">

              <a href="#" class="blog-category">Fashion</a>

              <a href="#">
                <h3 class="blog-title">Clothes Retail KPIs 2021 Guide for Clothes Executives.</h3>
              </a>

              <p class="blog-meta">
                By <cite>Mr Admin</cite> / <time datetime="2022-04-06">Apr 06, 2022</time>
              </p>

            </div>

          </div>

        </div>

      </div>

    </div> --}}

</main>

