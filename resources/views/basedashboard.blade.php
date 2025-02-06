<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"

      rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
  <title>E library</title>

    @vite('resources/css/admin/core/libs.min.css')
    @vite('resources/css/admin/aos.css')
    @vite('resources/css/admin/hope.css')
    @vite('resources/css/admin/custom.css')
    @vite('resources/css/admin/customizer.css')
    @vite('resources/css/admin/rtl.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @stack('styles')
</head>
<body>

    @yield('loader')

    @yield('aside')


    <main class="main-content">
        <div class="position-relative iq-banner">
            @yield('nav')
            @yield('banner')
        </div>
            @yield('container_fluid')
    </main>

    @yield('settings')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('admin.admin_components.sweet_alert_success')
    @include('admin.admin_components.sweet_alert_error')
    @yield('sweet_alert')

</body>

@stack('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.6.3/smooth-scrollbar.js" defer></script>
@vite('resources/js/admin/circle.js')
@vite('resources/js/admin/core/libs.min.js')
@vite( 'resources/js/admin/core/external.min.js')
@vite('resources/js/admin/charts/dashboard.js')
@vite('resources/js/admin/plugins/setting.js')
<script src="{{ asset('js/admin.js') }} "defer></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    AOS.init();
  });
</script>

</html>

