<?php
/**
 * Theme Customizer
 */

function sdm_customize_register( $wp_customize ) {



	/** ===============
	 * Extends SECTIONS class to add description text
	 */
	class sdm_customize_section extends WP_Customize_Section {
		public $description = '';
		protected function render() { ?>
		
		<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="control-section accordion-section customize-section">
			<h3 class="accordion-section-title customize-section-title" tabindex="0"><?php echo esc_html( $this->title ); ?></h3>
			<ul class="accordion-section-content customize-section-content">
				<span class="customize-description"><?php echo esc_html( $this->description ); ?></span>
				<?php
				foreach ( $this->controls as $control )
					$control->maybe_render();
				?>
			</ul>
		</li>
		
		<?php }
	}
	
	
	
	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class sdm_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
	<?php
		}
	}



	/** ===============
	 * Add NEW customizer SECTIONS
	 */
	$add_sections = array(
		'content'			=> array(
			'id'			=> 'sdm_content_section',
			'title'			=> __( 'Content Options', 'sdm' ),
			'description'	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'sdm' ),
			'priority'		=> 30
		),
		'feature'			=> array(
			'id'			=> 'sdm_feature_box',
			'title'			=> __( 'Feature Box Options', 'sdm' ),
			'description'	=> __( 'Set the main Feature Box content here which displays on the &rsquo;Front Page&rsquo; only. Further customization is done in template files.', 'sdm' ),
			'priority'		=> 35
		),
		'edd'				=> array(
			'id'			=> 'sdm_edd_options',
			'title'			=> __( 'Easy Digital Downloads', 'sdm' ),
			'description'	=> __( 'You must set the \'Store Front Headline\' if using the Store Front page template. All other EDD options are under Dashboard => Downloads.', 'sdm' ),
			'priority'		=> 40
		),
		'social networks'	=> array(
			'id'			=> 'sdm_social_networks',
			'title'			=> __( 'Social Networking Profiles', 'sdm' ),
			'description'	=> __( 'Paste full URLs to profiles. The URLs will be used in various places around the theme like the post footer author section on single posts.', 'sdm' ),
			'priority'		=> 70
		),
	);
	// Build the sections based on the $add_sections array
	foreach ( $add_sections as $section ) {
		$wp_customize->add_section( new sdm_customize_section( $wp_customize, $section[ 'id' ], array(
	    	'title'       	=> $section[ 'title' ],
			'description' 	=> $section[ 'description' ],
			'priority'   	=> $section[ 'priority' ],
		) ) );
	}
	
	
	
	/** ===============
	 * Add NEW customizer SETTINGS
	 */
	$add_settings = array(
		'post content'		=> array(
			'id'			=> 'sdm_post_content',
			'default'		=> 'option1'
		),
		'excerpt link'		=> array(
			'id'			=> 'sdm_read_more',
			'default'		=> 'Read More &rarr;'
		),
		'featured img'		=> array(
			'id'			=> 'sdm_single_featured_image',
			'default'		=> 'option1'
		),
		'post footer'		=> array(
			'id'			=> 'sdm_post_footer',
			'default'		=> 'option1'
		),
		'page comments'		=> array(
			'id'			=> 'sdm_page_comments',
			'default'		=> 'option2'
		),
		'site copyright'	=> array(
			'id'			=> 'sdm_credits_copyright',
			'default'		=> null
		),
		'fb toggle'	=> array(
			'id'			=> 'sdm_feature_toggle',
			'default'		=> 'option1'
		),
		'fb product headline'	=> array(
			'id'			=> 'sdm_feature_product_headline',
			'default'		=> 'Main Product Headline'
		),
		'fb product description'	=> array(
			'id'			=> 'sdm_feature_product_description',
			'default'		=> 'Main Product Description'
		),
		'download comments'	=> array(
			'id'			=> 'sdm_download_comments',
			'default'		=> 'option2'
		),
		'twitter'			=> array(
			'id'			=> 'sdm_twitter',
			'default'		=> null
		),
		'facebook'			=> array(
			'id'			=> 'sdm_facebook',
			'default'		=> null
		),
		'gplus'				=> array(
			'id'			=> 'sdm_gplus',
			'default'		=> null
		),
		'github'			=> array(
			'id'			=> 'sdm_github',
			'default'		=> null
		),
	);
	// Build the settings based on the $add_settings
	foreach ( $add_settings as $setting ) {
		$wp_customize->add_setting( $setting[ 'id' ], array( 
			'default' => $setting[ 'default' ] 
		) );
	}
	
	
	
	/** ===============
	 * Add NEW customizer CONTROLS ** by control type **
	 */	
	
	// Text input control types
	$add_text_controls = array(
		'sdm_read_more'	=> array(
			'id'		=> 'sdm_read_more',
			'label'		=> __( 'Excerpt & More Link Text', 'sdm' ),
			'section'	=> 'sdm_content_section',
			'settings'	=> 'sdm_read_more',
			'priority'	=> 20,
		),
		'sdm_credits_copyright'	=> array(
			'id'		=> 'sdm_credits_copyright',
			'label'		=> __( 'Footer Credits & Copyright', 'sdm' ),
			'section'	=> 'sdm_content_section',
			'settings'	=> 'sdm_credits_copyright',
			'priority'	=> 60,
		),
		'sdm_feature_product_headline'	=> array(
			'id'		=> 'sdm_feature_product_headline',
			'label'		=> __( 'Main Product Headline', 'sdm' ),
			'section'	=> 'sdm_feature_box',
			'settings'	=> 'sdm_feature_product_headline',
			'priority'	=> 20,
		),
		'sdm_twitter'	=> array(
			'id'		=> 'sdm_twitter',
			'label'		=> __( 'Twitter Profile URL', 'sdm' ),
			'section'	=> 'sdm_social_networks',
			'settings'	=> 'sdm_twitter',
		),
		'sdm_facebook'	=> array(
			'id'		=> 'sdm_facebook',
			'label'		=> __( 'Facebook Profile URL', 'sdm' ),
			'section'	=> 'sdm_social_networks',
			'settings'	=> 'sdm_facebook',
		),
		'sdm_gplus'	=> array(
			'id'		=> 'sdm_gplus',
			'label'		=> __( 'Google Plus Profile URL', 'sdm' ),
			'section'	=> 'sdm_social_networks',
			'settings'	=> 'sdm_gplus',
		),
		'sdm_github'	=> array(
			'id'		=> 'sdm_github',
			'label'		=> __( 'Github Profile URL', 'sdm' ),
			'section'	=> 'sdm_social_networks',
			'settings'	=> 'sdm_github',
		),
	);
	// Build the text input controls based on the $add_text_controls
	foreach ( $add_text_controls as $control ) {
		$wp_customize->add_control( $control[ 'id' ], array(
		    'label' 	=> $control[ 'label' ],
		    'section' 	=> $control[ 'section' ],
			'settings' 	=> $control[ 'settings' ],
			'priority' 	=> $control[ 'priority' ]
		) );
	}
	
	
	// Textarea input control types
	$add_textarea_controls = array(
		'sdm_feature_product_description'	=> array(
			'id'		=> 'sdm_feature_product_description',
			'label'		=> __( 'Main Product Description', 'sdm' ),
			'section'	=> 'sdm_feature_box',
			'settings'	=> 'sdm_feature_product_description',
			'priority'	=> 30,
		),
	);
	// Build the textarea input controls based on the $add_textarea_controls
	foreach ( $add_textarea_controls as $control ) {
		$wp_customize->add_control( new sdm_customize_textarea_control( $wp_customize, $control[ 'id' ], array(
		    'label' 	=> $control[ 'label' ],
		    'section' 	=> $control[ 'section' ],
			'settings' 	=> $control[ 'settings' ],
			'priority' 	=> $control[ 'priority' ]
		) ) );
	}
	
	
	// Radio input control types	
	$add_radio_controls = array(
		'sdm_post_content'	=> array(
			'id'		=> 'sdm_post_content',
			'label'		=> __( 'Post Feed Content', 'sdm' ),
			'section'	=> 'sdm_content_section',
			'settings'	=> 'sdm_post_content',
			'priority'	=> 10,
			'option1'	=> 'Excerpts',
			'option2'	=> 'Full Content'
		),
		'sdm_single_featured_image'	=> array(
			'id'		=> 'sdm_single_featured_image',
			'label'		=> __( 'Show Featured Images on Single Posts?', 'sdm' ),
			'section'	=> 'sdm_content_section',
			'settings'	=> 'sdm_single_featured_image',
			'priority'	=> 30,
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
		'sdm_post_footer'	=> array(
			'id'		=> 'sdm_post_footer',
			'label'		=> __( 'Show Post Footer on Single Posts?', 'sdm' ),
			'section'	=> 'sdm_content_section',
			'settings'	=> 'sdm_post_footer',
			'priority'	=> 40,
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
		'sdm_page_comments'	=> array(
			'id'		=> 'sdm_page_comments',
			'label'		=> __( 'Display Comments on Standard Pages?', 'sdm' ),
			'section'	=> 'sdm_content_section',
			'settings'	=> 'sdm_page_comments',
			'priority'	=> 50,
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
		'sdm_feature_toggle'	=> array(
			'id'		=> 'sdm_feature_toggle',
			'label'		=> __( 'Display Default Feature Box?', 'sdm' ),
			'section'	=> 'sdm_feature_box',
			'settings'	=> 'sdm_feature_toggle',
			'priority'	=> 10,
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
		'sdm_download_comments'	=> array(
			'id'		=> 'sdm_download_comments',
			'label'		=> __( 'Display Comments on Download Pages?', 'sdm' ),
			'section'	=> 'sdm_edd_options',
			'settings'	=> 'sdm_download_comments',
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
	);
	// Build the radio input controls based on the $add_radio_controls
	foreach ( $add_radio_controls as $control ) {
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $control[ 'id' ], array(
			'label'     => $control[ 'label' ],
			'section'   => $control[ 'section' ],
			'settings'  => $control[ 'settings' ],
			'priority'  => $control[ 'priority' ],
			'type'      => 'radio',
			'choices'   => array(
			    'option1'   => $control[ 'option1' ],
			    'option2'   => $control[ 'option2' ],
			),
		) ) );
	}
    
	
	
	/** ===============
	 * Add to, take away from, and edit EXISTING WordPress sections
	 */
	
	// logo uploader setting
	$wp_customize->add_setting( 'sdm_logo', array( 'default' => null ) );
	 
	// logo uploader control
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sdm_logo', array(
		'label'    => __( 'Custom Site Logo', 'sdm' ),
		'section'  => 'title_tagline',
		'settings' => 'sdm_logo',
	) ) );
	 	 
	/**
	 * color customization options
	 */
	$colors = array();
	$colors[] = array(
		'slug'=>'sdm_primary_color', 
		'default' => '#015F8E',
		'label' => __('Primary Design Color', 'sdm' )
	);
	// Build settings from $colors array
	foreach( $colors as $color ) {
	
		// customizer settings
		$wp_customize->add_setting( $color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 'edit_theme_options'
			)
		);
		
		// customizer controls
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array(
			'label' => $color['label'], 
			'section' => 'colors',
			'settings' => $color['slug'])
		) );
	}
	
	/**
	 * change default section titles
	 */
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'sdm' );
	$wp_customize->get_section( 'colors' )->title = __( 'Color Settings', 'sdm' );
	$wp_customize->get_section( 'nav' )->title = __( 'Navigation Menu', 'sdm' );
	
	/**
	 * change default section order
	 */
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	$wp_customize->get_section( 'colors' )->priority = 20;
	$wp_customize->get_section( 'nav' )->priority = 50;
	$wp_customize->get_section( 'static_front_page' )->priority = 60;
	
	
	
	/** ===============
	 * live updates for better user experience
	 */
	$post_message = array( 
		'blogname', 
		'blogdescription', 
		'sdm_read_more',
		'sdm_credits_copyright',
		'sdm_feature_product_headline',
		'sdm_feature_product_description'
	);
	foreach ( $post_message as $pm ) {
		$wp_customize->get_setting( $pm )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'sdm_customize_register' );



