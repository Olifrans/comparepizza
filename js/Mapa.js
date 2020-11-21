var boton = document.getElementById('boton');
boton.addEventListener('click', function() {
    findMe();
});


var arregloPines = [];

function findMe() {
    var divConte = document.getElementById('map');
    if (navigator.geolocation) {
        divConte.innerHTML = "<p> Seu navegador suporta geolocalização</p>";
    } else {
        divConte.innerHTML = "<p> Não suporta</p>";
    }
    navigator.geolocation.getCurrentPosition(localizacion, error);

    function localizacion(posicion) {
        var latitude = posicion.coords.latitude;
        var longitude = posicion.coords.longitude;
        var latLng = new google.maps.LatLng(latitude, longitude);
        $('#enviarMub').val(latLng);
        var comparepizza = {
            lat: -23.5489,
            lng: -46.6388
        };
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 19,
            gestureHandling: 'cooperative',
            center: { lat: -23.5489, lng: -46.6388 }
        });
        directionsDisplay.setMap(map);
        comparepizzaInfo(map, comparepizza);
        pizzariaInfo(map, latLng);
        calculateAndDisplayRoute(comparepizza, latLng, directionsService, directionsDisplay);
        map.addListener('click', function(e) {
            var nuevaUbi = e.latLng;
            for (var i in arregloPines) {
                arregloPines[i].setMap(null);
            }
            // map.setDirections(null);
            comparepizzaInfo(map, comparepizza);
            pizzariaInfo(map, nuevaUbi);
            $('#enviarMub').val(nuevaUbi);
            calculateAndDisplayRoute(comparepizza, nuevaUbi, directionsService, directionsDisplay);
        });
    };

    function calculateAndDisplayRoute(comparepizza, latLng, directionsService, directionsDisplay) {
        directionsService.route({
            origin: latLng,
            destination: comparepizza,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('A solicitação de rota falhou devido a ' + status);
            }
        });
    }

    function error() {
        alert("Não foi possível obter seu local");
    }
}

function localizacaoComparepizza() {
    var comparepizza = {
        lat: -23.5489,
        lng: -46.6388
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: comparepizza,
        zoom: 19,
        gestureHandling: 'cooperative'
    });
    comparepizzaInfo(map, comparepizza);
}


function comparepizzaInfo(map, comparepizza) {
    var contentString = '<div id="contenedor-infoMarker">' +
        '<div id="cont-img"><img src="imgpg/comparepizza.jpg" alt="" id="infoMarker">' +
        '</div>' +
        '<div id="info">' +
        '<h1>ComparePizza</h1>' +
        '<p>Somos a ComparePizza, temos uma variedade de pizzas e sabores diferentes $80.00 MX, ven y conócenos en: Av. Revolución #825, Barrio del Dulce Nome, frente a Elektra segunda planta, Chilapa de Álvarez, Gro. Horarios: 10:00am a 6:00pm.</p>' +
        '<p>Visite-nos no nosso Facebook:<a href="https://www.facebook.com/ComparePizzaNew/">' +
        '@ComedorOriental</a></p>' +
        '</div>' +
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    var marker = new google.maps.Marker({
        map: map,
        position: comparepizza,
        title: 'ComparePizza'
    });
    arregloPines.push(marker);
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
}

function pizzariaInfo(map, latLng) {
    var contentStringCli = '<div id="conte-pizzaria">' +
        '<div id="cont-imgcli"><img src="imgpg/pizzarialocalizacao.png" alt="" id="pizzaria">' +
        '</div>' +
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentStringCli
    });
    var marker = new google.maps.Marker({
        map: map,
        position: latLng,
        title: 'YO'
    });
    arregloPines.push(marker);
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
};