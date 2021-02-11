<?php
/**
 * Custom functions by intermac / Futurewave
 */

/*Custom Search Form*/

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' ) ;
add_filter('xmlrpc_enabled', '__return_false');

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );
add_filter('wpcf7_autop_or_not', '__return_false');

// Remove dashicons in frontend for unauthenticated users
add_action( 'wp_enqueue_scripts', 'bs_dequeue_dashicons' );
function bs_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
        //wp_deregister_script('jquery');
        wp_dequeue_script( 'wp-embed' );
    }
}

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');



function my_search() {
		$term = strtolower( $_GET['term'] );
		$suggestions = array();

		$loop = new WP_Query( 's=' . $term );

		while( $loop->have_posts() ) {
			$loop->the_post();
			$suggestion = array();
			$suggestion['label'] = get_the_title();
			$suggestion['link'] = get_permalink();

			$suggestions[] = $suggestion;
		}

		wp_reset_query();

    	$response = json_encode( $suggestions );
    	echo $response;
    	exit();
}

add_action( 'wp_ajax_my_search', 'my_search' );
add_action( 'wp_ajax_nopriv_my_search', 'my_search' );



/*Facebook <meta property="og:locale" content="en_US" /> */
function yst_wpseo_change_og_locale( $locale ) {
	return 'de_DE';
}
add_filter( 'wpseo_locale', 'yst_wpseo_change_og_locale' );




/* vcf file*/
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
	// add your extension to the array
	$existing_mimes['vcf'] = 'text/x-vcard';
	return $existing_mimes;
}

