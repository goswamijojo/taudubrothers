<style>
	#map {
  height: 400px;
  width: 100%;
  background-color: grey;
}
</style>





   <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
}
    </style>

<style>
	
	.img{
		width: 100px;
		height: auto;
		display: block;
		margin-left: auto;
		margin-right: auto;		
	}

	.img2{
		width:100%;
  		height: auto;
  		display: block;
			
	}
</style>
 

<div class="map">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			    <a href="<?php echo base_url() ?>">
				<img src="<?php echo base_url() ?>uploads/humble.png" class="img">
				</a>
			</div>
		</div>
	</div>
</div>

<section class="map-link">
	<div class="container-fluid">
		<div class="row"  id="map">
			 
			</div>
	</div>
</section>











 
<!-- <script type="text/javascript" src="scripts/index.js"></script> -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCl-JK5usUBFwjG7Y0s9Ef3fSoPV0QTk&callback=initMap">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
 
        
	function initMap() {
	    
	 var querylat="<?php echo $this->input->get('lat'); ?>";
	 var querylng="<?php echo $this->input->get('lng'); ?>";
	if (navigator.geolocation) {
	  
      navigator.geolocation.getCurrentPosition(function(position){

          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          
          lat_lng(lat,lng);
        //   alert(lat);

      });
      if(querylat){
          lat_lng(parseFloat(querylat),parseFloat(querylng));
      }
      
    //   lat_lng(28.535517,77.391029);
       
   } else{
       alert('This browser does not support Geolocation Service.');
       return false;
   }
	   //  alert('This browser does not support Geolocation Service.!');
	  
	  function lat_lng(lat,lng){
	    
	       var center = {lat: lat, lng: lng};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10 ,
            center: center
          });
        var infowindow =  new google.maps.InfoWindow({});
        var marker, count;



  $.ajax({
        url:'<?php echo base_url() ?>/web/near_shop',
        type: 'POST',
        data: {
            cart_id: ''
        },
        dataType: 'json',
        success: function(data) {
            // console.log(data);
           if(data.status=='success'){
               
             
                //  ShowNotificator('success',data.message);
				//  alert();
				// var artical=data.array.data;
				// console.log(artical);
				
				var locations = [];
                // var count1;
				for (indx = 0; indx < data.array.length; indx++) {
				    var artical= data.array[indx];
                    locations.push({
                        address:'<b>Shop Name '+ artical.shop_name +'</b>' + ' , ' + artical.shop_area +' , ' + artical.shop_state +',' + artical.area_pincode + ' <b> Distance '+ parseFloat(artical.distance).toFixed(2) + 'K.m</b>', 
                        lat:  artical.lat,
                        long:  artical.long
                    });
				}
				   
			  
            for (count = 0; count < locations.length; count++) {
                  var location= locations[count];
                  
                 
                var address =location.address;
                 console.log(address);
                
                marker = new google.maps.Marker({
                  position: new google.maps.LatLng(location.lat, location.long),
                  map: map,
                  title: location.address
                });
                 const pos = {
                    lat:location.lat,
                    lng:location.long,
                  };
                
            google.maps.event.addListener(marker, 'click', (function (marker, count) {
                    
                  return function () {
                   console.log(locations[count]['address'][0]);
                    infowindow.setContent(locations[count]['address']);
                    map.setCenter(pos);
                    infowindow.open(map, marker);
                  }
                })(marker, count));
                
                
              }
				
				
				
				
				
				
				
				
				
				
				
				
				
                //   console.log(locations);
            }else{
                ShowNotificator('warning','No Store Found your location');
            }
        }
    });
	  }
 

  
}
</script>