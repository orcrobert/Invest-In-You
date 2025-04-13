<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-4">Deposit Funds</h1>
        <form action="{{ route('payment.checkout') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount (€):</label>
                <input type="number" id="amount" name="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Deposit
            </button>
        </form>
    </div>
</x-layout>