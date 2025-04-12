<x-layout>
    <link href="{{ asset('css/tasks.css') }}" rel="stylesheet">
    
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out hover-lift">
            <div class="flex flex-col h-full">
                <!-- Profile Section -->
                <div class="p-4 border-b border-gray-100 hover-lift">
                    <div class="flex items-center space-x-4">

                        <div class="relative">
                            <img src="https://m.media-amazon.com/images/M/MV5BZDcyMGU3MDEtODkwOS00ZGFlLTllNTAtMGExMDE3OTAzMjI5XkEyXkFqcGc@._V1_.jpg" alt="{{ auth()->user()->name }}" class="w-12 h-12 rounded-full">
                            <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="transform group-hover:translate-x-1 transition duration-300">
                            <h2 class="text-lg font-semibold text-gray-800">{{ auth()->user()->name }}</h2>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2">
                    <a href="/profile" class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-2 rounded-lg transition duration-300 transform hover:translate-x-2 hover-lift">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Profil</span>
                    </a>
                    <a href="/home" class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 p-2 rounded-lg transition duration-300 transform hover:translate-x-2 hover-lift">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Despre noi</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="md:ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm hover-lift">
                <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800 transform hover:scale-105 transition duration-300">TaskMaster Pro</h1>
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
            </header>

            <!-- Task List -->
            <main class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 transform hover:scale-105 transition duration-300">Task-urile Tale</h2>
                    <div class="flex items-center space-x-4">
                        @if (request()->query('status') === 'not-completed')
                            <a href="/tasks" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out transform hover:scale-105 hover-lift">
                                Toate Task-urile
                            </a>
                        @else
                            <a href="/tasks?status=not-completed" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out transform hover:scale-105 hover-lift">
                                Task-uri În Așteptare
                            </a>
                        @endif
                        <a href="/create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center space-x-2 transform hover:scale-105 hover:shadow-lg hover-lift">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span>Adaugă Task</span>
                        </a>
                    </div>
                </div>

                <!-- Task Cards -->
                <div class="grid grid-cols-1 gap-6">
                    @if($tasks->isEmpty())
                        <div class="bg-white rounded-lg shadow-lg p-6 text-center transform hover:scale-105 transition duration-300 hover-lift task-card">
                            <p class="text-gray-600">Nu ai niciun task încă. Adaugă unul nou pentru a începe!</p>
                        </div>
                    @else
                        @foreach($tasks as $task)
                            <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300 hover:shadow-xl hover-lift task-card {{ $task->completed ? 'task-completed' : '' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-semibold text-gray-800 transform hover:scale-105 transition duration-300 {{ $task->completed ? 'text-content' : '' }}">{{ $task->title }}</h3>
                                            @if(!$task->completed)
                                            <form method="POST" action="/task/{{ $task->id }}/complete" class="ml-4">
                                                @csrf
                                                @method('PATCH')
                                                <div class="flex items-center">
                                                    <input type="checkbox" 
                                                           name="completed" 
                                                           value="1" 
                                                           class="form-checkbox h-5 w-5 text-green-500 focus:ring-green-500 border-gray-300 rounded transform hover:scale-110 transition duration-300 hover-lift"
                                                           onchange="this.form.submit()">
                                                    <button type="submit" class="hidden">Update Status</button>
                                                </div>
                                            </form>
                                            @else
                                            <div class="ml-4 flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="text-green-600 font-medium">Completat!</span>
                                            </div>
                                            @endif
                                        </div>
                                        <p class="text-gray-600 mt-2 {{ $task->completed ? 'text-content' : '' }}">{{ $task->description }}</p>
                                        <div class="mt-4 flex items-center space-x-4">
                                            <span class="text-sm text-gray-500 flex items-center transform hover:scale-105 transition duration-300 hover-lift {{ $task->completed ? 'text-content' : '' }}">
                                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d.m.Y H:i') : 'Nespecificat' }}
                                            </span>
                                            <span class="text-sm text-gray-500 flex items-center transform hover:scale-105 transition duration-300 hover-lift {{ $task->completed ? 'text-content' : '' }}">
                                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Preț: {{ $task->price ?? 0 }} RON
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="/tasks/{{ $task->id }}/edit" class="text-indigo-600 hover:text-indigo-800 transform hover:scale-110 transition duration-300 hover-lift {{ $task->completed ? 'action-buttons' : '' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form method="POST" action="/task/{{ $task->id }}" id="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transform hover:scale-110 transition duration-300 hover-lift {{ $task->completed ? 'action-buttons' : '' }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mt-6">
                    {{ $tasks->links() }}
                </div>
            </main>
        </div>
    </div>

    <style>
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

        .task-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        /* Hover Effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Smooth Transitions */
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #f6f7fb 0%, #eef2ff 100%);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Card Hover Effects */
        .task-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        /* Button Hover Effects */
        button:hover, a:hover {
            transform: scale(1.05);
        }

        /* Input Focus Effects */
        input:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
        }
    </style>
</x-layout> 