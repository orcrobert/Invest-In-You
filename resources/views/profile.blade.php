<x-layout>
    <link href="{{ asset('css/tasks.css') }}" rel="stylesheet">

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50">
        <!-- Main Content -->
        <div class="max-w-5xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <!-- Header -->
            <header class="bg-white shadow-sm hover-lift rounded-lg mb-6">
                <div class="px-4 py-4">
                    <!-- Top Navigation -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-800 transform hover:scale-105 transition duration-300">Profilul Tău</h1>
                        <div class="flex items-center space-x-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-indigo-600 transform hover:scale-110 transition duration-300 hover-lift">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Back Button -->
                    <div class="flex justify-start">
                        <a href="/tasks" class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transform hover:scale-105 transition duration-300 hover-lift">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Înapoi la Task-uri</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Profile Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Card -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300 hover:shadow-xl hover-lift">
                        <div class="flex flex-col items-center">
                            <img src="https://m.media-amazon.com/images/M/MV5BZDcyMGU3MDEtODkwOS00ZGFlLTllNTAtMGExMDE3OTAzMjI5XkEyXkFqcGc@._V1_.jpg" alt="{{ $user->name }}" class="w-32 h-32 rounded-full mb-4 transform hover:scale-110 transition duration-300">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                            <div class="w-full border-t border-gray-200 pt-4">
                                <p class="text-sm text-gray-500">Membru din {{ $user->created_at->format('d.m.Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Total Tasks -->
                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300 hover:shadow-xl hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Task-uri</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_tasks'] }}</h3>
                                </div>
                                <div class="p-3 bg-indigo-100 rounded-full">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Completion Rate -->
                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300 hover:shadow-xl hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Rata de Completare</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['completion_rate'] }}%</h3>
                                </div>
                                <div class="p-3 bg-green-100 rounded-full">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Tasks -->
                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300 hover:shadow-xl hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Task-uri În Așteptare</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['pending_tasks'] }}</h3>
                                </div>
                                <div class="p-3 bg-yellow-100 rounded-full">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300 hover:shadow-xl hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Preț</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_price'] }} RON</h3>
                                </div>
                                <div class="p-3 bg-red-100 rounded-full">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Balance -->
                        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300 hover:shadow-xl hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Balanță</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['balance'] }} RON</h3>
                                </div>
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
