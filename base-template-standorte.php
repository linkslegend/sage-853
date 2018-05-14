<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>


<?php get_template_part('templates/head'); ?>

<link rel="stylesheet" type="text/css" href="https://intermac.de/googlemaps/skf.css">
<script type="text/javascript" src="https://s3-eu-west-1.amazonaws.com/intermac/scripte/markerclusterer.js"></script>
<script type="text/javascript" src="https://s3-eu-west-1.amazonaws.com/intermac/scripte/downloadxml.js"></script>
<script type="text/javascript">
jQuery(".panel .accordion-body").each(function(index, element){
  jQuery(element).addClass(index == 0 ? "in" : "");
});
//<![CDATA[
// this variable will collect the html which will eventually be placed in the side_bar
var side_bar_html = "";
// arrays to hold copies of the markers and html used by the side_bar
// because the function closure trick doesnt work there
var gmarkers = [];
// global "map" variable
var map = null;
var markerclusterer = null;
// A function to create the marker and set up the event window function

// This function picks up the click and opens the corresponding info window
function myclick(i) {
google.maps.event.trigger(gmarkers[i], "click");
}

function initialize() {
// create the map
	var myOptions = {
	zoom: 6,
	center: new google.maps.LatLng(50.764259357116465, 10.61279296875),
	mapTypeControl: true,
	mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
	navigationControl: true,
	mapTypeId: google.maps.MapTypeId.ROADMAP
}

map = new google.maps.Map(document.getElementById("map_canvas"),
myOptions);

google.maps.event.addListener(map, 'click', function() {
	infowindow.close();
});
// Read the data from example.xml
downloadUrl("https://intermac.de/googlemaps/skf.xml", function(doc) {
	var xmlDoc = xmlParse(doc);
	var side_html = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
	var markers = xmlDoc.getElementsByTagName("marker");
	for (var i = 0; i < markers.length; i++) {
	// obtain the attribues of each marker... lol@ "lat" ツ //
	var lat = parseFloat(markers[i].getAttribute("lat"));
	var lng = parseFloat(markers[i].getAttribute("lng"));
	var point = new google.maps.LatLng(lat,lng);
	var id = markers[i].getAttribute("id");
	var marker_image = markers[i].getAttribute('markerimage');
	var image = {
	              url: marker_image
};
	var name1 = markers[i].getAttribute("name1");
	var name2 = markers[i].getAttribute("name2");
	var address = markers[i].getAttribute("address");
	var plz = markers[i].getAttribute("plz");
	var town = markers[i].getAttribute("town");
	var tel = markers[i].getAttribute("tel");
	var fax = markers[i].getAttribute("fax");
	var mail = markers[i].getAttribute("mail");
	var web = markers[i].getAttribute("web");
	var country = markers[i].getAttribute("country");
	var html=
		'<div class="mapstyle" style="min-width: 280px;"><div class="name1">'
		+name1+
		'</div><div class="contentbox"><div class="name2">'
		+name2+
		'</div><div class="address"><strong>Adresse</strong>:&nbsp;'
		+address+
		'</div><div class="plztown">'
		+plz+'&nbsp;'+town+
		'</div><div class="tel"><strong>Tel.</strong>:&nbsp;'
		+tel+
		'</div><div class="mail"><strong>Email</strong>:&nbsp;<a href="mailto:'
		+mail+
		'">'
		+mail+
		'</a></div><div class="web"><strong>Web</strong>:&nbsp;<a href="http://'
		+web+
		'" target="_blank">'
		+web+
		'</a></div></div></div>'

		side_html += '<div class="panel panel-default"> \
		<a class="accordion-toggle accordiontitle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#' + id + '" aria-controls="collapseOne"> \
				    <div class="panel-heading" role="tab" > \
		         <h4 class="panel-title"> \
						  	' + name1 + ' \
							</h4> \
						</div></a>\
		     	<div id="' + id + '" class="accordion-body collapse" role="tabpanel"> \
					<div class="panel-body"> \
						<ul> \
							<li class="' + id + ' ' + name2 + '"><a href="javascript:myclick(' + (gmarkers.length+1) + ')">' + name1 + '</a></li> \
							<li class="web"><a href="http://' + web + '/" target="_blank">' + web + '</a></li> \
				     	<li class="mail">' + mail + '</li> \
							<li class="address ' + id + ' ' + name2 + '">' + address + '</li> \
							<li class="plztown ' + id + ' ' + name2 + '">' +plz+'&nbsp;'+town+ '</li> \
							<li class="tel">' + tel + '</li> \
							<li class="fax ' + name2 + '">' + fax + '</li> \
						</ul> \
					</div> \
					</div> \
					</div> \
				';


function createMarker(latlng, name, html) {
	var contentString = html;

// Custom Icon
	var marker = new google.maps.Marker({
	position: latlng,
	map: map,
	icon: image,

// map: map,
zIndex: Math.round(latlng.lat()*-100000)<<5
});

google.maps.event.addListener(marker, 'click', function() {
infowindow.setContent(contentString);
infowindow.open(map,marker);
});
// save the info we need to use later for the side_bar
gmarkers.push(marker);
// add a line to the side_bar html
}

createMarker(point,html,map);

// put the assembled side_bar_html contents into the side_bar div
document.getElementById("side_bar").innerHTML = side_html;

// create the marker
var marker = createMarker(point,country+" "+id,html);
}
// put the assembled side_bar_html contents into the side_bar div
side_html += '</div>';

});
}
var infowindow = new google.maps.InfoWindow(
{
size: new google.maps.Size(150,50),
maxWidth:300
});
// This Javascript is based on code provided by the
// Community Church Javascript Team
// http://www.bisphamchurch.org.uk/
// http://econym.org.uk/gmap/
// from the v2 tutorial page at:
// http://econym.org.uk/gmap/basic3.htm
//]]>
</script>


  <body <?php body_class(); ?> onLoad="initialize()">
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

