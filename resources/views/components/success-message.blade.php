@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        class="bg-green-500 text-white font-bold rounded px-4 py-3 mb-4 flex items-center justify-between"
    >
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="text-white ml-4">
            <i class='bx bx-x text-xl'></i>
        </button>
    </div>
@endif
