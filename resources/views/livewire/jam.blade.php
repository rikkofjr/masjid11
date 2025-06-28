<x-filament-widgets::widget>
    <x-filament::section>
        <div x-data="{ 
    time: '', 
    date: '' 
}" 
x-init="
    setInterval(() => {
        const now = new Date();
        time = now.toLocaleTimeString();
        date = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    }, 1000);
">
    <div class="w-full text-center p-4 bg-white shadow rounded-lg">
        <h2 class="text-lg font-semibold" x-text="date"></h2>
        <p class="text-3xl font-bold text-gray-800" x-text="time"></p>
    </div>
</div>

    </x-filament::section>
</x-filament-widgets::widget>
