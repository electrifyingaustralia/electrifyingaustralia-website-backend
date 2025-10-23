<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">


<!-- Mirrored from themesdesign.in/tailwick/html/auth-login-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Aug 2025 08:33:01 GMT -->

<head>

    <meta charset="utf-8">
    <title>Admin Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <link rel="shortcut icon" href="{{ asset('assets/images/Electrifyingonebackend.png') }}">
    <script src="{{ asset('assets/js/layout.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('assets/css/tailwind2.css') }}">
</head>

<body
    class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">

    <div class="relative">
        <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
            <div class="!px-10 !py-12 card-body">


                <div class="mt-8 text-center">
                    <h4 class="mb-1 text-custom-500 dark:text-custom-500">Admin Login</h4>
                </div>

                <form action="{{ route('admin.login.post') }}" method="POST" class="mt-10" id="signInForm">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="inline-block mb-2 text-base font-medium">Email</label>
                        <input
                            type="text"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('email') !border-red-500 focus:!border-red-500 @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                        <input
                            type="password"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            name="password"
                            placeholder="Enter your password">
                             @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ asset('assets/js/tailwick.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/auth-login.init.js') }}"></script>

</body>

</html>
