<x-layout>
    <div class="max-w-md mx-auto py-10 px-4 sm:px-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden animated-card" style="--animation-order: 1;">
            <!-- Header with gradient background -->
            <div class="relative overflow-hidden pb-10">
                <!-- Background gradient and pattern -->
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600">
                    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>
                
                <!-- Header Content -->
                <div class="relative pt-8 pb-6 px-6 md:px-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 mb-6">
                        <img class="h-10 w-10" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white&shade=600" alt="TaskMaster Pro">
                    </div>
                    <h1 class="text-2xl font-bold text-white">Bun venit înapoi</h1>
                    <p class="mt-2 text-indigo-100">Conectează-te pentru a-ți gestiona task-urile</p>
                </div>
                
                <!-- Wave separator -->
                <div class="absolute bottom-0 left-0 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="text-white">
                        <path fill="currentColor" fill-opacity="1" d="M0,32L60,42.7C120,53,240,75,360,74.7C480,75,600,53,720,42.7C840,32,960,32,1080,37.3C1200,43,1320,53,1380,58.7L1440,64L1440,100L1380,100C1320,100,1200,100,1080,100C960,100,840,100,720,100C600,100,480,100,360,100C240,100,120,100,60,100L0,100Z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Form Container -->
            <div class="px-6 py-8 md:px-8">
                <form class="space-y-6" action="/login" method="POST">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresa de email</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" autocomplete="email" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                                placeholder="exemplu@email.com">
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-700">Parola</label>
                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150">
                                    Ai uitat parola?
                                </a>
                            </div>
                        </div>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" autocomplete="current-password" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                                placeholder="••••••••">
                        </div>
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition duration-150">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ține-mă conectat
                        </label>
                    </div>
                    
                    <!-- Error Messages -->
                    @error('error')
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex items-center">
                                <div class="shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ $message }}</p>
                                </div>
                            </div>
                        </div>
                    @enderror
                    
                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                            class="btn-gradient w-full flex justify-center items-center py-2.5 px-4 rounded-lg text-white shadow-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Conectare
                        </button>
                    </div>
                    
                    <!-- Registration Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Nu ai cont?
                            <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150">
                                Înregistrează-te
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <style>
        .btn-gradient {
            background-image: linear-gradient(to right, #4f46e5, #7c3aed);
        }
        
        .btn-gradient:hover {
            background-image: linear-gradient(to right, #4338ca, #6d28d9);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
    </style>
</x-layout>