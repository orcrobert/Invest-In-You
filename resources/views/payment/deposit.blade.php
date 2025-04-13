<x-layout>
    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden animated-card" style="--animation-order: 1;">
            <!-- Header with gradient background -->
            <div class="relative overflow-hidden pb-10">
                <!-- Background gradient and pattern -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-600">
                    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>
                
                <!-- Header Content -->
                <div class="relative pt-8 pb-6 px-6 md:px-8">
                    <h1 class="text-2xl font-bold text-white">Depune Fonduri</h1>
                    <p class="mt-2 text-blue-100">Adaugă bani în contul tău pentru a-ți gestiona task-urile</p>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute right-0 bottom-0 transform translate-y-1/3 translate-x-1/4">
                    <svg class="h-20 w-20 text-blue-200 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                <!-- Current Balance -->
                @auth
                <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Soldul tău curent</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ Auth::user()->balance ?? '0.00' }} RON</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                @endauth
                
                <!-- Deposit Form -->
                <form action="{{ route('payment.checkout') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Quick Amount Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sumă rapidă</label>
                        <div class="grid grid-cols-3 gap-3">
                            <button type="button" data-amount="10" class="amount-btn py-2 px-4 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 text-gray-700 font-medium rounded-md transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                10 ron
                            </button>
                            <button type="button" data-amount="50" class="amount-btn py-2 px-4 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 text-gray-700 font-medium rounded-md transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                50 ron
                            </button>
                            <button type="button" data-amount="100" class="amount-btn py-2 px-4 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 text-gray-700 font-medium rounded-md transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                100 ron
                            </button>
                        </div>
                    </div>
                    
                    <!-- Custom Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Sumă personalizată (ron)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">ron</span>
                            </div>
                            <input type="number" name="amount" id="amount" min="1" step="0.01" 
                                class="block w-full pl-10 pr-12 py-3 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="0.00" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">RON</span>
                            </div>
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Payment Options -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metodă de plată</label>
                        <div class="mt-1 grid grid-cols-3 gap-3">
                            <div class="relative bg-white border border-gray-300 rounded-md p-3 flex items-center justify-center hover:border-blue-500 transition-colors">
                                <input type="radio" name="payment_method" value="card" id="method-card" class="sr-only" checked>
                                <label for="method-card" class="cursor-pointer flex flex-col items-center">
                                    <span class="text-blue-600 bg-blue-50 rounded-full p-2 mb-2">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </span>
                                    <span class="text-sm font-medium text-gray-700">Card</span>
                                </label>
                                <div class="absolute -top-1 -right-1 h-5 w-5 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Depune Fonduri
                        </button>
                    </div>
                </form>
                
                <!-- Info Box -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-900">Informații despre depuneri</h3>
                            <div class="mt-2 text-sm text-gray-600">
                                <p>Fondurile vor fi adăugate instant în contul tău. Poți utiliza aceste fonduri pentru a crea task-uri cu penalități sau pentru a face alte operațiuni pe platformă.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // JavaScript to handle quick amount selection
        document.addEventListener('DOMContentLoaded', function() {
            const amountBtns = document.querySelectorAll('.amount-btn');
            const amountInput = document.getElementById('amount');
            
            amountBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const amount = this.getAttribute('data-amount');
                    amountInput.value = amount;
                    
                    // Remove active class from all buttons
                    amountBtns.forEach(b => b.classList.remove('bg-blue-100', 'text-blue-600'));
                    
                    // Add active class to clicked button
                    this.classList.add('bg-blue-100', 'text-blue-600');
                });
            });
        });
    </script>
</x-layout>