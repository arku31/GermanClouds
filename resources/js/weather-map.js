document.addEventListener('livewire:initialized', function () {
    console.log('livewire:initialized');
    var map = L.map('map').setView([50.0, 10.0], 4); // Центр Европы

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    Livewire.on('citiesLoaded', function([cities]) {
        cities.forEach(function(city) {
            L.marker([city.city.lat, city.city.lon])
                .addTo(map)
                .bindTooltip(city.city.name + ', ' + city.avg_cloudiness.toFixed(2), {
                    permanent: true,
                    direction: 'right'
                });
        });
    });
}); 