function new_excerpt_more( $more ) {
  global $post;
  if ($post->post_type == 'post'){
    return '';
  }
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Calls the class on the post edit screen.
 */
function call_someClass() {
    new someClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_someClass' );
    add_action( 'load-post-new.php', 'call_someClass' );
}

/**
 * The Class.
 */
class someClass {

/**
* Hook into the appropriate actions when the class is constructed.
*/
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

/**
* Adds the meta box container.
*/
	public function add_meta_box( $post_type ) {
            $post_types = array('post', 'page');     //limit meta box to certain post types
            if ( in_array( $post_type, $post_types )) {
		add_meta_box(
			'some_meta_box_name'
			,__( 'Some Meta Box Headline', 'myplugin_textdomain' )
			,array( $this, 'render_meta_box_content' )
			,$post_type
			,'advanced'
			,'high'
		);
            }
	}

/**
* Save the meta when the post is saved.
*
* @param int $post_id The ID of the post being saved.
*/
	public function save( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['myplugin_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

/* OK, its safe for us to save the data now. */

// Sanitize the user input.
		$mydata = sanitize_text_field( $_POST['myplugin_new_field'] );

// Update the meta field.
		update_post_meta( $post_id, '_my_meta_value_key', $mydata );
	}


/**
* Render Meta Box content.
*
* @param WP_Post $post The post object.
*/
	public function render_meta_box_content( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

		// Display the form, using the current value.
		echo '<label for="myplugin_new_field">';
		_e( 'Description for this field', 'myplugin_textdomain' );
		echo '</label> ';
		echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field"';
                echo ' value="' . esc_attr( $value ) . '" size="25" />';
	}
}



// function custom_scripts() {
//   wp_enqueue_style('roots_custom', get_template_directory_uri() . '/assets/css/custom.css');
// }
// add_action('wp_enqueue_scripts', 'custom_scripts', 200);



/*Image Size*/
add_image_size( 'thumbnail', 350, 200 ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode
add_image_size( 'thumbnail_croped', 750, 350, array('center','center') ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode
add_image_size( 'single-post-thumb', 750, 300, array('center','center') ); // (cropped)


/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'futurewave_options', 'futurewave_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'futurewavetheme' ), __( 'Theme Options', 'futurewavetheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'futurewavetheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'futurewavetheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'futurewave_options' ); ?>
			<?php $options = get_option( 'futurewave_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * A futurewave text input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header Contact Form', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[headercontact]" class="regular-text" type="text" name="futurewave_theme_options[headercontact]" value="<?php esc_attr_e( $options['headercontact'] ); ?>" />
						<label class="description" for="futurewave_theme_options[headercontact]"><?php _e( 'Header Contact Form', 'futurewavetheme' ); ?></label>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Google Maps Lat, Long', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[gmap]" class="regular-text" type="text" name="futurewave_theme_options[gmap]" value="<?php esc_attr_e( $options['gmap'] ); ?>" />
						<label class="description" for="futurewave_theme_options[gmap]"><?php _e( 'Google Maps Lat, Long', 'futurewavetheme' ); ?></label>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Google Maps Kontakt Seite Adresse(value)', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[gmap-value]" class="regular-text" type="text" name="futurewave_theme_options[gmap-value]" value="<?php esc_attr_e( $options['gmap-value'] ); ?>" />
						<label class="description" for="futurewave_theme_options[gmap-value]"><?php _e( 'Google Maps Kontakt Seite Adresse(value)', 'futurewavetheme' ); ?></label>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Facebook Link', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[facebook]" class="regular-text" type="text" name="futurewave_theme_options[facebook]" value="<?php esc_attr_e( $options['facebook'] ); ?>" />
						<label class="description" for="futurewave_theme_options[facebook]"><?php _e( 'Facebook link', 'futurewavetheme' ); ?></label>
					</td>
					<tr><th scope="row"><?php _e( 'Google Plus Link', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[googleplus]" class="regular-text" type="text" name="futurewave_theme_options[googleplus]" value="<?php esc_attr_e( $options['googleplus'] ); ?>" />
						<label class="description" for="futurewave_theme_options[googleplus]"><?php _e( 'Google Plus Link', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Twitter Link', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[twitter]" class="regular-text" type="text" name="futurewave_theme_options[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>" />
						<label class="description" for="futurewave_theme_options[twitter]"><?php _e( 'Twitter Link', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'LinkedIn Link', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[linkedin]" class="regular-text" type="text" name="futurewave_theme_options[linkedin]" value="<?php esc_attr_e( $options['linkedin'] ); ?>" />
						<label class="description" for="futurewave_theme_options[linkedin]"><?php _e( 'LinkedIn Link', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Delicious Link', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[delicious]" class="regular-text" type="text" name="futurewave_theme_options[delicious]" value="<?php esc_attr_e( $options['delicious'] ); ?>" />
						<label class="description" for="futurewave_theme_options[delicious]"><?php _e( 'Delicious Link', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'BlogSpot', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[blogspot]" class="regular-text" type="text" name="futurewave_theme_options[blogspot]" value="<?php esc_attr_e( $options['blogspot'] ); ?>" />
						<label class="description" for="futurewave_theme_options[blogspot]"><?php _e( 'BlogSpot Link', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Youtube', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[youtube]" class="regular-text" type="text" name="futurewave_theme_options[youtube]" value="<?php esc_attr_e( $options['youtube'] ); ?>" />
						<label class="description" for="futurewave_theme_options[youtube]"><?php _e( 'Youtube Link', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Tumblr Link', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[tumblr]" class="regular-text" type="text" name="futurewave_theme_options[tumblr]" value="<?php esc_attr_e( $options['tumblr'] ); ?>" />
						<label class="description" for="futurewave_theme_options[tumblr]"><?php _e( 'Tumblr Link', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Logo 1 dateiname (Logo.png) ', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[logo1]" class="regular-text" type="text" name="futurewave_theme_options[logo1]" value="<?php esc_attr_e( $options['logo1'] ); ?>" />
						<label class="description" for="futurewave_theme_options[logo1]"><?php _e( 'Logo 1 (Dark Logo)', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Logo 2 dateiname (Logo.png) ', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[logo2]" class="regular-text" type="text" name="futurewave_theme_options[logo2]" value="<?php esc_attr_e( $options['logo2'] ); ?>" />
						<label class="description" for="futurewave_theme_options[logo2]"><?php _e( 'Logo 2 (Light Logo)', 'futurewavetheme' ); ?></label>
					</td>
					</tr>
					<tr><th scope="row"><?php _e( 'Telefon', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[phone]" class="regular-text" type="text" name="futurewave_theme_options[phone]" value="<?php esc_attr_e( $options['phone'] ); ?>" />
						<label class="description" for="futurewave_theme_options[phone]"><?php _e( 'Telefon', 'futurewavetheme' ); ?></label>
					</td>
				</tr>
					<tr><th scope="row"><?php _e( 'Email', 'futurewavetheme' ); ?></th>
					<td>
						<input id="futurewave_theme_options[email]" class="regular-text" type="text" name="futurewave_theme_options[email]" value="<?php esc_attr_e( $options['email'] ); ?>" />
						<label class="description" for="futurewave_theme_options[email]"><?php _e( 'Email', 'futurewavetheme' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * A futurewave textarea option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header Code', 'futurewavetheme' ); ?></th>
					<td>
						<textarea id="futurewave_theme_options[sometextarea]" class="large-text" cols="50" rows="10" name="futurewave_theme_options[sometextarea]">
						<?php echo esc_textarea( $options['sometextarea'] ); ?></textarea>
						<label class="description" for="futurewave_theme_options[sometextarea]"><?php _e( 'futurewave text box', 'futurewavetheme' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'futurewavetheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {

	// Say our text option must be safe text with no HTML tags
	$input['headercontact'] = ( $input['headercontact'] );
	$input['sometext'] = wp_filter_post_kses( $input['sometext'] );

	// Say our textarea option must be safe text with the allowed tags for posts
	//$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}
// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/


function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
//  ---------->Blog Post Slider Frontpage Shortcode<----------
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------

add_shortcode( 'post_slider', 'post_slider_shortcode' );
function post_slider_shortcode($atts){
    ob_start();
    $postslider = shortcode_atts(
        [
            'posts_per_page'    => 10,
            'news_box_title'    => 'Latest News',
            'news_box_more'     => '',
            'post_type'         => 'post',
            'taxonomy'          => '',
            'terms'             => '',
            'category'          => '',
        ],
        $atts
    );

	 if ( wp_is_mobile() ) {
		$postslider['posts_per_page'] = 5;
  		}

    if( '' == $postslider['taxonomy'] || '' == $postslider['terms'] ) {
      if( '' == $postslider['category'] ) {

        $args = [
            'posts_per_page'    => $postslider['posts_per_page'],
            'post_type'         => $postslider['post_type'],
        ];


      }else{
        $args = [
            'posts_per_page'    => $postslider['posts_per_page'],
            'post_type'         => $postslider['post_type'],
            'category_name'     => $postslider['category'],

        ];
     }

	 }
	 else{
        $args = array(
            'posts_per_page'    => $postslider['posts_per_page'],
            'post_type'         => $postslider['post_type'],
            'tax_query'         => array(
                array(
                    'taxonomy'  => $postslider['taxonomy'],
                    'field'     => 'slug',
                    'terms'     => $postslider['terms'],
                ),
            ),
        );
    }



//The following lines is for the excerpt more text NEW!!
    if( 'post' != $postslider['post_type'] && '' != $postslider['news_box_more'] ){
        $read_more_text = $postslider['news_box_more'];
    }else {
        $read_more_text = "Weiterlesen...";
    }
// end of excerpt more text code

    $t = new WP_Query($args);

    if ( $t->have_posts() ) :

        while($t->have_posts()) : $t->the_post();
            // wp_trim_words function NEW!!
			$temp_id = $post->ID;
			$temp_title = get_the_title();
			$temp_link = get_permalink();
			$temp_datetime = get_the_date();
			$temp_authorname = get_the_author();
			$temp_content = get_the_excerpt();
			//$temp_ex = get_the_excerpt();
            // wp_trim_words function
            ?>

     <article class="post-<?php echo $temp_id; ?> span4 blog-slider" id="post-<?php echo $temp_id; ?>" itemscope itemtype="http://schema.org/BlogPosting">
		<div class="blog-slider-inner">

    <a href="<?php echo $temp_link; ?>" aria-label="<?php echo $temp_title; ?>" title="<?php echo $temp_title; ?>">
    <div class='post-thumb view third-effect'>
      <div class="blog-slider-image lozad" data-background-image="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail');} ?>"></div>
      <noscript><div class="blog-slider-image" style="background-image:url(<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail');} ?>);"></div></noscript>
  <div class='mask'><a href="<?php echo $temp_link ?>" class="info" aria-label="<?php echo $temp_title; ?>" title="<?php echo $temp_title; ?>"><i class="fa fa-search"></i></a></div>
	</div>
	</a>


    <header>
        <h2 class='entry-title hvr-underline-from-left' itemprop='name headline'>
        <a title="<?php echo $temp_title; ?>" aria-label="<?php echo $temp_title; ?>" rel="bookmark" href="<?php echo $temp_link; ?>">
        	<?php echo $temp_title; ?>
        </a></h2>

		<div class="entry-meta" itemprop="author" itemscope itemptype="http://schema.org/Person">
				<span class="time">
				<time class="published" datetime="<?php echo $temp_datetime; ?>" itemprop="datePublished">
				<?php echo $temp_datetime; ?>
				</time>
				</span>
<!--		<span class="meta-sep"> | </span>
			<span itemprop="name"><a class="author" rel="author"><?php echo $temp_authorname; ?></a></span></a>-->
		</div>
	</header>

                <!--BEGIN .entry-content-->


                <div class="entry-summary" itemprop="articleBody">
                    <p><?php echo $temp_content; ?></p>
                    <!--END .entry-content-->
                </div><!--END .hentry-->

        <div class="readmore"><a aria-label="<?php echo $temp_title; ?>" href="<?php echo $temp_link; ?>">
				<span data-hover="Weiterlesen...">Weiterlesen...</span>
				</a></div>

	 				</div>
            </article>

        <?php endwhile;
        $list = ob_get_clean();

        return $list;
    endif;

    wp_reset_postdata();
};


add_shortcode( 'hero_post', 'hero_post_shortcode');
function hero_post_shortcode($atts){
	ob_start();
	$heropost = shortcode_atts(
		[
			'posts_per-page'	=> '1',
			'post_type'			=> 'post',
			'category'			=> 'hero-beitrag'
		],
		$atts
	);
	
	$hero = new WP_Query($args);

	if ( $hero->have_posts() ) :
		while( $hero->have_posts() ) : $hero->the_post();
			$hero_id = $post->ID;
			$hero_title = get_the_title();
			$hero_link = get_permalink();
			$hero_content = get_the_excerpt();
			$hero_thumbnail = get_the_post_thumbnail_url();
			$hero_image_url = get_the_post_thumbnail_url();
			?>

		<?php echo $hero_title ?>
		<?php echo $hero_link ?>
		<?php echo $hero_content ?>
		<?php echo $hero_thumbnail ?>
		<?php echo $hero_thumbnail_url ?>

	<article class="post-<?php echo $hero_id; ?>" id="post-<?php echo $hero_id; ?>" itemscope itemtype="http://schema.org/BlogPosting">
	<div class="blog-slider-inner">

	<a href="<?php echo $hero_link; ?>" aria-label="<?php echo $temp_title; ?>" title="<?php echo $temp_title; ?>">
	<div class='post-thumb view third-effect'>
		<div class="blog-slider-image lozad" data-background-image="<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail');} ?>">
		</div>
	<noscript>
		<div class="blog-slider-image" style="background-image:url(<?php if ( has_post_thumbnail()) {the_post_thumbnail_url('thumbnail');} ?>);">
		</div>
	</noscript>
		<div class='mask'>
			<a href="<?php echo $hero_link ?>" class="info" aria-label="<?php echo $hero_title; ?>" title="<?php echo $temp_title; ?>">
				<i class="fa fa-search"></i>
			</a>
		</div>
	</div>
	</a>

   <header>
		<a title="<?php echo $hero_title; ?>" aria-label="<?php echo $hero_title; ?>" rel="bookmark" href="<?php echo $hero_title; ?>">
			<h2 class='entry-title hvr-underline-from-left' itemprop='name headline'>
				<?php echo $hero_title; ?>
			</h2>
		</a>
	</header>

<!--BEGIN .entry-content-->

	<div class="entry-summary" itemprop="articleBody">
		<p>
			<?php echo $hero_content; ?>
		</p>
		<!--END .entry-content-->
	</div><!--END .hentry-->

	<div class="readmore"><a aria-label="<?php echo $hero_title; ?>" href="<?php echo $hero_link; ?>">
		<span data-hover="Weiterlesen...">Weiterlesen...</span>
		</a>
	</div>

	</div>
</article>


		<?php endwhile;
		$content = ob_get_contents();

		return $content;
	endif;

	wp_reset_postdata();
};


//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
//  ------------->		   blog posts list      <-------------
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------

add_shortcode( 'post_list', 'post_list_shortcode' );
function post_list_shortcode($atts){
    ob_start();
    $postlist = shortcode_atts(
        [
            'posts_per_page'    => '6',
            'news_box_title'    => 'Latest News',
            'news_box_more'     => '',
            'post_type'         => 'post',
            'taxonomy'          => '',
            'terms'             => '',
            'category'          => '',
        ],
        $atts
    );

    if( '' == $postlist['taxonomy'] || '' == $postlist['terms'] ) {
      if( '' == $postlist['category'] ) {

        $args = [
            'posts_per_page'    => $postlist['posts_per_page'],
            'post_type'         => $postlist['post_type'],
        ];


      }else{
        $args = [
            'posts_per_page'    => $postlist['posts_per_page'],
            'post_type'         => $postlist['post_type'],
            'category_name'     => $postlist['category'],

        ];
     }

    }else{
        $args = array(
            'posts_per_page'    => $postlist['posts_per_page'],
            'post_type'         => $postlist['post_type'],
            'tax_query'         => array(
                array(
                    'taxonomy'  => $postlist['taxonomy'],
                    'field'     => 'slug',
                    'terms'     => $postlist['terms'],
                ),
            ),
        );
    }

//The following lines is for the excerpt more text NEW!!
    if( 'post' != $postlist['post_type'] && '' != $postslider['news_box_more'] ){
        $read_more_text = $postlist['news_box_more'];
    }else {
        $read_more_text = "Weiterlesen...";
    }
// end of excerpt more text code

    $t = new WP_Query($args);

    if ( $t->have_posts() ) :

        while($t->have_posts()) : $t->the_post();
            // wp_trim_words function NEW!!
			$temp_id = $post->ID;
			$temp_title = get_the_title();
			$temp_link = get_permalink();
			$temp_datetime = get_the_date();
			$temp_authorname = get_the_author();
			$temp_content = get_the_excerpt();
            // wp_trim_words function
            ?>

        <li class="postslist-item"> <a title="<?php echo $temp_title; ?>" class="item-<?php echo $temp_id; ?> hvr-underline-from-left" rel="bookmark" href="<?php echo $temp_link; ?>">
        	<?php echo $temp_title; ?>
        </a> </li>


        <?php endwhile;
        $list = ob_get_clean();

        return $list;
    endif;

    wp_reset_postdata();
};




//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
//  ----------> Youtube Slider Frontpage Shortcode <----------
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------


add_shortcode( 'youtubeslider', 'youtubeslider_shortcode2' );
function youtubeslider_shortcode2($atts){
    ob_start();
    $a = shortcode_atts(
        [
            'posts_per_page'    => '-1',
            'news_box_title'    => 'Latest News',
            'news_box_more'     => '',
            'post_type'         => 'post',
            'taxonomy'          => '',
            'terms'             => '',
            'category'          => '',
        ],
        $atts
    );

    if( '' == $a['taxonomy'] || '' == $a['terms'] ) {
      if( '' == $a['category'] ) {

        $args = [
            'posts_per_page'    => $a['posts_per_page'],
            'post_type'         => $a['post_type'],
        ];


      }else{
        $args = [
            'posts_per_page'    => $a['posts_per_page'],
            'post_type'         => $a['post_type'],
            'category_name'     => $a['category'],

        ];
     }

    }else{
        $args = array(
            'posts_per_page'    => $a['posts_per_page'],
            'post_type'         => $a['post_type'],
            'tax_query'         => array(
                array(
                    'taxonomy'  => $a['taxonomy'],
                    'field'     => 'slug',
                    'terms'     => $a['terms'],
                ),
            ),
        );
    }

    //The following lines is for the excerpt more text NEW!!
    if( 'post' != $a['post_type'] && '' != $a['news_box_more'] ){
        $read_more_text = $a['news_box_more'];
    }else {
        $read_more_text = "Weiterlesen...";
    }
    // end of excerpt more text code

    $q = new WP_Query($args);

    if ( $q->have_posts() ) :

        while($q->have_posts()) : $q->the_post();
            $newsbox_post_img_src = wp_get_attachment_image_src(get_post_thumbnail_id(), '', false, '' );

            // wp_trim_words function NEW!!
            $content = get_the_content();
            $trimmed_content = wp_trim_words( $content, 25 );
				$temp2_title = get_the_title();
				$temp2_link = get_permalink();
				$temp2_datetime = get_the_date();
				$temp2_authorname = get_the_author();
				$temp2_content = get_the_excerpt();

            // wp_trim_words function
            ?>


            <article class="post span4 blog-slider yt-video" id="post-" itemscope itemtype='http://schema.org/BlogPosting'>
			<header>
				<h2 class="entry-title yt-video" itemprop="name headline"><a title="<?php echo $temp2_title; ?>" rel="bookmark" href="<?php echo $temp_link ?>"><?php echo $temp2_title ?></a></h2>
			</header>

			<div class='entry-summary yt-video' itemprop='articleBody'>
				<?php echo $content; ?>
			</div>
            </article>
            </article>

        <?php endwhile;
        $list = ob_get_clean();

        return $list;
    endif;

    wp_reset_postdata();
};




//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
//  ----------> Messen Liste Frontpage Shortcode <----------
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
add_shortcode( 'messenliste', 'messenliste_shortcode' );
function messenliste_shortcode(){
    ob_start();
            ?>
      <?php include "/home/master/messe-liste.php"; ?>
        <?php
        $list = ob_get_clean();
        return $list;
};

//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
//  ----------> Messen Slider Frontpage Shortcode <----------
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
add_shortcode( 'messenslider', 'messen_shortcode' );
function messen_shortcode(){
    ob_start();
            ?>
      <?php include "/home/master/messen.php"; ?>
        <?php
        $list = ob_get_clean();
        return $list;
};

// Wp Auto P and BR
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
//  ------------->  		User Data 			<-------------
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
function modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['twitter'] = 'Twitter Username';
	$profile_fields['facebook'] = 'Facebook URL';
	$profile_fields['gplus'] = 'Google+ URL';
	$profile_fields['youtube'] = 'Youtube URL';
	$profile_fields['linkedin'] = 'LinkedIn URL';
	$profile_fields['delicious'] = 'Delicious URL';
	$profile_fields['tumblr'] = 'Tumblr URL';
	$profile_fields['phone'] = 'Telefon';
	$profile_fields['street'] = 'Strasse';
	$profile_fields['number'] = 'Nummer';
	$profile_fields['plz'] = 'Nummer';
	$profile_fields['city'] = 'Stadt';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');


//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------
//  -------------> 		Frontpage Shortcodes	<-------------
//  -------------> 		#################### 	<-------------
//  -------------> 		#################### 	<-------------

function section1_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'section1',
		'sectionclass' => 'section1',
	), $atts );
	return '<section class="main-content ' . esc_attr($a['sectionclass']) . '"><div class="container large-padding ' . esc_attr($a['class']) . '">' .do_shortcode($content). '</div></section>';
}
add_shortcode( 'section1', 'section1_shortcode' );



function section2_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'section2',
	), $atts );
	return '<section class="main-content color"><div class="container large-padding ' . esc_attr($a['class']) . '">' .do_shortcode($content). '</div></section>';
}
add_shortcode( 'section2', 'section2_shortcode' );


function section_blue_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'sectionblue',
	), $atts );
	return '<section class="main-content color2 ' . esc_attr($a['class']) . '"><div class="container large-padding">' .do_shortcode($content). '</div></section>';
}
add_shortcode( 'sectionblue', 'section_blue_shortcode' );



function section_last_shortcode( $atts, $content = null ) {
	return '<section class="main-content"><div class="container large-padding-top-only">' .do_shortcode($content). '</div></section>';
}
add_shortcode( 'sectionlast', 'section_last_shortcode' );




//  -------------- > Text Style Shortcodes <  --------------
function h1frontpage_shortcode( $atts, $content = null ) {
	return '<h1 class="frontpage container">' . do_shortcode($content) . '</h1>';
}
add_shortcode( 'h1frontpage', 'h1frontpage_shortcode' );


function normalh2_shortcode( $atts, $content = null ) {
	return '<h2 class="normalh2">' . do_shortcode($content) . '</h2>';
}
add_shortcode( 'h2', 'normalh2_shortcode' );

function link_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'link',
		'title' => 'link',
		'link' => 'link',
	), $atts );
	return '<a href="' . esc_attr($a['link']) . '" class="' . esc_attr($a['class']) . '" title="' . esc_attr($a['title']) . '">' .do_shortcode($content). '</a>';
}
add_shortcode( 'link', 'link_shortcode' );


function linka_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'linka',
		'title' => 'linka',
		'link' => 'linka',
	), $atts );
	return '<div class="' . esc_attr($a['class']) . '"><a href="' . esc_attr($a['link']) . '" title="' . esc_attr($a['title']) . '">' .do_shortcode($content). '</a></div>';
}
add_shortcode( 'linka', 'linka_shortcode' );



//  -------------- > Animation Shortcodes <  --------------
// move left/right animation
function slideleft_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'slideleft',
	), $atts );
	return '<div class="col-sm-6 ' . esc_attr($a['class']) . '">
			<div class="wow slideInLeft">
			<div class="text-left">' .do_shortcode($content). '</div></div></div>';
}
add_shortcode( 'slideleft', 'slideleft_shortcode' );

