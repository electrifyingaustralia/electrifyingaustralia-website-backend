 <!DOCTYPE html>
 <html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
     data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

 <head>
     <meta charset="utf-8">
     <title>@yield('title', 'Dashboard')</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
     <meta content="Minimal Admin & Dashboard Template" name="description">
     <meta content="Themesdesign" name="author">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="shortcut icon" href="{{ asset('assets/images/Electrifyingonebackend.png') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/tailwind2.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/resource/app.css') }}">
     @if (env('APP_ENV') == 'local')
         @vite('resources/css/app.css')
     @endif
     @stack('styles')
 </head>

 <body>
     <main
         class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700"
         __processed_47f564f6-d9c6-4174-af4a-f0b5aa6f8d77__="true" cz-shortcut-listen="true">
         {{-- @include('backend.layouts.partials.master') --}}
         <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
             @include('backend.layouts.partials.sidebar')
             <!-- Left Sidebar End -->
             <div id="sidebar-overlay" class="absolute inset-0 z-[1002] bg-slate-500/30 hidden"></div>
             {{-- left side header  import --}}
             @include('backend.layouts.partials.topbar')
             {{-- card side import --}}
             {{-- @include('backend.layouts.partials.cart-item') --}}
             @include('backend.layouts.partials.dark_mode')
             <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
                 <div
                     class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
                     <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto mt-5">
                         @yield('contents')
                     </div>
                 </div>
                 @include('backend.layouts.partials.footer')
             </div>
         </div>
     </main>
     <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
     <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
     <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
     <script src="{{ asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
     <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
     <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
     <script src="{{ asset('assets/libs/lucide/umd/lucide.js') }}"></script>
     <script src="{{ asset('assets/js/tailwick.bundle.js') }}"></script>
     <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

     <!-- dashboard ecommerce init js -->
     {{-- <script src="{{ asset('assets/js/pages/dashboards-ecommerce.init.js') }}"></script> --}}

     <!-- App js -->
     <script src="{{ asset('assets/js/app.js') }}"></script>

     <!-- Toastr -->
     <script>
         $(document).ready(function() {
             const successMessage = localStorage.getItem('toastr_success');
             const errorMessage = localStorage.getItem('toastr_error');

             if (successMessage) {
                 toastr.success(successMessage);
                 localStorage.removeItem('toastr_success');
             }

             if (errorMessage) {
                 toastr.error(errorMessage);
                 localStorage.removeItem('toastr_error');
             }

             // Also check for session flash messages
             @if (Session::has('success'))
                 toastr.success("{{ Session::get('success') }}");
             @endif

             @if (Session::has('error'))
                 toastr.error("{{ Session::get('error') }}");
             @endif
         });
     </script>
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             // Define all menu items that should have dropdown functionality
             const menuItems = [{
                     selector: 'li.group\\/blog',
                     path: '/admin/blog'
                 },
                 {
                     selector: 'li.group\\/product',
                     path: '/admin/product'
                 },
                 {
                     selector: 'li.group\\/event',
                     path: '/admin/event'
                 },
                 {
                     selector: 'li.group\\/project',
                     path: '/admin/project'
                 },
                 {
                     selector: 'li.group\\/package',
                     path: '/admin/package'
                 },
                 {
                     selector: 'li.group\\/faq',
                     path: '/admin/faq'
                 }
             ];

             menuItems.forEach(menu => {
                 const menuElements = document.querySelectorAll(menu.selector);

                 menuElements.forEach(item => {
                     const menuLink = item.querySelector('a[href="javascript:void(0);"]');

                     if (menuLink) {
                         menuLink.addEventListener('click', function(e) {
                             e.preventDefault();
                             item.classList.toggle('active');
                         });
                     }

                     // Auto-expand if current route matches the menu path
                     const currentPath = window.location.pathname;
                     if (currentPath.includes(menu.path)) {
                         item.classList.add('active');
                     }
                 });
             });
         });
     </script>
     @stack('scripts')
 </body>

 </html>
