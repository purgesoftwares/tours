<html>
  <head>
	<?php echo $this->Html->css('map/styles'); ?>
    <style type="text/css" media="screen">
      form { width: 500px; float: left; margin-left: 20px}
      
      fieldset { width: 320px; margin-top: 20px}
      fieldset strong { display: block; margin: 0.5em 0 0em; }
      fieldset input { width: 95%; }
      
      ul span { color: #999; }
    </style>
  </head>
  <body>
    
    <div class="map_canvas" style='height:500px'></div>
    
    <form>
		<input id="geocomplete" type="text" style='width:420px'  placeholder="Type in an address" value="Lisboa, Portugal" />
      <input id="find" type="button" value="Find" />
      
      <fieldset style='width:396px'>
        <label>Latitude</label>
        <input name="lat" type="text" value="" class='lat'>
      
        <label>Longitude</label>
        <input name="lng" type="text" value="" class='lng'>
    </fieldset>
    </form>

    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <?php echo $this->Html->script('jquery.geocomplete.js'); ?>
    
    <script>
	  $(function(){
	    $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form ",
          markerOptions: {
            draggable: true
          }
		 
        });
        
        $("#geocomplete").bind("geocode:dragged", function(event, latLng){
          $("input[name=lat]").val(latLng.lat());
          $("input[name=lng]").val(latLng.lng());
		  window.parent.$('#PartnerLatLong').val(latLng.lat()+' , '+latLng.lng());
		  window.parent.$('#OtherPartnerLatLong').val(latLng.lat()+' , '+latLng.lng());
		  window.parent.$('#CustomerLatLong').val(latLng.lat()+' , '+latLng.lng());
		  window.parent.$('#ComercialLatLong').val(latLng.lat()+' , '+latLng.lng());
		  window.parent.$('#PromoterLatLong').val(latLng.lat()+' , '+latLng.lng());
		  window.parent.$('#StoreLatLong').val(latLng.lat()+' , '+latLng.lng());
		  window.parent.$('#CampaignLatLong').val(latLng.lat()+' , '+latLng.lng());
		  window.parent.$('#Setting0Value').val(latLng.lat()+' , '+latLng.lng());
        });
        
        $("#find").click(function(){
		 $("#geocomplete").trigger("geocode");
		 window.parent.$('#PartnerLatLong').val($('.lat').val()+' , '+$('.lng').val());
		 window.parent.$('#OtherPartnerLatLong').val($('.lat').val()+' , '+$('.lng').val());
		 window.parent.$('#CustomerLatLong').val($('.lat').val()+' , '+$('.lng').val());
		 window.parent.$('#ComercialLatLong').val($('.lat').val()+' , '+$('.lng').val());
		 window.parent.$('#PromoterLatLong').val($('.lat').val()+' , '+$('.lng').val());
		 window.parent.$('#StoreLatLong').val($('.lat').val()+' , '+$('.lng').val());
		 window.parent.$('#CampaignLatLong').val($('.lat').val()+' , '+$('.lng').val());
		 window.parent.$('#Setting0Value').val($('.lat').val()+' , '+$('.lng').val());
        }).click();
		window.parent.$("#mapok").click(function(){
			$("#geocomplete").trigger("geocode");
			window.parent.$('#PartnerLatLong').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$('#OtherPartnerLatLong').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$('#CustomerLatLong').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$('#ComercialLatLong').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$('#PromoterLatLong').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$('#StoreLatLong').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$('#CampaignLatLong').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$('#Setting0Value').val($('.lat').val()+' , '+$('.lng').val());
			window.parent.$(".close").trigger('click');
        });
      });
    </script>
    
  </body>
</html>