function slideright_shortcode( $atts, $content = null ) {
	return '<div class="col-sm-6">
			<div class="wow slideInRight">
			<div class="text-left">' .do_shortcode($content). '</div></div></div>';
}
add_shortcode( 'slideright', 'slideright_shortcode' );


//  -------------- > fade in animation  <  --------------
function fadeleft_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'fadeleft',
	), $atts );
	return '<div class="col-sm-6 ' . esc_attr($a['class']) . '">
			<div class="wow fadeInLeft">
			<div class="text-left">' .do_shortcode($content). '</div></div></div>';
}
add_shortcode( 'fadeleft', 'fadeleft_shortcode' );

function faderight_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'faderight',
	), $atts );
	return '<div class="col-sm-6 ' . esc_attr($a['class']) . '">
			<div class="wow fadeInRight">
			<div class="text-left">' .do_shortcode($content). '</div></div></div>';
}
add_shortcode( 'faderight', 'faderight_shortcode' );

function fadeintop_shortcode( $atts, $content = null ) {
	return '<div class="col-sm-6">
			<div class="wow fadeInTop">
			<div class="text-left">' .do_shortcode($content). '</div></div></div>';
}
add_shortcode( 'fadetop', 'fadeintop_shortcode' );



//  -------------- >   <  --------------
function twothird_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'col-xs-6 col-sm-3 col-md-3 col-lg-2',
	), $atts );
	return '<div class=" ' . esc_attr($a['class']) . '">
			<div class="slider-left">' .do_shortcode($content). '</div></div>';
}
add_shortcode( 'twothird', 'twothird_shortcode' );


