<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>


<?php get_template_part('templates/head'); ?>

<script async type="text/javascript">
var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  jQuery(function(){
    jQuery('#submit').click(function(){
		calcRoute();
	});
  calcRoute();
	initialize();
  });
  // initialize the Google Map API.
  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var arr = document.getElementById('centermap').getAttribute('value').split(',');
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(arr[0],arr[1]),
        map: map });
    var mapOptions = {
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: new google.maps.LatLng(arr[0],arr[1])
    }
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
    directionsDisplay.setPanel(document.getElementById('directionsPanel'), mapOptions);
    directionsDisplay.setMap(map);
  }

  //Find the Start and End Destination on google Map
  function calcRoute() {
    var start = document.getElementById('routeStart').value;
    var end = document.getElementById('routeEnd').value;
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  }

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
<div class="map-wrap container-fluid">
  <div id="map_canvas"></div>
</div>

<!-- end Google maps -->

<!-- main content -->
<div class="wrap container-fluid" role="document">
  <div class="content row">

   <div class="map-form-out mapsbox container-fluid">
   <div class="map-form-inner">
   <div class="map-input">
   <form action="#" onSubmit="calcRoute();return false;" id="routeForm">
       <div class="row">
             <div class="col-md-8 formbox">
               <div class="row">
               <div class="col-12 col-md-6 col-lg-6 first"><div class="from-text">Von:</div><input type="text" class="startpoint" id="routeStart" value=""></div>
               <div class="col-12 col-md-6 col-lg-6 last"><div class="to-text">Nach:</div><input type="text" class="endpoint" id="routeEnd" value="<?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['gmap-value'].''); ?>"></div>
               <div id="centermap" value="<?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['gmap'].''); ?>"></div>
               </div>
             </div>
             <div class="col-md-4 maps">
               <div class="row">
               <div class="col-6 col-md-6 col-lg-6 first"><button type="submit" id="RoutenPlan" class="button-left btn btn-primary btn-lg" value="Route berechnen">Berechnen</button></div>
               <div class="col-6 col-md-6 col-lg-6 last"><button id="RoutenPlan" data-role="button" type="button" class="button-right btn btn-primary btn-lg" data-toggle="collapse" data-parent="#accordion" href="#directionsPanel">Plan Anzeigen</button></div>
              </div>
             </div>
       </div>
   </form>
   </div> <!-- .map-input -->
   </div> <!-- .map-form-inner -->
   </div> <!-- .map-form-out -->

<div class="main-cont container-fluid" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/WebPageElement">
      <!-- Google Maps Directions-->
      <div class="row">
            <main class="main">
              <div id="directionsPanel" id="collapseOne" class="collapse"></div>
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
