<div>
    <section>
        <h1 class="font-bold text-center text-zinc-900">Nuestra Ubicación</h1>
    </section>

<section class="border-8">

    <!-- Contenedor del mapa -->
    <div id="map" class="w-screen h-96"></div>
</section>

<section class="flex justify-center">

<a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="https://plus.unsplash.com/premium_photo-1668073439372-2ceafa1222b7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c2lsbGFzfGVufDB8fDB8fHww" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-center text-gray-900 dark:text-white">MÍA RENTA</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dirección:
            C. Aguiluchos
            Fracc. Las Aguilas | C.P. 29049
            Tuxtla Gutiérrez, Chiapas


            Horario:
            Lunes a Viernes
            De 9:00 am – 9:00 pm
            Sábados y Domingos
            De 9:00 am – 9:00 pm</p>
    </div>
</a>

</section>
@push('js')
<script>
    // Obtener la clave de Google Maps desde la configuración de Laravel
    const googleMapsApiKey = "{{ config('google.maps_api_key') }}";
</script>

<!-- Agregar el enlace a la API de Google Maps con la clave dinámica -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('google.maps_api_key') }}&callback=initMap" async defer></script>

<script>
    function initMap() {
        // Definir la ubicación de tu negocio (latitud y longitud)
        var negocioUbicacion = { lat: 16.784052885104977, lng: -93.09114388534609 };  // Reemplaza con las coordenadas correctas de tu negocio

        // Crear el mapa centrado en la ubicación del negocio
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,  // Ajusta el nivel de zoom (el valor puede ser más grande para acercar más el mapa)
            center: negocioUbicacion
        });

        // Crear un marcador en la ubicación del negocio
        var marker = new google.maps.Marker({
            position: negocioUbicacion,
            map: map,
            title: 'MÍA RENTAS'  // Título que se mostrará cuando pase el ratón sobre el marcador
        });

        // Crear el contenido del InfoWindow (la información que aparecerá al hacer clic)
        var infoContent = `
            <div style="font-size: 16px; width: 200px;">
                <h3>Mía Renta</h3>
                <p><strong>Dirección:</strong> Calle Aguiluchos #291</p>
                <p><strong>Teléfono:</strong> +52 961 458 5559</p>
                <p><strong>Horario:</strong> Lunes a Domingo, 9 AM - 8 PM</p>
            </div>
        `;

        // Crear un InfoWindow con la información del negocio
        var infoWindow = new google.maps.InfoWindow({
            content: infoContent
        });

        // Mostrar el InfoWindow al hacer clic en el marcador
        marker.addListener('click', function() {
            infoWindow.open(map, marker);
        });
    }
</script>
@endpush

</div>