function onethird_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-8',
	), $atts );
	return '<div class=" ' . esc_attr($a['class']) . '">
			<div class="box-right">' .do_shortcode($content). '</div></div>';
}
add_shortcode( 'onethird', 'onethird_shortcode' );




//  -------------- > Custom Stuff  <  --------------
function contact_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'contact',
	), $atts );
	return '<div id="tele-box-middle" class="' . esc_attr($a['class']) . '">
			<div class="wow fadeInDown">
			<div class="container tele-box-text wow"><i class="fa fa-phone"></i>' . do_shortcode($content) . '</div></div></div>';
}
add_shortcode( 'contact', 'contact_shortcode' );



// Title Shortcodes
function h1_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'h1',
		'title' => 'h1',
	), $atts );
	return '<h1 class="' . esc_attr($a['class']) . '" title="' . esc_attr($a['title']) . '"><span>' . do_shortcode($content) . '</span></h1>';
}
add_shortcode( 'h1', 'h1_shortcode' );


function h2_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'h2',
		'title' => 'h2',
	), $atts );
	return '<h2 class="' . esc_attr($a['class']) . '" title="' . esc_attr($a['title']) . '"><span>' . do_shortcode($content) . '</span></h2>';
}
add_shortcode( 'h2', 'h2_shortcode' );


