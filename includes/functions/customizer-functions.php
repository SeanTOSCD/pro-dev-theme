<?php
/**
 * Theme Customizer
 */

function pdt_customize_register( $wp_customize ) {


	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class pdt_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}


	/** ===============
	 * Site Title (Logo) & Tagline
	 */
	// section adjustments
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'pdt' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	$wp_customize->get_control( 'blogname' )->priority = 10;
	$wp_customize->get_control( 'blogdescription' )->priority = 30;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	// logo uploader
	$wp_customize->add_setting( 'pdt_logo', array(
		'default' => null
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pdt_logo', array(
		'label'     => __( 'Custom Site Logo (replaces title)', 'pdt' ),
		'section'   => 'title_tagline',
		'settings'  => 'pdt_logo',
		'priority'  => 20
	) ) );
	// hide the tagline?
	$wp_customize->add_setting( 'pdt_hide_tagline', array(
		'default'           => 0,
		'sanitize_callback' => 'pdt_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'pdt_hide_tagline', array(
		'label'     => __( 'Hide Tagline', 'pdt' ),
		'section'   => 'title_tagline',
		'priority'  => 40,
		'type'      => 'checkbox',
	) );
	// use big header
	$wp_customize->add_setting( 'pdt_big_header', array(
		'default' => 0,
		'sanitize_callback' => 'pdt_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'pdt_big_header', array(
		'label'     => __( 'Use Big Header', 'pdt' ),
		'section'   => 'title_tagline',
		'priority'  => 50,
		'type'      => 'checkbox',
	) );


	/** ===============
	 * Color Options
	 */
	// sections adjustments
	$wp_customize->get_section( 'colors' )->title = __( 'Color Options', 'pdt' );
	$wp_customize->get_section( 'colors' )->priority = 20;
	// color options
	$colors = array();
	$colors[] = array(
		'slug'     =>'pdt_primary_color',
		'default'  => '#015F8E',
		'label'    => __( 'Primary Design Color', 'pdt' )
	);
	// Build settings from $colors array
	foreach( $colors as $color ) {
		// color options
		$wp_customize->add_setting( $color['slug'], array(
			'default'     => $color['default'],
			'type'        => 'option',
			'capability'  => 'edit_theme_options'
		) );
		// color controls
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array(
			'label'     => $color['label'],
			'section'   => 'colors',
			'settings'  => $color['slug'])
		) );
	}
	// button color
	$wp_customize->add_setting( 'pdt_cta_button_color', array(
		'default'           => 'green',
		'sanitize_callback' => 'pdt_sanitize_color_radio'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pdt_cta_button_color', array(
		'label'		=> __( 'Call-to-Action Button Color', 'pdt' ),
		'section'	=> 'colors',
		'settings'	=> 'pdt_cta_button_color',
		'priority'	=> 20,
		'type'      => 'radio',
		'choices'   => array(
			'green' => __( 'Green', 'pdt' ),
			'blue'  => __( 'Blue', 'pdt' ),
			'gray'  => __( 'Gray', 'pdt' ),
		),
	) ) );


	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'pdt_content_section', array(
    	'title'        => __( 'Content Options', 'pdt' ),
		'description'  => __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'pdt' ),
		'priority'     => 30,
	) );
	// post content
	$wp_customize->add_setting( 'pdt_post_content', array(
		'default'           => 0,
		'sanitize_callback' => 'pdt_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'pdt_post_content', array(
		'label'     => __( 'Post Feed Content', 'pdt' ),
		'section'   => 'pdt_content_section',
		'priority'  => 10,
		'type'      => 'checkbox',
	) );
	// read more link
	$wp_customize->add_setting( 'pdt_read_more', array(
		'default'           => __( 'Read More', 'pdt' ) . ' &rarr;',
		'sanitize_callback' => 'pdt_sanitize_text'
	) );
	$wp_customize->add_control( 'pdt_read_more', array(
	    'label'     => __( 'Excerpt & More Link Text', 'pdt' ),
	    'section'   => 'pdt_content_section',
		'settings'  => 'pdt_read_more',
		'priority'  => 20,
	) );
	// show featured images on feed?
	$wp_customize->add_setting( 'pdt_feed_featured_image', array(
		'default'           => 0,
		'sanitize_callback' => 'pdt_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'pdt_feed_featured_image', array(
		'label'     => __( 'Show Featured Images in blog feed (full content)?', 'pdt' ),
		'section'   => 'pdt_content_section',
		'priority'  => 30,
		'type'      => 'checkbox',
	) );
	// show featured images on posts?
	$wp_customize->add_setting( 'pdt_single_featured_image', array(
		'default'           => 1,
		'sanitize_callback' => 'pdt_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'pdt_single_featured_image', array(
		'label'     => __( 'Show Featured Images on Single Posts?', 'pdt' ),
		'section'   => 'pdt_content_section',
		'priority'  => 40,
		'type'      => 'checkbox',
	) );
	// show single post footer?
	$wp_customize->add_setting( 'pdt_post_footer', array(
		'default'           => 1,
		'sanitize_callback' => 'pdt_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'pdt_post_footer', array(
		'label'     => __( 'Show Post Footer on Single Posts?', 'pdt' ),
		'section'   => 'pdt_content_section',
		'priority'  => 50,
		'type'      => 'checkbox',
	) );
	// comments on pages?
	$wp_customize->add_setting( 'pdt_page_comments', array(
		'default'           => 0,
		'sanitize_callback' => 'pdt_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'pdt_page_comments', array(
		'label'     => __( 'Display Comments on Standard Pages?', 'pdt' ),
		'section'   => 'pdt_content_section',
		'priority'  => 60,
		'type'      => 'checkbox',
	) );
	// credits & copyright
	$wp_customize->add_setting( 'pdt_credits_copyright', array(
		'default'           => null,
		'sanitize_callback' => 'pdt_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new pdt_customize_textarea_control( $wp_customize, 'pdt_credits_copyright', array(
		'label'     => __( 'Footer Credits & Copyright', 'pdt' ),
		'section'   => 'pdt_content_section',
		'priority'  => 70,
	) ) );


	/** ===============
	 * Static Front Page
	 */
	// section adjustments
	$wp_customize->get_section( 'static_front_page' )->priority = 90;
}
add_action( 'customize_register', 'pdt_customize_register' );


