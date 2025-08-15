 <!DOCTYPE html>
 <html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
     data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

 <head>
     <meta charset="utf-8">
     <title>@yield('title', 'Dashboard')</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
     <meta content="Minimal Admin & Dashboard Template" name="description">
     <meta content="Themesdesign" name="author">
     <link rel="shortcut icon" href="{{ asset('assets/images/Electrifyingonebackend.png') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/tailwind2.css') }}">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @stack('styles')
 </head>

 <body>
     <main
         class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700"
         __processed_47f564f6-d9c6-4174-af4a-f0b5aa6f8d77__="true" cz-shortcut-listen="true">
         @include('backend.layouts.slidebar.slidebar')
         @include('backend.layouts.partials.cart.side-panel-button')
     </main>
     <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
     <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
     <script src="{{ asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
     <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
     <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
     <script src="{{ asset('assets/libs/lucide/umd/lucide.js') }}"></script>
     <script src="{{ asset('assets/js/tailwick.bundle.js') }}"></script>

     <!-- apexchart js -->
     <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

     <!-- dashboard ecommerce init js -->
     <script src="{{ asset('assets/js/pages/dashboards-ecommerce.init.js') }}"></script>

     <!-- App js -->
     <script src="{{ asset('assets/js/app.js') }}"></script>

     @stack('scripts')
 </body>

 </html>
