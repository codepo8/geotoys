<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
  <title>Difference between IP Geo lookup and W3C Geo API lookup</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
  <link rel="stylesheet" href="styles.css" type="text/css">

</head>
<body>
<div id="doc" class="yui-t7">
  <div id="hd" role="banner"><h1>Getting location from IP and W3C Geo API</h1></div>
  <div id="bd" role="main">
    <p>This page shows the difference in trying to locate a user by IP or by W3C geo API. If your browser is geo enabled you'll be asked to allow this page to read your location. You'll then get the difference in between the two results.</p>
    <h2>Map and info</h2>
    <div class="yui-g">
      <div class="yui-u first">
        <div id="map"><?php include('geoip.php');?></div>
      </div>
      <div class="yui-u" id="info">
        <h3>From your IP:</h3>
        <ul>
          <li>
            <strong>Latitude:</strong> 
            <span id="oldlat"><?php echo $lat;?></span>
          </li>
          <li>
            <strong>Longitude:</strong> 
            <span id="oldlon"><?php echo $lon;?>
          </li>
        </ul>
      </div>
    </div>
    <h2>Thanks</h2>
    <p>Thanks to Rasmus Lerdorf for the <a href="http://geoip.pidgets.com/">GeoIP API</a>, <a href="http://www.maxmind.com">Maxmind</a> for the Geo IP database and <a href=" http://www.johndcook.com/lat_long_distance.html">John D Cook</a> for the distance calculation function.</p>
    
  </div>
  <div id="ft" role="contentinfo"><p>Written by <a href="http://wait-till-i.com">Chris Heilmann</a> as my flight to SFO was delayed.</p></div>
</div>
<script type="text/javascript" src="http://j.maxmind.com/app/geoip.js"></script>
<script>
(function(){
  if(navigator.geolocation){
    var map = document.getElementById('map');
    var oldlat = geoip_latitude();
    var oldlon = geoip_longitude();
    document.getElementById('oldlat').innerHTML = oldlat;
    document.getElementById('oldlon').innerHTML = oldlon;
    var s = document.createElement('span');
    s.innerHTML = '<strong>Updating&hellip;</strong> '+
                  'Please give us your geo location.';
    map.appendChild(s);
    navigator.geolocation.getCurrentPosition(function(position){
      var lat = position.coords.latitude;
      var lon = position.coords.longitude
      var img = '<img src="http://maps.google.com/maps/api/staticmap?'+
                'center='+oldlat+','+oldlon+'&sensor=false&size=300x300&'+
                'maptype=roadmap&key=<?php echo $mapkey?>&markers=color:blue'+
                '|label:I|'+oldlat+','+oldlon+'&visible='+oldlat+','+oldlon+
                '|'+lat+','+lon+'&markers=color:red|label:G|'+lat+','+
                 lon+'" alt="map">';
      map.innerHTML = img;
      var dist = distance(oldlat,oldlon,lat,lon);
      var info = document.getElementById('info');
      info.innerHTML += '<h3>From your geo location</h3>'+
                        '<ul><li><strong>Latitude:</strong>'+lat+
                        '</li><li><strong>Longitude:</strong>'+lon+
                        '</li><li><strong>Difference:</strong>'+
                        dist+'</li></ul>';
    },function(error){
      map.removeChild(map.getElementsByTagName('span')[0]);
    });
    function distance(lat1,lon1,lat2,lon2){
      // thanks to http://www.johndcook.com/lat_long_distance.html
     var rho = 3960.0;
     var phi_1 = (90.0 - lat1) * Math.PI / 180.0;
     var phi_2 = (90.0 - lat2) * Math.PI / 180.0;
     var theta_1 = lon1 * Math.PI / 180.0;
     var theta_2 = lon2 * Math.PI / 180.0;
     var d = rho * Math.acos( 
       Math.sin(phi_1) * 
       Math.sin(phi_2) * 
       Math.cos(theta_1 - theta_2) +
       Math.cos(phi_1) * 
       Math.cos(phi_2) 
     );
     var output = Math.round(d) + " miles or " + 
                  Math.round(1.609344*d) + " kilometers";
     return output;
   }
 }
})();
</script>
</body>
</html>
  