/** ===============
 * Add Customizer theme styles to <head>
 */
function sdm_customizer_head_styles() {
	$sdm_primary_color = get_option( 'sdm_primary_color' ); ?>
	
	<style type="text/css">
		
		<?php 
		/**
		 * Only add styles to the head of the document if the styles
		 * have been changed from default. 
		 */	
		if ('#015F8E' != $sdm_primary_color ) : // Primary design color ?>
		
			a, .site-title a:hover { 
				color: <?php echo $sdm_primary_color; ?>; 
			}
			.main-menu > ul > li > a:hover, 
			.main-menu > ul > .current-menu-item > a { 
				border-bottom: 3px solid <?php echo $sdm_primary_color; ?>; 
			}
			.bypostauthor .comment-meta { 
				border-right: 3px solid <?php echo $sdm_primary_color; ?>; 
			}
					
		<?php endif; ?>
	
	</style>
	
<?php }
add_action( 'wp_head','sdm_customizer_head_styles' );



/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function sdm_customizer_styles() { ?>
	<style type="text/css">
		.customize-description { display: block; color: #999; margin: 10px 0 1em; font-style: italic; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'sdm_customizer_styles');



/** ===============
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sdm_customize_preview_js() {
	wp_enqueue_script( 'sdm_customizer', get_template_directory_uri() . '/inc/assets/js/customizer.js', array( 'customize-preview' ), '20130727', true );
}
add_action( 'customize_preview_init', 'sdm_customize_preview_js' );