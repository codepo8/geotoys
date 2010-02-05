<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
  <title>Demo of Yahoo Placemaker (PHP)</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
  <link rel="stylesheet" href="styles.css" type="text/css">
  <style type="text/css" media="screen">
    #map span strong{display:block;color:#0f0;}
    #ismap,table,textarea{width:640px;margin:1em auto;display:block;}
    table{display:table;}
    input[type='submit']{margin:1em auto;display:block;}
  </style>
</head>
<body>
<div id="doc" class="yui-t7">
  <div id="hd" role="banner"><h1>Demo of Yahoo Placemaker (PHP)</h1></div>
  <div id="bd" role="main">
    <p>This is a demo for <a href="http://developer.yahoo.com/geo/placemaker">Yahoo Placemaker</a>. Simply enter a text in the following box and hit the "get locations" button to analyse it.</p>
  <form action="placemaker.php" method="post"     
    <textarea id="text" name="text">Hi there, I am Chris. I live in London, I am currently in Sunnyvale and will soon be in Atlanta and Las Vegas.</textarea>
    <div><input type="submit" name="sub" value="get locations"></div>
    
    <?php 
    if(isset($_POST['sub'])){
    $key = 'PASTE YOUR API KEY HERE';
    $key = 'RjKvIevV34FCwqPSzLqt4pstbOaRxGGFvYZu91duAZ3UVo6DsRaXbBQUAdY2yTM-';
    $mapkey = 'ABQIAAAAijZqBZcz-rowoXZC1tt9iRT2yXp_ZAY8_ufC3CFXhHIE1Nvwk'.
              'xQQBCaF1R_k1GBJV5uDLhAKaTePyQ';
    $apiendpoint = 'http://wherein.yahooapis.com/v1/document';
    $inputType = 'text/plain';
    $outputType = 'xml';
    $text = $_POST['text'];
    $post = 'appid='.$key.'&documentContent='.$text.
                    '&documentType='.$inputType.'&outputType='.$outputType;
    $ch = curl_init($apiendpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $results = curl_exec($ch);
    $places = simplexml_load_string($results, 'SimpleXMLElement', 
                                    LIBXML_NOCDATA); 
                                     
    echo '<h2>Results</h2>';
    if($places->document->placeDetails){
    echo '<table>';
    echo '<caption>Found locations</caption>';
    echo '<thead>';
    echo '<th scope="row">ID</th>';
    echo '<th scope="row">Name</th>';
    echo '<th scope="row">Type</th>'; 
    echo '<th scope="row">woeid</th>'; 
    echo '<th scope="row">Latitude</th>';
    echo '<th scope="row">Longitude</th>';
    echo '</thead>';
    echo '<tbody>';
    $pl = $places->document->placeDetails;
    $all = sizeof($pl);
    $map = 'http://maps.google.com/maps/api/staticmap';
    $map .= '?key='.$mapkey;
    for($i=0;$i<$all;$i++){
      $p = $pl[$i];
      $lat = $p->place->centroid->latitude;
      $lon = $p->place->centroid->longitude;
      echo '<tr>';
      echo '<th scope="row">'.($i+1).'</th>';
      echo '<td>'.$p->place->name.'</td>';
      echo '<td>'.$p->place->type.'</td>';
      echo '<td>'.$p->place->woeId.'</td>';
      echo '<td>'.$lat.'</td>';
      echo '<td>'.$lon.'</td>';
      echo '</tr>';
      $map .= '&markers=label:'.($i+1).'|'.$lat.','.$lon.
              '&visible='.$lat.','.$lon;
    }
      echo '</tbody></table>';
      $map .= '&sensor=false&size=700x200&maptype=roadmap';
      echo '<img id="ismap" src="'.$map.'" alt="map">';

    } else {
      echo '<h2>Couldn\'t find any locations for '.$url.'</h2>';
    }
      }
    ?>
  </form>
  </div>
  <div id="ft" role="contentinfo"><p>Written by <a href="http://wait-till-i.com">Chris Heilmann</a></p></div>
</div>
</body>
</html>
