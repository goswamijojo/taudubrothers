
                <style>
                    #mapCanvas {
                    height: 400px;
                    width: 100%;
                    }
                </style>
           
           
                <div id="mapCanvas"></div>
                <script>
                    function initMap() {
                        var map;
                        var bounds = new google.maps.LatLngBounds();
                        var mapOptions = {
                            mapTypeId: 'roadmap'
                        };

                        map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
                        map.setTilt(50);

                        var markers = <?php echo $marker; ?>

                        // Add multiple markers to map
                        var infoWindow = new google.maps.InfoWindow(), marker, i;

                        // Place each marker on the map  
                        for( i = 0; i < markers.length; i++ ) {
                            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                            bounds.extend(position);
                            marker = new google.maps.Marker({
                                position: position,
                                map: map,
                                title: markers[i][0]
                            });                                           


                            // Center the map to fit all markers on the screen
                            map.fitBounds(bounds);
                        }

                        // Set zoom level
                        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                            this.setZoom(14);
                            google.maps.event.removeListener(boundsListener);
                        });

                    }
                    // Load initialize function
                    google.maps.event.addDomListener(window, 'load', initMap);
                </script>
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCl-JK5usUBFwjG7Y0s9Ef3fSoPV0QTk&callback=initMap"></script>
        