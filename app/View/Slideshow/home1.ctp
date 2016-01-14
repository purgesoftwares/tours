
<div class="row-fluid" style="margin:10px;   position: relative;
  min-height: 100%;   margin-right: auto;
  margin-left: auto; max-width:1170px;" align="center">				

  <div class="span8" style="width:75%;float:left " >
				
				<div style="float:left; margin-left:15px; margin-top:25px;margin-bottom:25px; text-align:left;">
				<?php if($gallery["Gallery"]['include_project_title']){ ?>
					<h4 style="font-weight:bold">
					<?php echo !empty($gallery["Gallery"]['alt_title'])?$gallery["Gallery"]['alt_title']:$gallery["Shoot"]['title'] ?>
					</h4>
				<?php } ?>
				<?php if($gallery["Gallery"]['include_mls_number']){ ?>
					<h4 style="font-weight:bold">
					<?php echo !empty($gallery["Gallery"]['mls_number'])?"MLS #".$gallery["Gallery"]['mls_number']:"" ?>
					</h4>
				<?php } ?>
				</div>
				
				<div style="float:right; margin-right:25px; margin-top:25px;margin-bottom:25px;">
					<?php echo $this->Html->link($this->Html->image('logo2.jpg'),'',array('id'=>'brand','escape'=>false)); ?>
				</div>
			</div>
			
<div class="span8" style="width:75%;float:left " >
<?php //pr($gallery); ?>
			
			
			
			<div class="content">
				
				
				
				<div id="rg-gallery" class="rg-gallery">
					
					<div class="rg-thumbs" style="margin-top:70px;">
						<!-- Elastislide Carousel Thumbnail Viewer -->
						<div class="es-carousel-wrapper">
							<div class="es-nav">
								<span class="es-nav-prev">Previous</span>
								<span class="es-nav-next">Next</span>
							</div>
							<div class="es-carousel">
								
								<ul>
									<?php if(isset($gallery["GalleryImage"]) && !empty($gallery["GalleryImage"])){
											foreach($gallery["GalleryImage"] as $gallery_image){
												$file_path		=	USER_IMAGE_STORE_PATH.$gallery_image['image_folder'].DS;
												$file_name		=	$gallery_image['image'];
												$image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',100,100,base64_encode($file_path),$file_name),true);
												$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',800,800,base64_encode($file_path),$file_name),true);
												if(is_file($file_path . $file_name)) {
											?>
											<li><a href="#"><img src="<?php echo $image_url ?>" data-large="<?php echo $big_image_url ?>" alt="image01"  /></a></li>
											<?php
											}
											}
										} ?>
								</ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div>
				<div style="float:right; margin-right:65px; margin-top:-190px;margin-bottom:15px; text-align:left;" id="agent_details">
				<?php if($gallery["Gallery"]['include_agent_title']){ ?>
					<h4>
					<?php echo !empty($gallery["Gallery"]['alt_agent_title'])?"Realtor: ".$gallery["Gallery"]['alt_agent_title']:"Realtor: ".$gallery["Shoot"]["Photographer"]['first_name'].$gallery["Shoot"]["Photographer"]['last_name'] ?>
					</h4>
				<?php } ?>
				<?php if($gallery["Gallery"]['include_agent_contact']){ ?>
					<h4>
					<?php echo !empty($gallery["Gallery"]['alt_agent_phone'])?"Phone: ".$gallery["Gallery"]['alt_agent_phone']:"Phone: ".$gallery["Shoot"]["Photographer"]['telephone'] ?><br/>
					<?php echo !empty($gallery["Gallery"]['alt_agent_email'])?"Email: ".$gallery["Gallery"]['alt_agent_email']:"Email: ".$gallery["Shoot"]["Photographer"]['email'] ?>
					</h4>
				<?php } ?>
				
				</div>
				<!-- rg-gallery -->
				
			</div><!-- content -->
			
  </div>
	<div class="span4" style="width:25%; float:left " >
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<div id="map_canvas" style=" height:500px;width:250px"></div>
<script>
var geocoder;
var map;
var address = "<?php echo $gallery["Gallery"]['gallery_title'] ?>";

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var myOptions = {
    zoom: 12,
    center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  if (geocoder) {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

          var infowindow = new google.maps.InfoWindow({
            content: '<b>' + address + '</b>',
            size: new google.maps.Size(150, 50)
          });

          var marker = new google.maps.Marker({
            position: results[0].geometry.location,
            map: map,
            title: address
          });
          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
	</div>
</div>
<div style="clear:both;">
</div>