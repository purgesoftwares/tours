<style>
.main-slider-wrapper{ width:75%;float:left}
.main-map-wrapper{ width:23%; float:left }

@media screen and (max-width: 767px) {
    .main-slider-wrapper,.main-map-wrapper{
        width:100%;
		
    }
}

</style>
<div id="header">
<?php $complete_address = $gallery["Shoot"]['address_1'].' '.$gallery["Shoot"]['address_2'].' '.$gallery["Shoot"]['city'].' '.$gallery["Shoot"]['state'].' '.$gallery["Shoot"]['zip'] ?>

	 <div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target="#yii_bootstrap_collapse_0">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php echo $this->Html->link($this->Html->image('logo2.jpg'),'',array('id'=>'brand','class'=>"pull-left customBrand brand",'escape'=>false)); ?>
				<div class="nav-collapse collapse" id="yii_bootstrap_collapse_0">
					<ul class=" nav" id="options">
				<?php if($gallery["Gallery"]['include_project_title']){ ?>
				<li>
							<a target="_blank" href="http://maps.google.com/?q=<?php echo urlencode($complete_address); ?>">
					<?php echo $sht_address = !empty($gallery["Gallery"]['alt_title'])?$gallery["Gallery"]['alt_title']:$gallery["Shoot"]['title'] ?>
					</a>
				</li>
				<?php } ?>
				
				<?php /* if($gallery["Gallery"]['include_project_title']){ ?>
					<li>
							<a target="_blank" href="http://maps.google.com/?q=<?php echo urlencode($complete_address); ?>"><strong>Title: </strong>
					<?php echo !empty($gallery["Gallery"]['alt_title'])?$gallery["Gallery"]['alt_title']:$gallery["Shoot"]['title'] ?>
					</a>
				</li>
				<?php } */ ?>
				<?php if($gallery["Gallery"]['include_mls_number']){ ?>
					<li>
							<a target="_blank" href="javascript:void(0);"><strong>MLS #: </strong>
					<?php echo !empty($gallery["Gallery"]['mls_number'])?$gallery["Gallery"]['mls_number']:"" ?>
					</a>
				</li>
				<?php } ?>
				
				
						
					</ul>
					
				<?php  if($gallery["Gallery"]['include_agent_title']){ ?>
					<ul class="pull-right nav" id="yw0">
						<li class="divider-vertical"></li>
						<li class="dropdown">
						
							<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0); "><strong><?php echo !empty($gallery["Gallery"]['alt_agent_title'])?"Realtor: ".$gallery["Gallery"]['alt_agent_title']:"Realtor: ".$gallery["Client"]['first_name']." ".$gallery["Client"]['last_name'] ?></strong> <span class="caret"></span></a>
						<?php if($gallery["Gallery"]['include_agent_contact']){ ?>
						<ul id="yw1" class="dropdown-menu">
							<li>
								<a class="moreInfo" target="_blank" tabindex="-1" href="javascript:void(0);"><strong>Phone :</strong><?php echo !empty($gallery["Gallery"]['alt_agent_phone'])?$gallery["Gallery"]['alt_agent_phone']:$gallery["Client"]['telephone'] ?></a>
							</li>
							
							<li class="divider"></li>
							<li>
								<a class="moreInfo" target="_blank" tabindex="-1" href="javascript:void(0);"><strong>Email :</strong><?php echo !empty($gallery["Gallery"]['alt_agent_email'])?$gallery["Gallery"]['alt_agent_email']:$gallery["Client"]['email'] ?></a>
							</li>
							<!--<li class="nav-header"><img class="image-rounded gallery-thumbnail" src="tImageResized1384373020.jpg" alt="headshot"></li> -->
						</ul>
						<?php } ?>
						</li>
					</ul>
					<?php } ?>
					<div class="socialBar">
					<a href="<?php 
					echo "";?>" style="float:right" class="social addthis_button_facebook"><i class="icon-facebook-sign icon-large"></i></a>
					<a href="<?php echo $this->html->url(array('plugin'=>false,'controller'=>'slideshow','action'=>'index',base64_encode($id))); ?>#" style="float:left" class="social addthis_button_twitter">
					<i class="icon-twitter-sign icon-large"></i>
					</a>
					<a href="<?php echo $this->html->url(array('plugin'=>false,'controller'=>'slideshow','action'=>'index',base64_encode($id))); ?>#" style="float:left" class="social addthis_button_pinterest_share">
					<i class="icon-pinterest-sign icon-large"></i>
					</a>
					<a href="<?php echo $this->html->url(array('plugin'=>false,'controller'=>'slideshow','action'=>'index',base64_encode($id))); ?>#" style="float:left" class="social addthis_button_compact"><i class="icon-plus-sign icon-large"></i></a></div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class= "main-slider-wrapper" style=" ">
<div id="juicebox-container" style="float:left;">
<div id="juicebox-content"></div>
</div>
</div>





<div class= "main-map-wrapper" style=" " >
 <script type="text/javascript" src="http://www.maps.google.com/maps/api/js?sensor=false"></script>
<div id="map_canvas" style=" height:500%;width:100%; border:1px solid #ccc"></div>
<script>
var geocoder;
var map;
var address = "<?php $complete_address = trim($complete_address); echo (empty($complete_address))?$sht_address:$complete_address; ?>";

function initialize() {
setTimeout(function(){ 
	var height = $("div.jbn-nav-left-touch-area").height();
	$("#map_canvas").height(height+'px');
	
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
  }, 700);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
	</div>

<div style="clear:both;">
</div>