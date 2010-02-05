<?php 
  $mapkey = 'ABQIAAAAijZqBZcz-rowoXZC1tt9iRT2'.
           'yXp_ZAY8_ufC3CFXhHIE1NvwkxQQBCaF1R'.
           '_k1GBJV5uDLhAKaTePyQ';

  // ^ get your own key, please - 
  // http://code.google.com/apis/maps/signup.html

  if ($_SERVER['HTTP_X_FORWARD_FOR']) {
   $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
  } else {
   $ip = $_SERVER['REMOTE_ADDR'];
  }
  $url = 'http://geoip.pidgets.com/?ip='.$ip.'&format=json';
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);
  $data = json_decode($output);
  $lat = $data->latitude;
  $lon = $data->longitude;
  $imgurl = 'http://maps.google.com/maps/api/staticmap?'.
           'center='.$lat.','.$lon.'&sensor=false&size=300x300&'.
           'maptype=roadmap&key='.$mapkey.'&'.
           'markers=color:blue|label:I|'.$lat.','.$lon.
           '&visible='.$lat.','.$lon;
  echo '<img id="mapimg" src="'.$imgurl.'">';  
?>