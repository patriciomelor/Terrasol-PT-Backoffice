setTimeout(function () {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.classList.remove('show');
        alert.classList.add('hide');
    }
}, 5000); // 5000 ms = 5 segundos

$(document).ready(function () {
    setTimeout(function () {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('hide');
        }
    }, 5000); // 5000 ms = 5 segundos

    // Inicializar Summernote
    $('.summernote').summernote({
        height: 200
    });

    $('#description').summernote({
        height: 200
    });

    $('#content').summernote({
        height: 200
    });

    // Inicializar Google Maps Autocomplete street

    function initAutocomplete() {
        const regionInput = document.getElementById('region');
        const ciudadInput = document.getElementById('city');
        const calleInput = document.getElementById('street');
    
        // Inicialmente deshabilitamos los inputs de ciudad y calle
        ciudadInput.disabled = true;
        calleInput.disabled = true;
    
        // Configuración para la búsqueda de regiones
        const regionAutocomplete = new google.maps.places.Autocomplete(regionInput, {
            types: ['(regions)'],
            componentRestrictions: { country: 'cl' }
        });
    
        let selectedCityPlaceId = null;
    
        // Manejo de la selección de la región
        regionAutocomplete.addListener('place_changed', function () {
            const place = regionAutocomplete.getPlace();
            if (place.geometry) {
                // Habilitar el input de ciudad después de seleccionar la región
                ciudadInput.disabled = false;
    
                // Configuración para la búsqueda de ciudades dentro de la región seleccionada
                const cityAutocomplete = new google.maps.places.Autocomplete(ciudadInput, {
                    types: ['(cities)'],
                    componentRestrictions: { country: 'cl' }
                });
    
                cityAutocomplete.addListener('place_changed', function () {
                    const place = cityAutocomplete.getPlace();
                    if (place.geometry) {
                        selectedCityPlaceId = place.place_id;
                        calleInput.disabled = false; // Habilitar el input de calle después de seleccionar la ciudad
                        loadStreets(selectedCityPlaceId);
                    }
                });
    
                const service = new google.maps.places.PlacesService(document.createElement('div'));
                service.getDetails({ placeId: place.place_id }, function (place, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        const bounds = new google.maps.LatLngBounds();
                        bounds.union(place.geometry.viewport);
                        cityAutocomplete.setBounds(bounds);
                    }
                });
            }
        });
    
        // Función para cargar calles dentro de la ciudad seleccionada
        function loadStreets(cityPlaceId) {
            const streetAutocomplete = new google.maps.places.Autocomplete(calleInput, {
                types: ['address'],
                componentRestrictions: { country: 'cl' }
            });
    
            streetAutocomplete.addListener('place_changed', function () {
                const place = streetAutocomplete.getPlace();
                if (place.geometry) {
                    console.log('Selected Street:', place.address_components[0].long_name);
                }
            });
    
            const service = new google.maps.places.PlacesService(document.createElement('div'));
            service.getDetails({ placeId: cityPlaceId }, function (place, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    const bounds = new google.maps.LatLngBounds();
                    bounds.union(place.geometry.viewport);
                    streetAutocomplete.setBounds(bounds);
                }
            });
        }
    }
    
    // Iniciar el script cuando la ventana cargue
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
    
});
