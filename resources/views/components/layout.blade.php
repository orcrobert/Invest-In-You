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

    <!-- Chat Widget -->
    <div class="fixed bottom-4 right-4 z-50">
        <!-- Chat Button -->
        <button id="chatButton" class="bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 transition duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
        </button>

        <!-- Chat Window -->
        <div id="chatWindow" class="hidden fixed bottom-20 right-4 w-80 h-96 bg-white rounded-lg shadow-xl flex flex-col">
            <!-- Chat Header -->
            <div class="bg-indigo-600 text-white p-3 rounded-t-lg flex justify-between items-center">
                <h3 class="font-semibold">AI Asistent</h3>
                <button id="closeChat" class="text-white hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Chat Messages -->
            <div id="chatMessages" class="flex-1 p-4 overflow-y-auto">
                <div class="bg-indigo-50 rounded-lg p-3 mb-4">
                    <p class="text-sm text-gray-700">Bună! Sunt aici să te ajut. Cu ce te pot ajuta astăzi?</p>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="p-4 border-t">
                <form id="chatForm" class="flex space-x-2">
                    <input type="text" id="chatInput" class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Scrie un mesaj...">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatButton = document.getElementById('chatButton');
            const chatWindow = document.getElementById('chatWindow');
            const closeChat = document.getElementById('closeChat');
            const chatForm = document.getElementById('chatForm');
            const chatInput = document.getElementById('chatInput');
            const chatMessages = document.getElementById('chatMessages');

            // Toggle chat window
            chatButton.addEventListener('click', () => {
                chatWindow.classList.toggle('hidden');
            });

            // Close chat window
            closeChat.addEventListener('click', () => {
                chatWindow.classList.add('hidden');
            });

            // Handle chat form submission
            chatForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const message = chatInput.value.trim();
                if (message) {
                    // Add user message
                    addMessage(message, 'user');
                    chatInput.value = '';

                    // TODO: Connect to AI API here
                    // For now, just add a dummy response
                    setTimeout(() => {
                        addMessage('Îmi pare rău, dar momentan nu sunt conectat la API-ul de AI. Această funcționalitate va fi implementată în curând!', 'ai');
                    }, 1000);
                }
            });

            function addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `mb-4 ${sender === 'user' ? 'ml-auto' : ''}`;
                
                const messageContent = document.createElement('div');
                messageContent.className = `rounded-lg p-3 ${sender === 'user' ? 'bg-indigo-600 text-white' : 'bg-indigo-50'}`;
                messageContent.innerHTML = `<p class="text-sm">${text}</p>`;
                
                messageDiv.appendChild(messageContent);
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
</body>


</html>
