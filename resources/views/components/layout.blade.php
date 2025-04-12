<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img class="size-8"
                                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company">
                        </div>
                    </div>
                    
                    @guest
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/login"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >Login</a>
                        <a href="/register"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Register</a>
                    </div>
                    @endguest

                    @auth
                    <form method="POST" class="ml-10 flex items-baseline space-x-4" action="/logout">
                        @csrf
                        <button type="submit"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Log Out</button>
                            <div class="text-gray-300 font-bold">Balance: {{ Auth::user()->balance }}</div>
                    </form>

                    @endauth

                    <div class="md:hidden" id="mobile-menu">
                        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                            <a href="/"
                                class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                                aria-current="page">Home</a>
                        </div>
                        <div class="border-t border-gray-700 pt-4 pb-3">
                            <div class="flex items-center px-5">
                                <div class="shrink-0">
                                    <img class="size-10 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                </div>
                                <div class="ml-3">
                                    <div class="text-base/5 font-medium text-white">Tom Cook</div>
                                    <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                                </div>
                            </div>
                            <div class="mt-3 space-y-1 px-2">
                                <a href="#"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                                    Profile</a>
                                <a href="#"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                                <a href="#"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                                    out</a>
                            </div>
                        </div>
                    </div>
        </nav>

        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                </h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>


</html>
