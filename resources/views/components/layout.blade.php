<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TaskMaster Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f7fb 0%, #eef2ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        .animate-bounce {
            animation: bounce 0.8s infinite;
        }

        .animated-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            animation-delay: calc(var(--animation-order) * 0.1s);
        }
        
        /* Card and element effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
        
        /* Form inputs and labels */
        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3);
            border-color: #4f46e5;
        }
        
        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
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
        
        /* Main content wrapper to ensure footer is at bottom */
        .content-wrapper {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
        }
        
        /* Fixed footer */
        .footer {
            flex-shrink: 0;
            position: sticky;
            bottom: 0;
            width: 100%;
            z-index: 10;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Navigation Bar -->
        <nav class="bg-gradient-to-r from-indigo-800 to-indigo-900 shadow-md">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <!-- Logo and Brand -->
                    <div class="flex items-center">
                        <div class="ml-4">
                            <a href="/" class="text-2xl font-bold text-white">TaskMaster Pro</a>
                        </div>
                    </div>
                    
                    <!-- Navigation Links (Hidden on mobile) -->
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-center space-x-6">
                            @auth
                            <a href="/tasks" class="text-white hover:bg-indigo-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">Dashboard</a>
                            <a href="/deposit" class="text-indigo-200 hover:bg-indigo-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">Deposit</a>
                            <a href="/refund" class="text-indigo-200 hover:bg-indigo-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">Withdraw</a>
                            @endauth
                        </div>
                    </div>
                    
                    <!-- Right side menu -->
                    <div class="flex items-center">
                        @guest
                        <div class="flex items-center space-x-3">
                            <a href="/login" class="text-white bg-indigo-700 hover:bg-indigo-600 px-4 py-2 rounded-md text-sm font-medium transition-all duration-150">Log In</a>
                            <a href="/register" class="text-indigo-200 hover:text-white border border-indigo-400 hover:border-white px-4 py-2 rounded-md text-sm font-medium transition-all duration-150">Sign Up</a>
                        </div>
                        @endguest

                        @auth
                        <div class="flex items-center space-x-4">
                            <!-- Balance Display -->
                            <div class="hidden md:flex items-center px-3 py-1.5 bg-indigo-700 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-white font-medium text-sm">{{ Auth::user()->balance }} RON</span>
                            </div>

                            <!-- User Menu (Desktop) -->
                            <div class="hidden md:block relative">
                                <button type="button" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-800" id="user-menu-button">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </button>
                                <!-- User Dropdown Menu (hidden by default) -->
                                <div class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" id="user-dropdown">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profilul Tău</a>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Deconectare</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Mobile Menu Button -->
                            <button type="button" class="md:hidden bg-indigo-700 inline-flex items-center justify-center p-2 rounded-md text-indigo-200 hover:text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-800 focus:ring-white" id="mobile-menu-button">
                                <span class="sr-only">Open main menu</span>
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>

                            <!-- Logout Button (Desktop) -->
                            <form method="POST" action="/logout" class="hidden md:block">
                                @csrf
                                <button type="submit" class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    @auth
                    <a href="/tasks" class="block text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                    <a href="/deposit" class="block text-indigo-200 hover:bg-indigo-700 hover:text-white px-3 py-2 rounded-md text-base font-medium">Deposit</a>
                    <a href="/contact" class="block text-indigo-200 hover:bg-indigo-700 hover:text-white px-3 py-2 rounded-md text-base font-medium">Contact</a>

                    <!-- Balance (Mobile) -->
                    <div class="flex items-center px-3 py-2">
                        <svg class="w-5 h-5 text-indigo-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-white font-medium">{{ Auth::user()->balance }} RON</span>
                    </div>
                    @endauth
                </div>
                
                @auth
                <div class="border-t border-indigo-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div class="shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-indigo-200">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-indigo-200 hover:bg-indigo-700 hover:text-white">Profilul Tău</a>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-indigo-200 hover:bg-indigo-700 hover:text-white w-full text-left">Deconectare</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </nav>

        <!-- Page Header -->
        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">
                    <!-- Page title will be inserted here -->
                </h1>
                @auth
                <div class="flex space-x-2">
                    <!-- Header action buttons can go here -->
                </div>
                @endauth
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 pb-16">
                {{ $slot }}
            </div>
        </main>
    </div>
        
    <!-- Footer - Fixed at bottom -->
    <footer class="footer bg-white border-t border-gray-200 shadow-md">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm">
                <div>
                    <p>&copy; {{ date('Y') }} TaskMaster Pro. Toate drepturile rezervate.</p>
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

    <!-- Chat Widget -->
    <div class="fixed bottom-20 md:bottom-4 right-4 z-50">
        <!-- Chat Button -->
        <button id="chatButton" class="btn-gradient text-white p-3 rounded-full shadow-lg hover:shadow-xl transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
        </button>

        <!-- Chat Window -->
        <div id="chatWindow" class="hidden fixed bottom-36 md:bottom-20 right-4 w-80 h-96 bg-white rounded-lg shadow-xl flex flex-col overflow-hidden border border-gray-200 animated-card" style="--animation-order: 1;">
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white p-3 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-medium">AI Asistent</h3>
                </div>
                <button id="closeChat" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Chat Messages -->
            <div id="chatMessages" class="flex-1 p-4 overflow-y-auto bg-gray-50">
                <div class="bg-white rounded-lg p-3 mb-4 shadow-sm border border-gray-100 max-w-[85%]">
                    <p class="text-sm text-gray-700">Bună! Sunt aici să te ajut. Cu ce te pot ajuta astăzi?</p>
                </div>
            </div>

            <template id="loadingTemplate">
                <div class="flex items-center space-x-2 p-3 bg-gray-50 rounded-lg max-w-[85%]">
                    <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                    <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
            </template>

            <!-- Chat Input -->
            <div class="p-3 border-t border-gray-200 bg-white">
                <form id="chatForm" class="flex space-x-2">
                    <input type="text" id="chatInput" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Scrie un mesaj...">
                    <button type="submit" class="btn-gradient text-white px-3 py-2 rounded-lg hover:shadow-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
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
            // User Menu Toggle (Desktop)
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');
            
            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', () => {
                    userDropdown.classList.toggle('hidden');
                });
                
                // Close the dropdown when clicking outside
                document.addEventListener('click', (event) => {
                    if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
            
            // Mobile Menu Toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Chat Functionality
            const chatButton = document.getElementById('chatButton');
            const chatWindow = document.getElementById('chatWindow');
            const closeChat = document.getElementById('closeChat');
            const chatForm = document.getElementById('chatForm');
            const chatInput = document.getElementById('chatInput');
            const chatMessages = document.getElementById('chatMessages');

            // Toggle chat window
            if (chatButton && chatWindow) {
                chatButton.addEventListener('click', () => {
                    chatWindow.classList.toggle('hidden');
                    if (!chatWindow.classList.contains('hidden')) {
                        chatWindow.style.opacity = '1';
                    }
                });
            }

            // Close chat window
            if (closeChat && chatWindow) {
                closeChat.addEventListener('click', () => {
                    chatWindow.classList.add('hidden');
                });
            }

            // Handle chat form submission
            if (chatForm && chatInput && chatMessages) {
                chatForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const message = chatInput.value.trim();
                    if (message) {
                        // Add user message
                        addMessage(message, 'user');
                        chatInput.value = '';

                        const loadingDiv = showLoading();
                        getAIResponse(message).then(response => {
                            addMessage(response, 'ai');
                            loadingDiv.remove();
                        });
                    }
                });
            }

            async function getAIResponse(message) {
                try {
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 30000); // 30 second timeout

                    const response = await fetch('/ai/response', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ message }),
                        signal: controller.signal
                    });

                    clearTimeout(timeoutId);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    return data.success ? data.message : 'Sorry, there was an error processing your request.';
                } catch (error) {
                    console.error('Error getting AI response:', error);
                    if (error.name === 'AbortError') {
                        return 'Sorry, the request took too long. Please try again.';
                    }
                    return 'Îmi pare rău, dar momentan nu sunt conectat la API-ul de AI. Această funcționalitate va fi implementată în curând!';
                }
            } 

            function showLoading() {
                const template = document.getElementById('loadingTemplate');
                const loading = template.content.cloneNode(true);
                const loadingDiv = document.createElement('div');
                loadingDiv.className = 'loading-indicator mb-4';
                loadingDiv.appendChild(loading);
                chatMessages.appendChild(loadingDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                return loadingDiv;
            }

            function addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `mb-4 ${sender === 'user' ? 'ml-auto' : ''}`;
                
                const messageContent = document.createElement('div');
                messageContent.className = `rounded-lg p-3 shadow-sm max-w-[85%] ${sender === 'user' ? 'bg-indigo-600 text-white ml-auto' : 'bg-white border border-gray-100 text-gray-700'}`;
                messageContent.innerHTML = `<p class="text-sm">${text}</p>`;
                
                messageDiv.appendChild(messageContent);
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
            
            // Add animation for all cards
            const animatedCards = document.querySelectorAll('.animated-card');
            animatedCards.forEach((card, index) => {
                card.style.setProperty('--animation-order', index + 1);
                setTimeout(() => {
                    card.style.opacity = '1';
                }, 100);
            });

            function showLoading() {
                const template = document.getElementById('loadingTemplate');
                const loading = template.content.cloneNode(true);
                const loadingDiv = document.createElement('div');
                loadingDiv.className = 'loading-indicator mb-4';
                loadingDiv.appendChild(loading);
                chatMessages.appendChild(loadingDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                return loadingDiv;
            }
        });
    </script>
</body>
</html>