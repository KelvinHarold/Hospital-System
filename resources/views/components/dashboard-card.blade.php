@props(['title', 'count', 'icon'])

<div class="bg-white shadow rounded-lg p-4 flex items-center space-x-4">
    <div class="text-blue-500 text-3xl">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <div>
        <div class="text-lg font-semibold">{{ $title }}</div>
        <div class="text-2xl">{{ $count }}</div>
    </div>
</div>