<div id="main" class="animation-enabled">

<!-- Google Maps -->
<div id="map_canvas"></div>

<!-- end Google maps -->

<!-- main content -->
<div class="wrap container-fluid" role="document">
  <div class="content row">

    <div class="searchbox container-fluid"> <!-- search -->
      <div class="innersearch row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-8">
          <form role="search" method="get" class="search-form-top" action="<?= esc_url(home_url('/')); ?>">
              <label class="sr-only"><?php _e('Suche nach:', 'sage'); ?></label>
                    <input id="s" data-swplive="true" type="search" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
                    <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <div class="col-6 col-sm-3 col-md-3 col-lg-2">
          <div class="contact-form-button">
              <button class="btn btn-default Modal Popup custom-submit" href="#myModal" data-toggle="modal"><i class="fa fa-envelope-o"></i>
              <div class="button-text">Kontakt</div></button>
            </div>
          </div>
          <div class="col-6 col-sm-3 col-md-3 col-lg-2">
            <div class="newsletter-form-button">
                  <a href="http://eepurl.com/b_IMtj" target="_blank"><button class="btn btn-default custom-submit"><i class="fa fa-newspaper-o"></i>
                  <div class="button-text">Newsletter</div></button></a>
                </div>
            </div>
        </div>
      </div> <!-- /. search -->

<div class="main-cont container-fluid" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/WebPageElement">
      <!-- Google Maps Directions-->
      <div class="row">
            <main class="main">
              <div class="zentrale">
                <div class="row">
                <div class="zentrale-left col-sm-6">
                <h4>Zentrale</h4>
                    Firmenzentrale Economos<br />
                    SKF Economos Deutschland GmbH<br />
                    Robert-Bosch-Straße  11<br />
                    D-74321 Bietigheim-Bissingen<br />
                    Tel.: +49 (0) 7142 593 0<br />
                    Fax: +49 (0) 7142 593 110<br />
                    seals.bietigheim@skf.com<br />
                    www.skf.de/dichtungen<br />
                  </div>
                <div class="zentrale-image col-sm-6">
                  <img src="https://intermac.de/googlemaps/skf-standorte.png">
                </div>
              </div>
            </div>
              <div id="side_bar"></div>
              <?php include Wrapper\template_path(); ?>
            </main>
            <?php if (Setup\display_sidebar()) : ?>
            <aside class="sidebar" role="complementary" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
              <?php include Wrapper\sidebar_path(); ?>
            </aside><!-- /.sidebar -->
              <?php endif; ?>
        </div>
      </div><!-- /.content row -->
    </div><!-- /.wrap -->
  </div>
</div>
<?php
  do_action('get_footer');
  get_template_part('templates/footer');
  wp_footer();
?>
  </body>
</html>
