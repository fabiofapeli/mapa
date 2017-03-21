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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
</head>
<body  onload="initMap()" topmargin='0' leftmargin='0'>
	<div id="map"></div>
        <script language ="javascript">
            function initMap() {        
     
                status = '<?php echo $status;?>'
     
                altura = $('body')[0].scrollHeight; 
    
                $("#map").height(altura);

                    var buritis = { lat: -15.63, lng: -46.43 };

                    var map = new google.maps.Map(document.getElementById('map'), {
                      center: buritis,
                      scrollwheel: false,
                      zoom: 15
                    });
                    
                    var pinColor = (status == 'C')?"0000FF":"FE7569";
                    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                    new google.maps.Size(21, 34),
                    new google.maps.Point(0,0),
                    new google.maps.Point(10, 34));
                    
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
                            '<a href="#" class="image_links" data-image="{{$image_path}}"><img src="{{$image_path}}" style="width:50px;height: auto" hspace="2"></a>' + 
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
                      icon: pinImage,
                      title: '{{$trouble->marker->name}}'
                    });
                      
                    marker_{{$trouble->id}}.addListener('click', function() {
                        infowindow_{{$trouble->id}}.open(map, marker_{{$trouble->id}});
                    });
                      
                    @endforeach
            }
            
 $(function() {
    var dialog = $( "#dialog" ).dialog();
     //$('a.image_links').on('click', function(e){
     $(document).on('click','a.image_links',function(){
         //e.preventDefault();
         //alert($(this).data('image'));
         var image_src = $(this).data('image');
         $('#image').attr("src", image_src);
         $(dialog).dialog('open');
     });

     $(dialog).dialog('close');
});
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChyWF1p5ssYnvLpggsn_XLk7D2dDCr4Ww&callback=initMap"
    async defer></script>

<div id="dialog" >
    <img src="" style="width:100%;height: auto"  id="image"></img>
</div>
</body>
</html>
