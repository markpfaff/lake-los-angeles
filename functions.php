<?php
/* 
 * Author: Mark Pfaff
 * Theme: Lake Los Angeles Theme
 */

//register custom menus
function register_my_menus() {
  register_nav_menus(
    array(
      'main-menu' => 'Main Menu' 
    )
  );
}
add_action( 'init', 'register_my_menus' );

//add support for page excerpts
add_post_type_support( 'page', 'excerpt' );

//add support for post thumbnails
add_theme_support( 'post-thumbnails' );

add_image_size( 'sml_size', 300 ); 
add_image_size( 'mid_size', 600 ); 
add_image_size( 'lrg_size', 1200 ); 
add_image_size( 'sup_size', 2400 );


if (!is_admin()) {

	// Load CSS & JS
    function lakela_styles() {
        wp_enqueue_style( 'lakela', get_stylesheet_uri() );

    }
    
    function wsma_scripts() {
        
        // unload bundled jQuery and load from cdn for faster load time
		wp_deregister_script('jquery');
        //load from cdn
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), null, false);
		//load jQuery before other js that require jQuery
        wp_enqueue_script('jquery');

        //true will load in footer which is usually what you want, false is header
    }
    //add styles before adding scripts hence the order 11 then 12
    add_action( 'wp_enqueue_scripts', 'lakela_styles', 11 );
}



