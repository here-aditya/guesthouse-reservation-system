<div class="row-fluid">
	<div class="span10 offset1">
		<div class="html_border">
			<div id="html_container">
				<div class="row-fluid">
					<h2><?=$page_data->head?></h2>
					<p class="paddrow"><?=$page_data->content?></p>
				</div>
				<div class="row-fluid">
                	<div class="rooms_cont">
                        <div class="" id="gmap" style="min-height: 450px">
                            <img src="<?=$RPath?>pics/site/loading_big.gif" class="offset5" style="margin-top:150px"/>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
      function initialize(lat, lng, zoom_lvl) {
	        var fenway = new google.maps.LatLng(lat, lng);
	        
	        var mapOptions = {
	          center: fenway,
	          zoom: zoom_lvl,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        };
	        var map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
	        /*
	        var panoramaOptions = {
									  position: fenway,
									  pov: {
									    heading: 34,
									    pitch: 10,
									    zoom: 1
									  }
								};
	        var panorama = new  google.maps.StreetViewPanorama(document.getElementById("pano"), panoramaOptions);
	        
			map.setStreetView(panorama);*/
			
			 var contentString = '<div class="yellow_gradient"><h3><u><?=$site["site_title"]?></u></h3></div>';

	        var infowindow = new google.maps.InfoWindow({
	            content: contentString
	        });
	
	        var marker = new google.maps.Marker({
	            position: fenway,
	            map: map,
	            title: '<?=$site['site_title']?>'
	        });
	        google.maps.event.addListener(marker, 'click', function() {
	          infowindow.open(map,marker);
	        });
      }
      initialize(30.096086, 78.288258, 16);
</script>

<script>
/*var i=1;
function progress()
{
	$('.progress .bar').css('width', i+'%');
	var t = setTimeout(progress, 100);
}
progress();*/
</script>