function h3_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'h3',
	), $atts );
	return '<h3 class="' . esc_attr($a['class']) . '"><span>' . do_shortcode($content) . '</span></h3>';
}
add_shortcode( 'h3', 'h3_shortcode' );



function list_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'list',
	), $atts );

	return '<div class="check-list">
			<ul class="' . esc_attr($a['class']) . '">' . do_shortcode($content) . '</ul></div>';
}
add_shortcode( 'list', 'list_shortcode' );



function fadein_list_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'fadein_list',
	), $atts );

	return '<div class="check-list">
			<div class="wow fadeInDown"><ul class="' . esc_attr($a['class']) . '">' . do_shortcode($content) . '</ul></div></div>';
}
add_shortcode( 'fadein_list', 'fadein_list_shortcode' );



//Warning Message
function warning_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'warning',
		'title' => 'warning',
		'title2' => 'warning',
	), $atts );

	return '<div class="' . esc_attr($a['class']) . ' warning"><h2 class="warning-text">' . esc_attr($a['title']) . '</h2>
			<h2 class="warning-text">' . esc_attr($a['title2']) . '</h2><div class="warning-content">' . do_shortcode($content) . '</div></div>';
}
add_shortcode( 'warning', 'warning_shortcode' );

function important_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'important',
		'title' => 'important',
		'title2' => 'important',
	), $atts );

	return '<div class="' . esc_attr($a['class']) . ' important"><h2 class="important-title">' . esc_attr($a['title']) . '</h2>
			<div class="important-content">' . do_shortcode($content) . '</div></div>';
}
add_shortcode( 'important', 'important_shortcode' );



