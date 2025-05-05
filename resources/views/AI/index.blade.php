<x-doctor-layout>
    <div class="w-full flex justify-center items-center mt-10">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">💬 Ask ClinicBERT AI</h2>

            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('chat.ask') }}" class="flex flex-col gap-4">
                @csrf
                <input
                    type="text"
                    name="question"
                    placeholder="Type your medical question..."
                    class="border border-gray-300 rounded p-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                    required
                >
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded text-lg">
                    Ask
                </button>
            </form>

            @if(session('question'))
                <div class="mt-6 p-4 bg-gray-100 rounded text-gray-700">
                    <p><strong>You:</strong> {{ session('question') }}</p>
                    <p><strong>ClinicBERT:</strong> {{ session('response') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-doctor-layout>
