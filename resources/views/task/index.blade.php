<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIY</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f7fb 0%, #eef2ff 100%);
        }

        /* Custom Animations */
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

        .animated-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            animation-delay: calc(var(--animation-order) * 0.1s);
        }

        .stat-card {
            --animation-order: 1;
        }

        /* Card effects */
        .task-card {
            border-left: 3px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .task-card:hover {
            transform: translateY(-5px);
            border-left: 3px solid #4f46e5;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .hover-lift {
            transition: all 0.2s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
        }

        /* Task completion style */
        .task-completed {
            border-left: 3px solid #10b981;
            opacity: 0.75;
        }

        .task-completed .task-title {
            text-decoration: line-through;
            color: #9ca3af;
        }

        /* Status indicators */
        .status-badge {
            height: 8px;
            width: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .badge-urgent {
            background-color: #ef4444;
        }

        .badge-normal {
            background-color: #3b82f6;
        }

        .badge-low {
            background-color: #10b981;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4f46e5;
        }

        /* Gradient button */
        .btn-gradient {
            background-image: linear-gradient(to right, #4f46e5, #7c3aed);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background-image: linear-gradient(to right, #4338ca, #6d28d9);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* Task card progress */
        .progress-ring-container {
            position: relative;
            width: 36px;
            height: 36px;
        }

        .progress-ring-circle {
            fill: none;
            stroke-width: 3;
            stroke-linecap: round;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        .ring-background {
            stroke: #e5e7eb;
        }

        .ring-progress {
            stroke: #4f46e5;
            transition: stroke-dashoffset 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-col w-64 bg-white shadow-lg">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-gray-100">
                <a href="/home">
                <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">IIY</h1>
                </a>
            </div>

            <!-- User Profile -->
            <div class="p-4 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="https://m.media-amazon.com/images/M/MV5BZDcyMGU3MDEtODkwOS00ZGFlLTllNTAtMGExMDE3OTAzMjI5XkEyXkFqcGc@._V1_.jpg"
                             alt="{{ auth()->user()->name }}"
                             class="w-10 h-10 rounded-full object-cover border-2 border-indigo-100">
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</h2>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <div class="px-4 mb-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Dashboard</p>
                </div>

                <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-indigo-600 bg-indigo-50 border-r-4 border-indigo-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    Toate Task-urile
                </a>

                <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    În Așteptare
                </a>

                <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Completate
                </a>

                <div class="px-4 mt-6 mb-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Profil</p>
                </div>

                <a href="/profile" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>

                <a href="/home" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Despre noi
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Deconectare
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex items-center h-16 bg-white shadow-sm z-10">
                <div class="container mx-auto px-4 md:px-6 flex justify-between items-center">
                    <!-- Mobile menu button -->
                    <button class="md:hidden p-2 text-gray-600 hover:text-indigo-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Page title - Mobile visible -->
                    <h1 class="text-xl font-bold text-gray-800 md:hidden">IIY</h1>

                    <!-- Search bar -->
                    <div class="hidden md:block relative w-1/3">
                        <input type="text" placeholder="Caută task-uri..." class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <!-- Header actions -->
                    <div class="flex items-center space-x-3">
                        <button class="p-1.5 text-gray-500 hover:text-indigo-600 focus:outline-none relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <div class="border-r border-gray-200 h-6 mx-2"></div>
                        <div class="hidden md:flex items-center px-3 py-1.5 bg-indigo-700 rounded-lg">
                            <svg class="w-5 h-5 text-indigo-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-white font-medium text-sm">{{ Auth::user()->balance }} RON</span>
                        </div>
                        <div class="relative">
                            <button class="flex items-center space-x-2 hover:bg-gray-50 p-1 rounded-full focus:outline-none">
                                <a href="{{ route('profile') }}" class="relative">
                                    <img src="https://m.media-amazon.com/images/M/MV5BZDcyMGU3MDEtODkwOS00ZGFlLTllNTAtMGExMDE3OTAzMjI5XkEyXkFqcGc@._V1_.jpg"
                                         alt="{{ auth()->user()->name }}"
                                         class="w-8 h-8 rounded-full object-cover">
                                </a>
                                <span class="hidden lg:inline-block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <svg class="w-5 h-5 text-gray-400 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main scroll area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 px-4 py-8 md:px-6 lg:px-8">
                <div class="container mx-auto">
                    <!-- Page header -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Task-urile Tale</h2>
                            <p class="mt-1 text-sm text-gray-500">Gestionează și organizează sarcinile tale zilnice</p>
                        </div>

                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="/create" class="btn-gradient flex items-center px-4 py-2 bg-indigo-600 rounded-lg text-white text-sm font-medium shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span>Adaugă Task</span>
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Total Tasks -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 animated-card stat-card" style="--animation-order: 1;">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Tasks</p>
                                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $statsData['total'] ?? 12 }}</h3>
                                </div>
                                <div class="p-3 bg-blue-50 rounded-full text-blue-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-sm">
                                    <span class="text-green-500 font-medium flex items-center">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks in Progress -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 animated-card stat-card" style="--animation-order: 2;">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">În Progres</p>
                                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $statsData['pending'] ?? 4 }}</h3>
                                </div>
                                <div class="p-3 bg-indigo-50 rounded-full text-indigo-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ $statsData['pending'] / max($statsData['total'], 1) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Completed Tasks -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 animated-card stat-card" style="--animation-order: 3;">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Completate</p>
                                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $statsData['completed'] ?? 8 }}</h3>
                                </div>
                                <div class="p-3 bg-green-50 rounded-full text-green-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <span class="text-green-500 text-sm font-medium">
                                        {{ $statsData['completion_rate'] ?? 67 }}% rată de completare
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Penalties -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 animated-card stat-card" style="--animation-order: 4;">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Penalități</p>
                                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $statsData['total_penalties'] ?? 150 }} RON</h3>
                                </div>
                                <div class="p-3 bg-red-50 rounded-full text-red-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <span class="text-red-500 text-sm font-medium">
                                        {{ $statsData['overdue'] ?? 2 }} task-uri restante
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Filters -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <a href="/tasks" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none transition duration-150 ease-in-out">
                            Toate
                        </a>
                        <a href="/tasks?status=not-completed" class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-lg shadow-sm border border-gray-200 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out">
                            În Așteptare
                        </a>
                        <a href="/tasks?status=completed" class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-lg shadow-sm border border-gray-200 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out">
                            Completate
                        </a>
                        <div class="ml-auto">
                            <button class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-lg shadow-sm border border-gray-200 hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                                </svg>
                                Sortează
                            </button>
                        </div>
                    </div>

                    <!-- Task List -->
                    <div class="space-y-4">
                        <!-- If No Tasks -->
                        @if($tasks->isEmpty())
                            <div class="bg-white rounded-lg shadow-sm p-8 text-center border border-dashed border-gray-200 animated-card" style="--animation-order: 5;">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-800 mb-2">Nu ai niciun task încă</h3>
                                <p class="text-gray-500 mb-6">Adaugă primul tău task pentru a începe să îți organizezi activitățile!</p>
                                <a href="/create" class="btn-gradient inline-flex items-center justify-center px-5 py-2 bg-indigo-600 rounded-lg text-white shadow-sm hover:bg-indigo-700 transition duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span>Adaugă Primul Task</span>
                                </a>
                            </div>
                        <!-- Tasks List -->
                        @else
                            @foreach($tasks as $index => $task)
                                <div class="task-card bg-white rounded-lg shadow-sm overflow-hidden animated-card" style="--animation-order: {{ 5 + $index }};">
                                    <div class="flex flex-col md:flex-row md:items-center">
                                        <!-- Left side - Task details -->
                                        <div class="flex-1 p-5">
                                            <div class="flex items-start">
                                                <div class="mr-3 mt-1">
                                                    @if(!$task->completed)
                                                        <form method="POST" action="/task/{{ $task->id }}/complete">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="w-5 h-5 rounded-full border-2 border-indigo-500 hover:bg-indigo-100 transition-colors flex items-center justify-center focus:outline-none">
                                                            </button>
                                                        </form>
                                                    @else
                                                        <div class="w-5 h-5 rounded-full bg-green-500 border-2 border-green-500 flex items-center justify-center">
                                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="flex-1">
                                                    <div class="flex items-center">
                                                        <h3 class="text-lg font-semibold text-gray-800 task-title {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                                                            {{ $task->title }}
                                                        </h3>
                                                    </div>

                                                    <p class="mt-2 text-gray-600 {{ $task->completed ? 'text-gray-400' : '' }}">
                                                        {{ $task->description }}
                                                    </p>

                                                    <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                                                        @if($task->deadline)
                                                            <span class="inline-flex items-center text-gray-500 {{ $task->completed ? 'text-gray-400' : ((\Carbon\Carbon::parse($task->deadline) < now() && !$task->completed) ? 'text-red-500' : '') }}">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                {{ \Carbon\Carbon::parse($task->deadline)->format('d.m.Y H:i') }}

                                                                @if(\Carbon\Carbon::parse($task->deadline) < now() && !$task->completed)
                                                                    <span class="ml-1 text-red-500 font-medium">(Întârziat)</span>
                                                                @endif
                                                            </span>
                                                        @endif

                                                        @if(isset($task->price) && $task->price > 0)
                                                            <span class="inline-flex items-center text-gray-500 {{ $task->completed ? 'text-gray-400' : '' }}">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                Penalizare: {{ $task->price }} RON
                                                            </span>
                                                        @endif

                                                        <!-- Created at date -->
                                                        <span class="inline-flex items-center text-gray-400 text-xs">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                            Creat: {{ \Carbon\Carbon::parse($task->created_at)->format('d.m.Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right side - Task Actions -->
                                        <div class="flex md:flex-col items-center justify-end p-4 md:p-5 bg-gray-50 border-t md:border-t-0 md:border-l border-gray-100">
                                            <div class="flex flex-row md:flex-col space-x-3 md:space-x-0 md:space-y-3">
                                                @if(!$task->completed)
                                                    <!-- Complete task button - Mobile only -->
                                                    <form method="POST" action="/task/{{ $task->id }}/complete" class="md:hidden">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="p-2 bg-green-100 text-green-700 rounded-full hover:bg-green-200 transition-colors">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Edit button -->
                                                <a href="/task/{{ $task->id }}/edit" class="p-2 bg-indigo-100 text-indigo-700 rounded-full hover:bg-indigo-200 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>

                                                <!-- Delete button -->
                                                <form method="POST" action="/task/{{ $task->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-red-100 text-red-700 rounded-full hover:bg-red-200 transition-colors" onclick="return confirm('Ești sigur că vrei să ștergi acest task?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Completion progress indicator (visual element) -->
                                            @if($task->deadline && !$task->completed)
                                                <div class="hidden md:block mt-4">
                                                    <div class="progress-ring-container">
                                                        @php
                                                            $now = \Carbon\Carbon::now();
                                                            $created = \Carbon\Carbon::parse($task->created_at);
                                                            $deadline = \Carbon\Carbon::parse($task->deadline);
                                                            $totalDuration = $created->diffInSeconds($deadline);
                                                            $elapsedDuration = $created->diffInSeconds($now);
                                                            $progressPercent = min(100, ($elapsedDuration / max(1, $totalDuration)) * 100);
                                                            $dashOffset = 100 - $progressPercent;
                                                            $isLate = $now->gt($deadline);
                                                        @endphp

                                                        <svg class="progress-ring" width="36" height="36">
                                                            <circle class="ring-background" r="15" cx="18" cy="18" />
                                                            <circle
                                                                class="ring-progress"
                                                                r="15"
                                                                cx="18"
                                                                cy="18"
                                                                stroke="{{ $isLate ? '#ef4444' : '#4f46e5' }}"
                                                                stroke-dasharray="100"
                                                                stroke-dashoffset="{{ $dashOffset }}"
                                                            />
                                                        </svg>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="mt-8">
                                {{ $tasks->withQueryString()->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 py-4">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm">
                        <div>
                            <p>&copy; {{ date('Y') }}  IIY. Toate drepturile rezervate.</p>
                        </div>
                        <div class="mt-2 md:mt-0">
                            <ul class="flex space-x-4">
                                <li><a href="#" class="hover:text-indigo-600 transition-colors">Termeni și condiții</a></li>
                                <li><a href="#" class="hover:text-indigo-600 transition-colors">Politica de confidențialitate</a></li>
                                <li><a href="#" class="hover:text-indigo-600 transition-colors">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Animation delay for cards
        document.addEventListener('DOMContentLoaded', function() {
            const animatedCards = document.querySelectorAll('.animated-card');
            animatedCards.forEach(card => {
                setTimeout(() => {
                    card.style.opacity = '1';
                }, 100);
            });
        });

        // Progress circle calculation
        const calculateProgress = (created, deadline) => {
            const now = new Date();
            const createdDate = new Date(created);
            const deadlineDate = new Date(deadline);

            const totalDuration = deadlineDate - createdDate;
            const elapsedDuration = now - createdDate;

            let progressPercent = Math.min(100, (elapsedDuration / Math.max(1, totalDuration)) * 100);
            return 100 - progressPercent; // For stroke-dashoffset
        }
    </script>
</body>
</html>
