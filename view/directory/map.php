<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">

var geocoder;
geocoder = new google.maps.Geocoder();
var map;
var contentString;
var marker;
var address;
var latlngs = new Array();
var iWindows = new Array();
var fcalls = 0;

function initialize() {
  
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var myOptions = {
    zoom: 14,
    center: latlng,
    scrollwheel: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  //alert(myOptions.zoom);
  
  map = new google.maps.Map(document.getElementById("directions"),myOptions);

  var addresses = new Array() ;
  
  <?php $i = 0 ?>
      <?php foreach($business->getAddresses() as $address): ?>
      contentString = '<div id="content">' +
      <?php if ($address->name != ''): ?>
      '<h1 id="firstHeading" class="firstHeading"><?php echo $address->name ?></h1>' +
	<?php else: ?>
      '<h1 id="firstHeading" class="firstHeading"><?php echo $business->name ?></h1>' +
	<?php endif ?>
      '<div id="bodyContent">' +
      '<p><?php echo $address->address1 ?><br /><?php echo ($address->address2 == '') ? '' : $address->address2 . '<br />' ?><?php echo $address->city ?>, <?php echo $address->state ?> <?php echo $address->zip ?><br /><?php echo ewUtils::format_phone($address->phone) ?></p>' +
      '</div>' +
      '</div>';
  address = '<?php echo $address->address1 ?> <?php echo $address->city ?>, <?php echo $address->state ?> <?php echo $address->zip ?>';
  codeAddress('<?php echo $address->latitude ?>', '<?php echo $address->longitude ?>', '<?php echo $business->name ?>', contentString, address, false);
  <?php $i++ ?>
      <?php endforeach ?>
    
      contentString = '<div id="content">' + 
      '<h1 id="firstHeading" class="firstHeading"><?php echo $business->name ?></h1>' +
      '<div id="bodyContent">' +
      '<p><?php echo $business->address ?><br /><?php echo $business->city ?>, <?php echo $business->state ?> <?php echo $business->zip ?><br /><?php echo ewUtils::format_phone($business->phone) ?></p>' +
      '</div>' +
      '</div>';
  address = '<?php echo $business->address ?> <?php echo $business->city ?>, <?php echo $business->state ?> <?php echo $business->zip ?>';
  codeAddress('<?php echo $business->latitude ?>', '<?php echo $business->longitude ?>', '<?php echo $business->name ?>', contentString, address, true);
}

function codeAddress(lat,long,name,con,address,last) {
  
  if (lat != '' && long != '') {
    latlngs[latlngs.length] = new google.maps.LatLng(lat,long);
    fcalls++;
    placeMarker(new google.maps.LatLng(lat,long), name, con, last);
  } else {
    geocoder.geocode( { 'address': address}, function(results,status) {
			if (status == google.maps.GeocoderStatus.OK) {
			  latlngs[fcalls] = results[0].geometry.location;
			  fcalls++;
			  placeMarker(results[0].geometry.location, name, con, last);
			} else {
			  alert("Geocode was not successful for the following reason: " + status);
			}
		      });
  }    
}

function placeMarker(myLatLng, name, con, last) {

  var marker = new google.maps.Marker({
    position: myLatLng,
	map: map,
	title: name
	});
  
  var infowindow = new google.maps.InfoWindow({
    content: con,
	maxWidth: 300,
	height: 200
	});

  iWindows[iWindows.length] = infowindow;

  google.maps.event.addListener(marker, 'click', function(e) {
				  for (x in iWindows) {
				    iWindows[x].close();
				  }
				  infowindow.open(map,marker);
				});
  
  if (fcalls == <?php echo count($business->getAddresses()) + 1 ?>) {

    var latlngbounds = new google.maps.LatLngBounds();
    for ( x in latlngs ) {
      latlngbounds.extend(latlngs[x]);
    }
    map.setCenter(latlngbounds.getCenter());
    //map.fitBounds(latlngbounds);

    /*
    google.maps.event.addDomListener(window, 'load', function() {
				       infowindow.open(map,marker);
				     });
    */

  }
}

$(document).ready(function() {
		    initialize();
		  });

</script>

<div class="blue">
    <div class="container">
	<h3 class="local_directory_search cntr">Local Business Directory Search</h3>
	<?php if ($_SERVER['REQUEST_URI'] == '/'): ?>
	<div id="filter"></div>
	<!--script type="text/javascript">
	    $("#filter").html("<div style='text-align: center;'><span style='color: #fff; text-transform: uppercase;'>Loading...</span>&nbsp;&nbsp;<img style='height:19px;width:auto;position:relative;top:-4px;' src='/images/loader_bar.gif' /></div>");
	    x = $.ajax({
		url: "/ajax/getAdvancedSearch",
		type: "GET",
		dataType: "html",
		success: function(a,b,c){
		    $("#filter").html(a);
		},
		error: function(a,b,c){
		//alert(a+' '+b+' '+c);
		}
	    });
	</script-->
	<?php else: ?>
	    <?php //include_component('directory','advancedSearch') ?>
	<?php endif ?>
    </div>
</div>

<div id="directions" style="height:450px"></div>

<div class="container">
    <div class="row">
	<div class="col-md-1 cta-icon">
	    <button class="explore-icon" role="button">Explore Icon</button>
	</div>
	<div class="col-md-6">
	    <h3 class="blue-text">Questions? Comments? More Information?</h3>
	    <p>Great. Discover what's new or to get in touch with us today.</p>
	</div>
	<div style="margin-top: 25px;">
	    <div class="col-md-2 col-md-offset-1">
		<p><a class="btn btn-primary btn-block btn-lg" href="/contact_us" role="button" onClick="_gaq.push(['_trackEvent', 'CTA', 'Click', 'Learn More']);">Learn more</a></p>
	    </div>
	    <div class="col-md-2">
		<p><a class="btn btn-primary btn-block btn-lg" href="/contact_us" role="button" onClick="_gaq.push(['_trackEvent', 'CTA', 'Click', 'Contact Me']);">Contact Me</a></p>
	    </div>
	</div>
    </div>
</div>