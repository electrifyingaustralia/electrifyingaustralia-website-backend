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
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/Electrifyingonebackend.png">
    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Icons CSS -->

    <!-- Tailwind CSS -->


    <link rel="stylesheet" href="assets/css/tailwind2.css">
</head>

<body
    class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">

    <div class="relative">
        <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
            <div class="!px-10 !py-12 card-body">


                <div class="mt-8 text-center">
                    <h4 class="mb-1 text-custom-500 dark:text-custom-500">Admin Login</h4>
                </div>

                <form action="https://themesdesign.in/tailwick/html/index.html" class="mt-10" id="signInForm">
                    <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50"
                        id="successAlert">
                        You have <b>successfully</b> signed in.
                    </div>
                    <div class="mb-3">
                        <label for="username" class="inline-block mb-2 text-base font-medium">UserName/ Email
                            ID</label>
                        <input type="text" id="username"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter username or email">
                        <div id="username-error" class="hidden mt-1 text-sm text-red-500">Please enter a valid email
                            address.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                        <input type="password" id="password"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter password">
                        <div id="password-error" class="hidden mt-1 text-sm text-red-500">Password must be at least 8
                            characters long and contain both letters and numbers.</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <input id="checkboxDefault1"
                                class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                type="checkbox" value="">
                            <label for="checkboxDefault1"
                                class="inline-block text-base font-medium align-middle cursor-pointer">Remember
                                me</label>
                        </div>
                        <div id="remember-error" class="hidden mt-1 text-sm text-red-500">Please check the "Remember
                            me" before submitting the form.</div>
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign
                            In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src='assets/libs/choices.js/public/assets/scripts/choices.min.js'></script>
    <script src="assets/libs/%40popperjs/core/umd/popper.min.js"></script>
    <script src="assets/libs/tippy.js/tippy-bundle.umd.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/libs/lucide/umd/lucide.js"></script>
    <script src="assets/js/tailwick.bundle.js"></script>
    <script src="assets/js/pages/auth-login.init.js"></script>

</body>


<!-- Mirrored from themesdesign.in/tailwick/html/auth-login-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Aug 2025 08:33:02 GMT -->

</html>
