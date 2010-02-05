<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
  <title>Simple Demo of Yahoo Placemaker</title>
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
  <div id="hd" role="banner"><h1>Simple Demo of Yahoo Placemaker</h1></div>
  <div id="bd" role="main">
    <p>This is a demo for <a href="http://developer.yahoo.com/geo/placemaker">Yahoo Placemaker</a>. Simply enter a text in the following box and hit the "get locations" button to analyse it. The result will be an XML file.</p>
  <form action="http://wherein.yahooapis.com/v1/document" method="post">     
    <textarea id="text" name="documentContent">Hi there, I am Chris. I live in London, I am currently in Sunnyvale and will soon be in Atlanta and Las Vegas.</textarea>
    <div><input type="submit" name="sub" value="get locations"></div>
    <input type="hidden" name="appid" value="RjKvIevV34FCwqPSzLqt4pstbOaRxGGFvYZu91duAZ3UVo6DsRaXbBQUAdY2yTM-">
    <input type="hidden" name="documentType" value="text/plain">
    <input type="hidden" name="outputType" value="xml">
  </form>
  </div>
  <div id="ft" role="contentinfo"><p>Written by <a href="http://wait-till-i.com">Chris Heilmann</a></p></div>
</div>
</body>
</html>
