$(document).ready(function() {
    setTimeout(function() {
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

    // Inicializar Google Maps Autocomplete
    function initAutocomplete() {
        const regionInput = document.getElementById('region');
        const ciudadInput = document.getElementById('city');
        const calleInput = document.getElementById('street');
        const regionOptions = {
            types: ['(regions)'],
            componentRestrictions: { country: 'cl' }
        };

        const regionAutocomplete = new google.maps.places.Autocomplete(regionInput, regionOptions);
        let selectedCityPlaceId = null;

        regionAutocomplete.addListener('place_changed', function () {
            const place = regionAutocomplete.getPlace();
            if (place.geometry) {
                const cityOptions = {
                    types: ['(cities)'],
                    componentRestrictions: { country: 'cl' }
                };

                const cityAutocomplete = new google.maps.places.Autocomplete(ciudadInput, cityOptions);
                cityAutocomplete.addListener('place_changed', function () {
                    const place = cityAutocomplete.getPlace();
                    if (place.geometry) {
                        console.log('Select city:', place.address_components[0].long_name);
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
    }

    google.maps.event.addDomListener(window, 'load', initAutocomplete);
});
// Mostrar loader al hacer una petición o al cambiar de página
$(document).ready(function () {
    $(document).on('ajaxStart', function () {
        $("#loader").show();
    }).on('ajaxStop', function () {
        $("#loader").hide();
    });

    // Mostrar loader al enviar formularios
    $('form').on('submit', function () {
        $("#loader").show();
    });

    // Ocultar loader cuando la página esté completamente cargada
    $(window).on('load', function () {
        $("#loader").fadeOut('slow');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var iconPickerModal = new bootstrap.Modal(document.getElementById('iconPickerModal'));

    document.getElementById('selectIcon').addEventListener('click', function () {
        iconPickerModal.show();
    });

    document.querySelectorAll('#iconPickerModal .modal-body i').forEach(function (iconElement) {
        iconElement.addEventListener('click', function () {
            var iconClass = this.getAttribute('data-icon');
            document.getElementById('icon').value = iconClass;
            document.getElementById('icon-preview').className = 'fas ' + iconClass;
            iconPickerModal.hide();
        });
    });
});
