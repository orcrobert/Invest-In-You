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
                    <h1 class="text-2xl font-bold text-white">Editează Task</h1>
                    <p class="mt-2 text-indigo-100">Actualizează detaliile task-ului tău</p>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute right-0 bottom-0 transform translate-y-1/3 translate-x-1/4">
                    <svg class="h-20 w-20 text-indigo-200 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
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
                <!-- Single form for updating task only -->
                <form method="POST" action="/task/{{ $task->id }}" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Title Field -->
                        <div class="col-span-full">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titlu<span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="title" id="title" value="{{ $task->title }}" 
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
                                    placeholder="Spală toate vasele murdare din chiuvetă">{{ $task->description }}</textarea>
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
                                <input type="date" name="deadline" id="deadline" value="{{ $task->deadline }}" 
                                    class="w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150">
                            </div>
                            @error('deadline')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Price/Penalty Field, if needed for edit -->
                        <div class="md:col-span-1">
                            <label for="price" class="block text-sm font-medium text-gray-700">Penalizare (RON)</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="number" name="price" id="price" value="{{ $task->price }}" 
                                    class="w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150"
                                    placeholder="50" {{ !isset($task->price) ? 'readonly' : '' }}>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Această valoare nu poate fi modificată după creare</p>
                        </div>
                        
                        <!-- Priority Field (Optional - Only if your task model has this field) -->
                        <div class="md:col-span-1">
                            <label for="priority" class="block text-sm font-medium text-gray-700">Prioritate</label>
                            <div class="mt-1">
                                <select name="priority" id="priority" 
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150">
                                    <option value="low" {{ isset($task->priority) && $task->priority == 'low' ? 'selected' : '' }}>Scăzută</option>
                                    <option value="medium" {{ !isset($task->priority) || $task->priority == 'medium' ? 'selected' : '' }}>Medie</option>
                                    <option value="high" {{ isset($task->priority) && $task->priority == 'high' ? 'selected' : '' }}>Ridicată</option>
                                </select>
                            </div>
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
                    
                    <!-- Completion Status -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center">
                            <div class="h-5 w-5 {{ $task->completed ? 'bg-green-500' : 'border-2 border-gray-300' }} rounded-full mr-3 flex items-center justify-center">
                                @if($task->completed)
                                <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-gray-700">
                                {{ $task->completed ? 'Task-ul a fost marcat ca finalizat' : 'Task-ul este încă în progres' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Form Actions - Simplified without delete button -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <a href="/tasks" class="py-2.5 px-4 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150">
                            Înapoi la listă
                        </a>
                        
                        <button type="submit" class="btn-gradient py-2.5 px-6 rounded-lg text-white shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Salvează Modificările
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Status Section -->
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 rounded-b-xl">
                <div class="flex items-start">
                    <div class="shrink-0">
                        <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Informație</h3>
                        <div class="mt-2 text-sm text-gray-600">
                            <p>Acest task a fost creat la data de {{ \Carbon\Carbon::parse($task->created_at)->format('d.m.Y') }}</p>
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