/** ===============
 * Sanitize checkbox options
 */
function pdt_sanitize_checkbox( $input ) {
	if ( 1 == $input ) :
	    return 1;
	else :
	    return 0;
	endif;
}


/** ===============
 * Sanitize radio options
 */
function pdt_sanitize_color_radio( $input ) {
    $color = array(
		'green' => 'Green',
		'blue'  => 'Blue',
		'gray'  => 'Gray'
    );

    if ( array_key_exists( $input, $color ) ) :
        return $input;
    else :
        return '';
    endif;
}


/** ===============
 * Sanitize text input
 */
function pdt_sanitize_text( $input ) {
    return strip_tags( stripslashes( $input ) );
}


/**
 * Sanitize textarea
 */
function pdt_sanitize_textarea( $input ) {
	$allowed = array(
		's'			=> array(),
		'br'		=> array(),
		'em'		=> array(),
		'i'			=> array(),
		'strong'	=> array(),
		'b'			=> array(),
		'a'			=> array(
			'href'			=> array(),
			'title'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'form'		=> array(
			'id'			=> array(),
			'class'			=> array(),
			'action'		=> array(),
			'method'		=> array(),
			'autocomplete'	=> array(),
			'style'			=> array(),
		),
		'input'		=> array(
			'type'			=> array(),
			'name'			=> array(),
			'class' 		=> array(),
			'id'			=> array(),
			'value'			=> array(),
			'placeholder'	=> array(),
			'tabindex'		=> array(),
			'style'			=> array(),
		),
		'img'		=> array(
			'src'			=> array(),
			'alt'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
			'height'		=> array(),
			'width'			=> array(),
		),
		'span'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'p'			=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'div'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'blockquote' => array(
			'cite'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
	);
    return wp_kses( $input, $allowed );
}


/**
 * Sanitize textarea lite
 */
function pdt_sanitize_textarea_lite( $input ) {
	$allowed = array(
		'em'     => array(),
		'strong' => array(),
		'a'      => array(
			'href'    => array(),
			'title'   => array(),
			'class'   => array(),
			'id'      => array(),
			'style'   => array(),
		),
		'img'    => array(
			'src'     => array(),
			'alt'     => array(),
			'class'   => array(),
			'id'      => array(),
			'style'   => array(),
			'height'  => array(),
			'width'   => array(),
		),
		'span'   => array(
			'class'   => array(),
			'id'      => array(),
			'style'   => array(),
		),
	);
    return wp_kses( $input, $allowed );
}


/** ===============
 * sanitize integer input
 */
function pdt_sanitize_integer( $input ) {
	return absint( $input );
}


/** ===============
 * sanitize hex colors
 */
if ( !function_exists( 'pdt_sanitize_hex_color' ) ) {
	function pdt_sanitize_hex_color( $color ) {
		if ( '' === $color )
			return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return null;
	}
}


/** ===============
 * Add Customizer theme styles to <head>
 */
function pdt_customizer_head_styles() {
	$pdt_primary_color = get_option( 'pdt_primary_color' ); ?>

	<style type="text/css">
		<?php if ( get_theme_mod( 'pdt_big_header' ) ) : // big header ?>
			.site-header { padding-top: 2em; padding-bottom: 2em; }
			.site-title { font-size: 24px; }
		<?php endif; ?>
		<?php if ( '#015F8E' != $pdt_primary_color && '' != $pdt_primary_color ) : // Primary design color ?>
			a,
			.site-title a:hover,
			.main-menu ul li:hover > ul a:hover,
			.product-title:hover {
				color: <?php echo pdt_sanitize_hex_color( $pdt_primary_color ); ?>;
			}
			.bypostauthor .comment-meta {
				border-right: 1px solid <?php echo pdt_sanitize_hex_color( $pdt_primary_color ); ?>;
			}
			@media screen and (min-width: 768px) {
				.main-menu > ul > li > a:hover,
				.main-menu > ul > .current-menu-item > a {
					border-color: <?php echo pdt_sanitize_hex_color( $pdt_primary_color ); ?>;
				}
			}
			@media screen and (max-width: 767px) {
				.main-menu a:hover,
				.main-menu ul li:hover > ul a:hover {
					color: <?php echo pdt_sanitize_hex_color( $pdt_primary_color ); ?>;
				}
			}
		<?php endif; ?>
	</style>
<?php }
add_action( 'wp_head','pdt_customizer_head_styles' );


/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function pdt_customizer_styles() { ?>
	<style type="text/css">
		body { background: #fff; }
		#customize-controls #customize-theme-controls .description { display: block; color: #999; margin: 2px 0 15px; font-style: italic; }
		textarea, input, select, .customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 10px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		#customize-control-pdt_read_more { margin-bottom: 20px; }
		#customize-control-pdt_store_front_count input[type="text"] { width: 50px; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'pdt_customizer_styles' );


/** ===============
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pdt_customize_preview_js() {
	wp_enqueue_script( 'pdt_customizer', get_template_directory_uri() . '/includes/assets/js/customizer.js', array( 'customize-preview' ), PDT_VERSION, true );
}
add_action( 'customize_preview_init', 'pdt_customize_preview_js' );