<x-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="relative overflow-hidden pb-10">
                <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-orange-500">
                    <div class="absolute inset-0 bg-pattern opacity-10"></div>
                </div>
                
                <div class="relative pt-8 pb-6 px-6 md:px-8">
                    <h1 class="text-2xl font-bold text-white">Solicită Rambursare</h1>
                    <p class="mt-2 text-red-100">Retrage fonduri din contul tău</p>
                </div>
                
                <div class="absolute bottom-0 left-0 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="text-white">
                        <path fill="currentColor" fill-opacity="1" d="M0,32L60,42.7C120,53,240,75,360,74.7C480,75,600,53,720,42.7C840,32,960,32,1080,37.3C1200,43,1320,53,1380,58.7L1440,64L1440,100L1380,100C1320,100,1200,100,1080,100C960,100,840,100,720,100C600,100,480,100,360,100C240,100,120,100,60,100L0,100Z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="px-6 py-8 md:px-8">
                <!-- Current Balance -->
                <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-700">Soldul tău curent</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($user->balance, 2) }} RON</p>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-full">
                            <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                @if($user->balance > 0)
                    <!-- Refund Form -->
                    <form method="POST" action="{{ route('payment.process-refund') }}" class="mb-8">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700">Suma pentru rambursare (RON)</label>
                                <div class="mt-1 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500"></span>
                                    </div>
                                    <input type="number" name="amount" id="amount" step="0.01" min="1" max="{{ $user->balance }}" 
                                        class="pl-8 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Introdu suma">
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Poți solicita maxim {{ number_format($user->balance, 2) }} RON</p>
                            </div>
                            
                            <div>
                                <label for="bank_account" class="block text-sm font-medium text-gray-700">Cont bancar (IBAN)</label>
                                <input type="text" name="bank_account" id="bank_account" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="RO00 XXXX XXXX XXXX XXXX XXXX">
                                <p class="mt-1 text-sm text-gray-500">Contul în care vei primi banii</p>
                            </div>
                            
                            <div>
                                <label for="reason" class="block text-sm font-medium text-gray-700">Motivul rambursării</label>
                                <select name="reason" id="reason" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="no_longer_needed">Nu mai am nevoie de serviciu</option>
                                    <option value="service_issue">Probleme cu serviciul</option>
                                    <option value="funds_withdrawal">Retragere fonduri</option>
                                    <option value="other">Alt motiv</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="details" class="block text-sm font-medium text-gray-700">Detalii suplimentare (opțional)</label>
                                <textarea name="details" id="details" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Detalii despre solicitarea ta"></textarea>
                            </div>
                            
                            <div class="pt-4">
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-4 rounded-md shadow-sm transition duration-150">
                                    Solicită Rambursare
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <!-- No Balance Warning -->
                    <div class="text-center p-8 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Nicio sumă disponibilă pentru rambursare</h3>
                        <p class="text-gray-600 mb-4">Nu ai fonduri disponibile în cont pentru a solicita o rambursare.</p>
                        <a href="{{ route('payment.deposit.form') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            Adaugă Fonduri
                        </a>
                    </div>
                @endif
                
                <!-- Information -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-900">Despre rambursări</h3>
                            <div class="mt-2 text-sm text-gray-600">
                                <p>Rambursările sunt procesate în termen de 3-5 zile lucrătoare. Vei primi un email de confirmare când rambursarea ta a fost procesată.</p>
                            </div>
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