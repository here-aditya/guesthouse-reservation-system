<div class="row-fluid">
	<div class="span10 offset1">
		<div class="html_border">
			<div id="html_container">
				<div class="row-fluid">
					<h2><?=$page_data->head?></h2>
					<p class="paddrow"><?=$page_data->content?></p>
				</div>
				<?php
				// check if image gallery or lat / long exists
				if( ! empty($image_gallery) || ( ! empty($page_data->latitude) && ! empty($page_data->longitude)))
				{
				?>
				<div class="row-fluid">
					<div class="accordion" id="accordion2">
                    	<?php
						if( ! empty($image_gallery))
						{
						?>
                    	<div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
                                Image Gallery
                                </a>
                            </div>
                            <div id="collapse1" class="accordion-body collapse in">
                    			<div class="accordion-inner">
                    				<div class="">
                                        <div class="carousel slide" id="myCarousel">
                                            <div class="carousel-inner">
                                                <?php
                                                $i= 1;
                                                foreach($image_gallery as $image)
                                                {
                                                ?>
                                                <div class="item <?php $i == 1 ? print 'active' : print 'next' ?>">
                                                    <img alt="" src="<?=$RPath?>pics/image_gallery/<?=$image->image_name?>">
                                                    <div class="carousel-caption">
                                                      <h4><?=$page_data->head?> <?=$i?> <?php ! empty($image->title_tag) ? print(' - '.$image->title_tag) : '' ?></h4>
                                                      <p></p>
                                                    </div>
                                                </div>
                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </div>
                                            <a data-slide="prev" href="#myCarousel" class="left carousel-control">‹</a>
                                            <a data-slide="next" href="#myCarousel" class="right carousel-control">›</a>
                                        </div>
                                    </div>
                                 </div>
                    		</div>
                    	</div>
                        <?php
						}
						?>
                        
                        <?php
						if( ! empty($page_data->latitude) && ! empty($page_data->longitude))
						{
						?>
                    	<div class="accordion-group">
                    		<div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                                Road Map
                                </a>
                    		</div>
                    		<div id="collapse2" class="accordion-body collapse <?php empty($image_gallery) ? print 'in' : '' ?>">
                    			<div class="accordion-inner">
                    				<div class="">
                                        <div class="gmap" id="gmap">
                                            <img src="<?=$RPath?>pics/site/loading_big.gif"/>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                    	<div class="span10 offset1" id="directionsPanel"></div>
                                    </div>
                    			</div>
                   			</div>
                    	</div>
                        <?php
						}
						?>
                    </div>
                </div><!-- /row fluid -->
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php
if( ! empty($page_data->latitude) && ! empty($page_data->longitude))
{
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
	var directionDisplay;
  	var directionsService = new google.maps.DirectionsService();
	
    function showMap(name,lat, long, zoom) 
	{
		var destLatLng = new google.maps.LatLng(lat, long);
		var startLatLng = new google.maps.LatLng(30.096086, 78.288258); // Janki Devi Somany Bhawan Lat, Long
		parseInt(zoom) == 0 ? zoom = 15 : '';
		
		directionsDisplay = new google.maps.DirectionsRenderer();
		
		var myOptions = {
		  zoom: zoom,
		  center: destLatLng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById("gmap"), myOptions);
		map.setTilt(45);
		
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById("directionsPanel"));
		
		var red_icon = {
						  path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
						  fillOpacity: 1,
						  fillColor: "red",
						  scale: 4,
						  strokeColor: "red",
						  strokeWeight: 1
						};
		var blue_icon = {
						  path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
						  fillOpacity: 1,
						  fillColor: "blue",
						  scale: 4,
						  strokeColor: "blue",
						  strokeWeight: 1
						};
						
		var start = new google.maps.Marker({
			position: startLatLng,
			icon: blue_icon,
			title: "Janki Devi Somany Bhawan Guest House",
			map: map,
			draggable: false
		});
		
		var end = new google.maps.Marker({
			position: destLatLng,
			icon: red_icon,
			title: name,
			map: map,
			draggable: false
		});
		
		var request = {
		  origin: startLatLng,
		  destination: destLatLng,
		  travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
			else
			{
				if (status == 'ZERO_RESULTS') {
				  document.getElementById("directionsPanel").innerHTML = 'No route could be found between the origin and destination.';
				} else if (status == 'UNKNOWN_ERROR') {
				  document.getElementById("directionsPanel").innerHTML = 'A directions request could not be processed due to a server error. The request may succeed if you try again.';
				} else if (status == 'REQUEST_DENIED') {
				  document.getElementById("directionsPanel").innerHTML = 'This webpage is not allowed to use the directions service.';
				} else if (status == 'OVER_QUERY_LIMIT') {
				  document.getElementById("directionsPanel").innerHTML = 'The webpage has gone over the requests limit in too short a period of time.';
				} else if (status == 'NOT_FOUND') {
				  document.getElementById("directionsPanel").innerHTML = 'At least one of the origin, destination, or waypoints could not be geocoded.';
				} else if (status == 'INVALID_REQUEST') {
				  document.getElementById("directionsPanel").innerHTML = 'The DirectionsRequest provided was invalid.';        
				} else {
				  document.getElementById("directionsPanel").innerHTML = 'There was an unknown error in your request. Requeststatus: nn'+status;
				}
			}
		});
	}
    showMap('<?=$page_data->head?>', <?=$page_data->latitude?>, <?=$page_data->longitude?>, <?=$page_data->zoom?>);
</script>
<?php
}
?>