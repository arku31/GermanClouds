<div class="container mx-auto" wire:init="loadCities" >
    <div class="flex h-screen">
        <div class="relative w-4/5" >
            <div id="map" class="w-full h-full" wire:ignore></div>
        </div>

        <!-- Правая часть (20% ширины) -->
        <div class="w-1/5 flex flex-col">
            <ul class="divide-y divide-gray-200 overflow-y-auto max-h-[calc(50vh-2rem)] p-4">
                @foreach($cities as $city)
                    <li class="city-marker py-3 px-4 hover:bg-gray-50 cursor-pointer rounded-lg transition-colors duration-200 flex items-center space-x-3" data-lat="{{ $city['city']['lat'] }}" data-lon="{{ $city['city']['lon'] }}">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ $city['city']['name'] }}</span>
                    </li>
                   
                @endforeach
            </ul>
            <!-- Верхняя часть с кнопками управления -->
            <div class="h-1/2 p-4 bg-white border-l border-gray-200">
                <div class="mb-4">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <x-button wire:click="setWinter" class="w-full {{ $selectedSeason === 'winter' ? 'bg-green-700' : 'bg-gray-100' }}">Зима</x-button>
                    <x-button wire:click="setSpring" class="w-full {{ $selectedSeason === 'spring' ? 'bg-green-700' : 'bg-gray-100' }}">Весна</x-button>
                    <x-button wire:click="setSummer" class="w-full {{ $selectedSeason === 'summer' ? 'bg-green-700' : 'bg-gray-100' }}">Лето</x-button>
                    <x-button wire:click="setAutumn" class="w-full {{ $selectedSeason === 'autumn' ? 'bg-green-700' : 'bg-gray-100' }}">Осень</x-button>
                    <x-button wire:click="setFullYear" class="w-full col-span-2 {{ $selectedSeason === 'full' ? 'bg-green-700' : 'bg-gray-100' }}">Год целиком</x-button>
                </div>
            </div>

            <!-- Нижняя часть с таблицей -->
            <div class="h-1/2 p-4 bg-white border-l border-t border-gray-200">
                table
            </div>
        </div>
    </div>
</div>

