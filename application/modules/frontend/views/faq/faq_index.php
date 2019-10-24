<html>    
  <head> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link type="text/css" rel="stylesheet" href="style.css" />
    <script src="<?php echo base_url('assets/frontend/global/plugins/gmap3.js'); ?>" type="text/javascript"></script>  
  <body>
<div id="test" class="gmap3"></div>
<script>
  $.gmap3({
    key: 'AIzaSyB8rc7_FjcX4eYqhNpEnaukeENomS99i7A'
  });
  $(function () {
    $('#test')
      .gmap3({
        address: "Haltern am See, Weseler Str. 151",
        zoom: 6,
        mapTypeId : google.maps.MapTypeId.ROADMAP
      })
      .marker(function (map) {
        return {
          position: map.getCenter(),
          icon: 'http://maps.google.com/mapfiles/marker_green.png'
        };
      })
        .on('click', function (marker, event) {
          marker.setIcon('http://maps.google.com/mapfiles/marker_orange.png');
          setTimeout(function () {
            marker.setIcon('http://maps.google.com/mapfiles/marker_green.png');
          }, 200);
        })
    ;
  });
</script>
  </body>
</html>