//Bootstrap / Javascript
function accordion_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'accordion',
		'title' => 'accordion',
	), $atts );
	return '<div class="panel-group" id="accordion">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'accordion', 'accordion_shortcode' );


function accordiontitle_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'class' => 'accordiontitle',
		'toggle_collapsed' => 'accordiontitle',
		'acc_link' => 'accordiontitle',
	), $atts );
	return '<div class="panel panel-default">
    			<a data-toggle="collapse" class="accordion-toggle ' . esc_attr($a['toggle_collapsed']) . '" data-parent="#accordion" href="#' . esc_attr($a['acc_link']) . '"><div class="panel-heading">
					<h4 class="panel-title">' . do_shortcode($content) . '</h4></div></a>';
}
add_shortcode( 'accordiontitle', 'accordiontitle_shortcode' );


function accordiontext_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'acc_link' => 'accordiontext',
		'acc_state' => 'accordiontext',
	), $atts );
	return '<div id="' . esc_attr($a['acc_link']) . '" class="panel-collapse collapse ' . esc_attr($a['acc_state']) . '">
    		<div class="panel-body">' . do_shortcode($content) . '</div></div></div>';
}
add_shortcode( 'accordiontext', 'accordiontext_shortcode' );


//Tooltip
function tooltip_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'placement' => 'tooltip',
		'title' => 'tooltip',
		'class' => 'tooltip',
	), $atts );
	return '<button type="button" class="btn btn-' . esc_attr($a['class']) . '" data-toggle="tooltip" data-placement="' . esc_attr($a['placement']) . '" title="' . esc_attr($a['title']) . '">' . do_shortcode($content) . '</button>';
}
add_shortcode( 'tooltip', 'tooltip_shortcode' );


