
<script src="http://openlayers.org/api/OpenLayers.js"></script>

<script src="/assets/js/mxn.js?(openlayers)" type="text/javascript"></script> <!-- https://raw.githubusercontent.com/mapstraction/mxn/master/source/mxn.openlayers.core.js -->
<style type="text/css">
#map {
    height: calc(75vh);
    width: calc(75vw);
}
</style>
<div id="map"></div>
<script type="text/javascript">
    var map = new mxn.Mapstraction('map', 'openlayers'); 
    var latlon = new mxn.LatLonPoint(6.0151, -75.12769);
    var marker = new mxn.Marker(latlon);

    map.addMarker(marker);
    map.setCenterAndZoom(latlon, 10);
//    markers.addMarker(new OpenLayers.Marker(position));
</script>