// create portfolio custom post type for displaying portfolio posts on portfolio page
function create_portfolio_post_type() {

	register_post_type( 'portfolio-posts',

        array(
			'labels' => array(
				'name' => __( 'Portfolio Posts' ),
				'singular_name' => __( 'Portfolio Post' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio-posts'),
		)
	);
}

add_action( 'init', 'create_portfolio_post_type' );

//customize portfolio post type
function portfolio_post_type() {

//UI labels
	$labels = array(
		'name'                => _x( 'Portfolio Posts', 'Portfolio Posts', 'lake-los-angeles-theme' ),
		'singular_name'       => _x( 'Portfolio Post', 'Portfolio Post', 'lake-los-angeles-theme' ),
		'menu_name'           => __( 'Portfolio Posts', 'lake-los-angeles-theme' ),
		'parent_item_colon'   => __( 'Parent Portfolio Post', 'lake-los-angeles-theme' ),
		'all_items'           => __( 'All Portfolio Posts', 'lake-los-angeles-theme' ),
		'view_item'           => __( 'View Portfolio Post', 'lake-los-angeles-theme' ),
		'add_new_item'        => __( 'Add New Portfolio Post', 'lake-los-angeles-theme' ),
		'add_new'             => __( 'Add New', 'lake-los-angeles-theme' ),
		'edit_item'           => __( 'Edit Portfolio Post', 'lake-los-angeles-theme' ),
		'update_item'         => __( 'Update Portfolio Post', 'lake-los-angeles-theme' ),
		'search_items'        => __( 'Search Portfolio Posts', 'lake-los-angeles-theme' ),
		'not_found'           => __( 'Not Found', 'lake-los-angeles-theme' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'lake-los-angeles-theme' ),
	);
	
//more options
	
	$args = array(
		'label'               => __( 'portfolio-posts', 'lake-los-angeles-theme' ),
		'description'         => __( 'Portfolio Posts', 'lake-los-angeles-theme' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'portfolio-posts' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	register_post_type( 'portfolio-posts', $args );

}

add_action( 'init', 'portfolio_post_type', 0 );


//add portfolio title to portfolio post
add_action( 'admin_menu', 'la_portfolio_title_create' );
add_action( 'save_post', 'la_portfolio_title_save', 10, 2 );

function la_portfolio_title_create() {
    add_meta_box( 'la-portfolio-title', 'Portfolio Title', 'la_portfolio_title', 'portfolio-posts', 'advanced', 'high' );
}

function la_portfolio_title( $post ) { 
    // retrieve the _la_portfolio_title current value
    $current_portfolio_title = get_post_meta( $post->ID, '_la_portfolio_title', true );
    
    ?>
	<p>
		<label>Portfolio Title</label>
		<br />
        <input name="la-portfolio-title" id="portfolio-title" style="width: 97%;" value="<?php echo $current_portfolio_title; ?>">
		<input type="hidden" name="la_portfolio_title_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>">
	</p>
<?php }

function la_portfolio_title_save( $post_id ) {
	// verify meta box nonce
	if ( !isset( $_POST['la_portfolio_title_nonce'] ) || !wp_verify_nonce( $_POST['la_portfolio_title_nonce'], basename( __FILE__ ) ) ){
		return;
	}
    
    // return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
    //check permissions
	if ( !current_user_can( 'edit_post', $post_id ) ){
        return;
    }
    
    // store portfolio title value
	if ( isset( $_REQUEST['la-portfolio-title'] ) ) {
		update_post_meta( $post_id, '_la_portfolio_title', sanitize_text_field( $_POST['la-portfolio-title'] ) );
	}
    
}

//add publication title to portfolio post
add_action( 'admin_menu', 'la_publication_title_create' );
add_action( 'save_post', 'la_publication_title_save', 10, 2 );

function la_publication_title_create() {
    add_meta_box( 'la-publication-title', 'Publication Title', 'la_publication_title', 'portfolio-posts', 'advanced', 'high' );
}

function la_publication_title( $post ) { 
    // retrieve the _la_portfolio_title current value
    $current_publication_title = get_post_meta( $post->ID, '_la_publication_title', true );

    ?>
	<p>
		<label>Publication Title</label>
		<br />
		<input name="la-publication-title" id="publication-title" style="width: 97%;" value="<?php echo $current_publication_title; ?>">
		<input type="hidden" name="la_publication_title_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>">
	</p>
<?php }

function la_publication_title_save( $post_id ) {
	// verify meta box nonce
	if ( !isset( $_POST['la_publication_title_nonce'] ) || !wp_verify_nonce( $_POST['la_publication_title_nonce'], basename( __FILE__ ) ) ){
		return;
	}
    
    // return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
    //check permissions
	if ( !current_user_can( 'edit_post', $post_id ) ){
        return $post_id;
        
    }
    // store publication title value
	if ( isset( $_REQUEST['la-publication-title'] ) ) {
		update_post_meta( $post_id, '_la_publication_title', sanitize_text_field( $_POST['la-publication-title'] ) );
	}

}

//add portfolio link to portfolio post
add_action( 'admin_menu', 'la_portfolio_link_create' );
add_action( 'save_post', 'la_portfolio_link_save', 10, 2 );

function la_portfolio_link_create() {
    add_meta_box( 'la-portfolio-link', 'Portfolio Link', 'la_portfolio_link', 'portfolio-posts', 'advanced', 'high' );
}



function la_portfolio_link( $post ) { 
    // retrieve the _la_portfolio_title current value
    $current_portfolio_link = get_post_meta( $post->ID, '_la_portfolio_link', true );

    ?>
	<p>
		<label>Portfolio Link</label>
		<br />
        <input name="la-portfolio-link" id="portfolio-link" style="width: 97%;" value="<?php echo $current_portfolio_link; ?>">
		<input type="hidden" name="la_portfolio_link_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>">
	</p>
<?php 

} 

 

function la_portfolio_link_save( $post_id ) {
	// verify taxonomies meta box nonce
	if ( !isset( $_POST['la_portfolio_link_nonce'] ) || !wp_verify_nonce( $_POST['la_portfolio_link_nonce'], basename( __FILE__ ) ) ){
		return $post_id;
	}
    
    // return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return $post_id;
	}
    
    // Check the user's permissions.
	if ( !current_user_can( 'edit_post', $post_id ) ){
        return $post_id;
        
    }
    
    // store portfolio title value
	if ( isset( $_REQUEST['la-portfolio-link'] ) ) {
		update_post_meta( $post_id, '_la_portfolio_link', sanitize_text_field( $_POST['la-portfolio-link'] ) );
	}

}

// Move all "advanced" metaboxes above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});

//add thumbnail support
add_theme_support( 'post-thumbnails' );