// Youtube
function youtube_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'width' => 'youtube',
		'height' => 'youtube',
		'titleclass' => 'youtube',
		'id' => 'youtube',
		'controls' => 'youtube',
		'title' => 'youtube',
		'showinfo' => 'youtube',
		'autoplay' => 'youtube',
		'controls' => 'youtube',
	), $atts );
	return '<h2 class="youtube-title ' . esc_attr($a['titleclass']) . '"><span>' . esc_attr($a['title']) . '</span></h2><div class="video-container"><iframe width="' . esc_attr($a['width']) . '" height="' . esc_attr($a['height']) . '" src="//www.youtube.com/embed/' . esc_attr($a['id']) . '?rel=0&controls=' . esc_attr($a['controls']) . '&showinfo=' . esc_attr($a['showinfo']) . '&autoplay=' . esc_attr($a['autoplay']) . '" frameborder="" allowfullscreen></iframe></div>';
}
add_shortcode( 'youtube', 'youtube_shortcode' );



// Modal
function modal_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'buttonlink' => 'modal',
		'buttontitle' => 'modal',
		'buttonclass' => 'modal',
		'modalclass' => 'modal',
		'modallink' => 'modal',
		'modaltitle' => 'modal',

	), $atts );
	return '
	<button data-toggle="modal" href="#' . esc_attr($a['buttonlink']) . '" class="btn btn-' . esc_attr($a['buttonclass']) . ' ' . esc_attr($a['buttontitle']) . '">' . esc_attr($a['buttontitle']) . '</button>
        <div class="modal fade ' . esc_attr($a['modalclass']) . '" id="' . esc_attr($a['modallink']) . '" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        ' . esc_attr($a['modaltitle']) . '
                    </div>
                    <div class="modal-body">
                        ' . do_shortcode($content) . '
                    </div>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div> <!-- /.modal -->
	';
}
add_shortcode( 'modal', 'modal_shortcode' );


