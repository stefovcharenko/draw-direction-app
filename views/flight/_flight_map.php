<?php
/* @var array $preferable */
/* @var array $real */
/* @var array $approximated */
?>
<div id="map" style="height: 100%"></div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: {lat: 50, lng: 30},
            mapTypeId: 'terrain'
        });
    <?php if (!empty($preferable)):?>
        var flightPreferPlanCoordinates = <?= str_replace('"', '', json_encode($preferable))?>;
        var flightPreferPath = new google.maps.Polyline({
            path: flightPreferPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF8E2F',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        flightPreferPath.setMap(map);
    <?php endif; ?>
    <?php if (!empty($real)):?>
        var flightRealPlanCoordinates = <?= str_replace('"', '', json_encode($real))?>;
        var flightRealPath = new google.maps.Polyline({
            path: flightRealPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF2C2E',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        flightRealPath.setMap(map);
    <?php endif?>
    <?php if (!empty($approximated)):?>
        var flightApproximatedPlanCoordinates = <?= str_replace('"', '', json_encode($approximated))?>;
        var flightApproximatedPath = new google.maps.Polyline({
            path: flightApproximatedPlanCoordinates,
            geodesic: true,
            strokeColor: '#13ff1a',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        flightApproximatedPath.setMap(map);
    <?php endif?>
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF01QHpcHUijiojQc0SJ0ctb_pdMneUTk&callback=initMap">
</script>
