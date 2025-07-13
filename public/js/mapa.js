function loadMap() {
    const googleMapsApiKey = "{{ config('google.maps_api_key') }}"; // Asegúrate de tener esta configuración en tu archivo .env

    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${googleMapsApiKey}&callback=initMap`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);

    window.initMap = function() {
        var negocioUbicacion = { lat: 16.784052885104977, lng: -93.09114388534609 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: negocioUbicacion
        });

        var marker = new google.maps.Marker({
            position: negocioUbicacion,
            map: map,
            title: 'MÍA RENTAS'
        });

        var infoContent = `
            <div style="font-size: 16px; width: 200px;">
                <h3>Mía Renta</h3>
                <p><strong>Dirección:</strong> Calle Aguiluchos #291</p>
                <p><strong>Teléfono:</strong> +52 961 458 5559</p>
                <p><strong>Horario:</strong> Lunes a Domingo, 9 AM - 8 PM</p>
            </div>
        `;

        var infoWindow = new google.maps.InfoWindow({
            content: infoContent
        });

        marker.addListener('click', function() {
            infoWindow.open(map, marker);
        });
    };
}
