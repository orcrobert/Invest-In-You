<x-layout>
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden animated-card" style="--animation-order: 1;">
            <!-- Page Header with Illustration -->
            <div class="relative overflow-hidden pb-10">
                <!-- Background gradient and pattern -->
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600">
                    <div class="absolute inset-0 bg-pattern opacity-10"></div>
                </div>
                
                <!-- Header Content -->
                <div class="relative pt-8 pb-6 px-6 md:px-8">
                    <h1 class="text-2xl font-bold text-white">Creează un Task Nou</h1>
                    <p class="mt-2 text-indigo-100">Adaugă un task nou pentru a-ți organiza activitățile</p>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute right-0 bottom-0 transform translate-y-1/3 translate-x-1/4">
                    <svg class="h-20 w-20 text-indigo-200 opacity-50" fill="currentColor" viewBox="0 0 80 80">
                        <path d="M52.5,12.5h-5v-5c0-1.38-1.12-2.5-2.5-2.5s-2.5,1.12-2.5,2.5v5h-5c-1.38,0-2.5,1.12-2.5,2.5s1.12,2.5,2.5,2.5h5v5 c0,1.38,1.12,2.5,2.5,2.5s2.5-1.12,2.5-2.5v-5h5c1.38,0,2.5-1.12,2.5-2.5S53.88,12.5,52.5,12.5z"></path>
                        <path d="M75,12.5h-5v-5c0-1.38-1.12-2.5-2.5-2.5s-2.5,1.12-2.5,2.5v5h-5c-1.38,0-2.5,1.12-2.5,2.5s1.12,2.5,2.5,2.5h5v5 c0,1.38,1.12,2.5,2.5,2.5s2.5-1.12,2.5-2.5v-5h5c1.38,0,2.5-1.12,2.5-2.5S76.38,12.5,75,12.5z M30,12.5h-5v-5 c0-1.38-1.12-2.5-2.5-2.5s-2.5,1.12-2.5,2.5v5h-5c-1.38,0-2.5,1.12-2.5,2.5s1.12,2.5,2.5,2.5h5v5c0,1.38,1.12,2.5,2.5,2.5 s2.5-1.12,2.5-2.5v-5h5c1.38,0,2.5-1.12,2.5-2.5S31.38,12.5,30,12.5z"></path>
                    </svg>
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
                <form method="POST" action="/tasks" class="space-y-6">
                    @csrf
                    
                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Title Field -->
                        <div class="col-span-full">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titlu<span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150"
                                    placeholder="Spală vasele" required>
                            </div>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Description Field -->
                        <div class="col-span-full">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descriere<span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <textarea name="description" id="description" rows="3" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150"
                                    placeholder="Spală toate vasele murdare din chiuvetă">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Due Date Field -->
                        <div class="md:col-span-1">
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Data limită</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}" 
                                    class="w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150">
                            </div>
                            @error('deadline')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Price/Penalty Field -->
                        <div class="md:col-span-1">
                            <label for="price" class="block text-sm font-medium text-gray-700">Penalizare (RON)</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" 
                                    class="w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150"
                                    placeholder="50">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Suma care va fi scăzută din contul tău dacă nu finalizezi task-ul la timp</p>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex items-center">
                                <div class="shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Există {{ count($errors) }} erori în formularul tău:</h3>
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
                    
                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="/tasks" class="py-2 px-4 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150">
                            Anulează
                        </a>
                        <button type="submit" class="btn-gradient py-2 px-6 rounded-lg text-white shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Salvează Task
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Help Section -->
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 rounded-b-xl">
                <div class="flex items-start">
                    <div class="shrink-0">
                        <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Sfat pentru crearea task-urilor</h3>
                        <div class="mt-2 text-sm text-gray-600">
                            <p>Stabilește o penalizare pentru a-ți crește motivația! Dacă nu completezi task-ul până la data limită, suma va fi dedusă din balanța ta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</x-layout>