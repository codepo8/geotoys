/*
  Addmap by Christian Heilmann
  Homepage: http://github.com/codepo8/geotoys
  Copyright (c)2010 Christian Heilmann
  Code licensed under the BSD License:
  http://wait-till-i.com/license.txt
*/
addmap = function(){
  var config = {
    mapkey:null,
    width:200,
    height:200
  };
  var data,elm,text;
  function init(id){
    elm = document.getElementById(id);
    if(elm){
      text = elm.innerHTML;
      var url = 'http://query.yahooapis.com/v1/public/yql?q=select%20*%20'+
                'from%20geo.placemaker%20where%20documentContent%20%3D%20%22'+
                 encodeURIComponent(text)+'%22%20and%20documentType%3D'+
                '%22text%2Fplain%22%20and%20appid%20%3D%20%22%22&'+
                'format=json&env=store%3A%2F%2Fdatatables.org%2F'+
                'alltableswithkeys&callback=addmap.paint';
      var s = document.createElement('script');
      s.setAttribute('src',url);
      document.getElementsByTagName('head')[0].appendChild(s);
    }
  };
  function paint(o){
    var results = o.query.results.matches.match;
    addmap.data = results;
    var markers = '';
    var locs = '<ul>';
    for(var i=0,j=results.length;i<j;i++){
      var found = results[i].reference.text;
      var location = results[i].place.name;
      var lat = results[i].place.centroid.latitude;
      var lon = results[i].place.centroid.longitude;
      text = text.replace(found,'<a href="http://maps.google.com/maps?q='+
                                 location+'">'+found+'</a>');
      markers += '&markers=color:blue|label:'+(i+1)+'|'+lat+','+lon;
      locs += '<li><strong>'+(i+1)+'</strong> '+location+'</li>';
    }
    elm.innerHTML = text;
    var url ='http://maps.google.com/maps/api/staticmap?sensor=false'+
             '&size='+config.width+'x'+config.height+'&maptype=roadmap'+
             '&key='+config.mapkey+markers;
    locs += '</ul>';
    var badge = '<div class="locations">'+
                '<img src="'+url+'" alt="Map">'+locs+
                '<p class="branding">Powered by: Google Maps, '+
                'Yahoo Placemaker and YQL.</p></div>';
    elm.innerHTML += badge;
  };
  return{paint:paint,analyse:init,config:config,data:data};
}();