// Warnung / Info
function infobox_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'buttonlink' => 'infobox',

	), $atts );
	return '';
}
add_shortcode( 'infobox', 'infobox_shortcode' );




// Contact Page
function contactpage_shortcode( $atts, $content = null ) {
	return '<address class="contactpage">
			<div class="wow fadeInDown">' .do_shortcode($content). '</div></address>';
}
add_shortcode( 'contactpage', 'contactpage_shortcode' );





// Image Effeckt.css
function img_quarter_zoom_shortcode( $atts, $content = null ) {
	return '<figure class="effeckt-caption" data-effeckt-type="revolving-door-left">' .do_shortcode($content). '</figure>';
}
add_shortcode( 'img_quarter_zoom', 'img_quarter_zoom_shortcode' );

function img_desc_shortcode( $atts, $content = null ) {
	return '<figcaption><div class="effeckt-figcaption-wrap">' .do_shortcode($content). '</div></figcaption>';
}
add_shortcode( 'img_desc', 'img_desc_shortcode' );


function intermac_social_sharing_buttons($content) {
	global $post;
	if(is_single()){

		// Get current page URL
		$intermacURL = urlencode(get_permalink());

		// Get current page title
		$intermacTitle = str_replace( ' ', '%20', get_the_title());

		// Get Post Thumbnail for pinterest
		$intermacThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$intermacTitle.'&amp;url='.$intermacURL.'&amp;via=intermac';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$intermacURL;
		$googleURL = 'https://plus.google.com/share?url='.$intermacURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$intermacURL.'&amp;text='.$intermacTitle;
		$whatsappURL = 'whatsapp://send?text='.$intermacTitle . ' ' . $intermacURL;
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$intermacURL.'&amp;title='.$intermacTitle;

		// Based on popular demand added Pinterest too
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$intermacURL.'&amp;media='.$intermacThumbnail[0].'&amp;description='.$intermacTitle;

		// Add sharing button at the end of page/page content
		$content .= '<div id="intermac-content-bottom" class="intermac-content-wrapper"><ul class="intermac-networks-btns-wrapper intermac-networks-btns-content">';
    	$content .= '<li><a class="intermac-network-btn intermac-facebook intermac-first" href="'.$facebookURL.'" target="_blank">Facebook</a></li>';
		$content .= '<li><a class="intermac-network-btn intermac-twitter" href="'. $twitterURL .'" target="_blank">Twitter</a></li>';
		//$content .= '<li><a class="intermac-network-btn intermac-whatsapp" href="'.$whatsappURL.'" target="_blank">WhatsApp</a></li>';
		$content .= '<li><a class="intermac-network-btn intermac-google-plus" href="'.$googleURL.'" target="_blank">Google+</a></li>';
		$content .= '<li><a class="intermac-network-btn intermac-linkedin" href="'.$linkedInURL.'" target="_blank">LinkedIn</a></li>';
		//$content .= '<li><a class="intermac-network-btn intermac-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pin It</a></li>';
		$content .= '</ul></div>';

		return $content;
	}else{
		// if not a post/page then don't include sharing button
		return $content;
	}
};
add_filter( 'the_content', 'intermac_social_sharing_buttons');

add_filter('sage/display_sidebar', function ($display) {
	static $display;

	isset($display) || $display = in_array(true, [
	  // The sidebar will be displayed if any of the following return true
	  is_single(),
	  is_404(),
	  is_page('grossdichtungen'),
	  is_page('formteile'),
	  is_page('wasserstrahlteile'),
	  is_page('kunststofftechnik'),
	  is_page('zylinderservice'),
	  is_page('polyurethane'),
	  is_page('elastomere'),
	  is_page('thermoplaste'),
	  is_page('chemikalienbestaendigkeit'),
	  is_page_template('template-agb.php'),
	  is_page_template('template-cookies.php'),
	  is_page_template('template-standorte.php'),
	  is_page_template('template-frontpage_produktseite.php')
	]);
	return $display;
});