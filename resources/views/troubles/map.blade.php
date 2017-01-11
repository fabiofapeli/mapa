<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mapa</title>
        <style>
            #map{
                width: 100%;
            }    
        </style>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
</head>
<body  onload="initMap()" topmargin='0' leftmargin='0'>
	<div id="map"></div>
        <script language ="javascript">
            function initMap() {                
                altura = $('body')[0].scrollHeight; 
    
                $("#map").height(altura);

                    var buritis = { lat: -15.63, lng: -46.43 };

                    var map = new google.maps.Map(document.getElementById('map'), {
                      center: buritis,
                      scrollwheel: false,
                      zoom: 15
                    });
                    
                    @foreach($troubles as $trouble)
                    <?php
                    $description = $trouble->description;
                    $description = str_replace("\n", ' ', $description);
                    $description = str_replace("\r", ' ', $description);
                    ?>
                    
                    var contentString = '<div id="content">'+
                    '<h4 id="firstHeading" class="firstHeading">{{$trouble->marker->name}}</h4>'+
                    '<div id="bodyContent">'+
                        @foreach($trouble->photo as $photo)
                            <?php
                                $image_path= "/images/troubles/" . $photo->id . '.' . $photo->extension;
                                $image_path = url('/') . $image_path;
                            ?>
                            '<img src="{{$image_path}}">' + 
                        @endforeach
                    '<p>{{$description}}</p>'+
                    '</div>'+
                    '</div>';
            
                    var infowindow_{{$trouble->id}} = new google.maps.InfoWindow({
                        content: contentString
                    });
                    
                    var marker_{{$trouble->id}} = new google.maps.Marker({
                      position: {lat: {{$trouble->latitude}}, lng: {{$trouble->longitude}}},
                      map: map,
                      title: '{{$trouble->marker->name}}'
                    });
                      
                    marker_{{$trouble->id}}.addListener('click', function() {
                        infowindow_{{$trouble->id}}.open(map, marker_{{$trouble->id}});
                    });
                      
                    @endforeach
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChyWF1p5ssYnvLpggsn_XLk7D2dDCr4Ww&callback=initMap"
    async defer></script>
</body>
</html>
