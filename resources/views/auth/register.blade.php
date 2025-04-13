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
                    <h1 class="text-2xl font-bold text-white">Creează un cont nou</h1>
                    <p class="mt-2 text-indigo-100">Alătură-te acum pentru a-ți gestiona task-urile</p>
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
                <form class="space-y-6" action="/register" method="POST">
                    @csrf
                    
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nume complet</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="text" name="name" id="name" autocomplete="name" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                                placeholder="Nume și prenume">
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
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
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Parola</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" autocomplete="new-password" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                                placeholder="Minim 8 caractere">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Parola trebuie să aibă minim 8 caractere</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmă parola</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                                placeholder="Repetă parola">
                        </div>
                    </div>
                    
                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition duration-150">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-600">
                                Sunt de acord cu <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Termenii și Condițiile</a> și <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Politica de Confidențialitate</a>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Există {{ count($errors) }} erori în formular:</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                            class="btn-gradient w-full flex justify-center items-center py-2.5 px-4 rounded-lg text-white shadow-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Creează cont
                        </button>
                    </div>
                    
                    <!-- Login Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Ai deja un cont?
                            <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150">
                                Conectează-te
                            </a>
                        </p>
                    </div>
                </form>
            </div>
            
            <!-- Footer Section -->
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 rounded-b-xl text-center">
                <p class="text-xs text-gray-500">
                    © {{ date('Y') }} TaskMaster Pro. Toate drepturile rezervate.
                </p>
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
        
        .animated-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
    </style>
</x-layout>