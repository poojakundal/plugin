<?php
/*
    Plugin Name: WP Book 
    Plugin URI: https://google.com/
    Description: WP Book Plugin
    Version: 1.0.0
    Author: Pooja Kundal    
*/


function register_book_post_type() {
 
	$labels = array(
		'name'               => 'Book',
		'singular_name'      => 'Book',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Book',
		'edit_item'          => 'Edit Book',
		'new_item'           => 'New Book',
		'all_items'          => 'All Book',
		'view'               => 'View',
		'view_item'          => 'View Book',
		'search_items'       => 'Search Book',
		'not_found'          => 'No books found',
		'not_found_in_trash' => 'No books found in Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Book'
	);
 
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail' )
    );
    register_post_type( 'book', $args );
}

function register_book_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Book Category', 'taxonomy general name' ),
		'singular_name'              => _x( 'Book Category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Book Category' ),
		'popular_items'              => __( 'Popular Book Category' ),
		'all_items'                  => __( 'All Book Category' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Book Category' ),
		'update_item'                => __( 'Update Book Category' ),
		'add_new_item'               => __( 'Add New Book Category' ),
		'new_item_name'              => __( 'New Book Category Name' ),
		'separate_items_with_commas' => __( 'Separate Book Category with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Book Category' ),
		'choose_from_most_used'      => __( 'Choose from the most used Book Category' ),
		'not_found'                  => __( 'No Book Category found.' ),
		'menu_name'                  => __( 'Book Category' ),
	);
	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'Book Category' ),
	);
    register_taxonomy('book_category',array('book'), $args);
}

function register_book_tag_taxonomy() {

    $labels = array(
		'name'                       => _x( 'Book Tag', 'taxonomy general name' ),
		'singular_name'              => _x( 'Book Tag', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Book Tag' ),
		'popular_items'              => __( 'Popular Book Tag' ),
		'all_items'                  => __( 'All Book Tag' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Book Tag' ),
		'update_item'                => __( 'Update Book Tag' ),
		'add_new_item'               => __( 'Add New Book Tag' ),
		'new_item_name'              => __( 'New Book Tag Name' ),
		'separate_items_with_commas' => __( 'Separate Book Tag with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Book Tag' ),
		'choose_from_most_used'      => __( 'Choose from the most used Book Tag' ),
		'not_found'                  => __( 'No Book Tag found.' ),
		'menu_name'                  => __( 'Book Tag' ),
	);
	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'Book Tag' ),
	);
    register_taxonomy('book_tag','book', $args);
}

function my_book() {
    add_meta_box( 'book_meta_box',
        'Book Details',
        'display_book_meta_box',
        'book', 'normal', 'high'
    );
}

function display_book_meta_box( $book ) {
    $auther_name = esc_html( get_post_meta( $book->ID, 'auther_name', true ) );
	$price = esc_html( get_post_meta( $book->ID, 'price', true ) );
	$publisher = esc_html( get_post_meta( $book->ID, 'publisher', true ) );
	$year = esc_html( get_post_meta( $book->ID, 'year', true ) );
	$edition = esc_html( get_post_meta( $book->ID, 'edition', true ) );
	$url = esc_html( get_post_meta( $book->ID, 'url', true ) );
    ?>
    <table>
        <tr>
            <td style="width: 100%">Auther Name</td>
            <td><input type="text" size="80" name="book_auther_name" value="<?php echo $auther_name; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Price</td>
            <td><input type="text" size="80" name="book_price" value="<?php echo $price; ?>" /></td>
        </tr>
		<tr>
            <td style="width: 100%">Publisher</td>
            <td><input type="text" size="80" name="book_publisher" value="<?php echo $publisher; ?>" /></td>
        </tr>
		<tr>
            <td style="width: 100%">Year</td>
            <td><input type="text" size="80" name="book_year" value="<?php echo $year; ?>" /></td>
        </tr>
		<tr>
            <td style="width: 100%">Edition</td>
            <td><input type="text" size="80" name="book_edition" value="<?php echo $edition; ?>" /></td>
        </tr>
		<tr>
            <td style="width: 100%">URL</td>
            <td><input type="text" size="80" name="book_url" value="<?php echo $url; ?>" /></td>
        </tr>
    </table>
    <?php
}

function add_book_fields( $book_id, $book ) {
    // Check post type for movie reviews
    if ( $book->post_type == 'book' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['book_auther_name'] ) && $_POST['book_auther_name'] != '' ) {
            update_post_meta( $book_id, 'auther_name', $_POST['book_auther_name'] );
        }
		if ( isset( $_POST['book_price'] ) && $_POST['book_price'] != '' ) {
            update_post_meta( $book_id, 'price', $_POST['book_price'] );
		}
		if ( isset( $_POST['book_publisher'] ) && $_POST['book_publisher'] != '' ) {
            update_post_meta( $book_id, 'publisher', $_POST['book_publisher'] );
		}
		if ( isset( $_POST['book_year'] ) && $_POST['book_year'] != '' ) {
            update_post_meta( $book_id, 'year', $_POST['book_year'] );
		}
		if ( isset( $_POST['book_edition'] ) && $_POST['book_edition'] != '' ) {
            update_post_meta( $book_id, 'edition', $_POST['book_edition'] );
		}
		if ( isset( $_POST['book_url'] ) && $_POST['book_url'] != '' ) {
            update_post_meta( $book_id, 'url', $_POST['book_url'] );
        }
    }
}



// global $jal_db_version;
// $jal_db_version = '1.0';

// function jal_install() {
// 	global $wpdb;
// 	global $jal_db_version;

// 	$table_name = $wpdb->prefix . 'booK_info';
	
// 	$charset_collate = $wpdb->get_charset_collate();

// 	$sql = "CREATE TABLE $table_name (
// 		id mediumint(9) NOT NULL AUTO_INCREMENT,
// 		user_id bigint(20) unsigned NOT NULL default '0',
// 		auther_name varchar(55) NOT NULL,
// 		price DECIMAL(5) NOT NULL,
// 		publisher varchar(55) NOT NULL,
// 		byear YEAR(4) NOT NULL,
// 		bedition int(3) NOT NULL,
// 		burl text NOT NULL,
// 		PRIMARY KEY  (id),
// 		KEY user_id (user_id)
// 	) $charset_collate;";

// 	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
// 	dbDelta( $sql );

// 	add_option( 'jal_db_version', $jal_db_version );
// }

// function jal_install_data() {
// 	global $wpdb;
	
// 	$welcome_name = 'Mr. WordPress';
// 	$welcome_text = 'Congratulations, you just completed the installation!';
	
// 	$table_name = $wpdb->prefix . 'book_info';
	
// 	$wpdb->insert( 
// 		$table_name, 
// 		array( 
// 			'auther_name' => $auther_name,
// 			'price' => $price, 
// 			'publisher' => $publisher, 
// 			'byear' => $byear, 
// 			'bedition' => $bedition, 
// 			'burl' => $burl, 
// 		) 
// 	);
// }

// register_activation_hook( __FILE__, 'jal_install' );
// register_activation_hook( __FILE__, 'jal_install_data' );


add_action( 'save_post', 'add_book_fields', 10, 2 );
add_action( 'init', 'register_book_post_type' );
add_action( 'init', 'register_book_category_taxonomy' );
add_action( 'init', 'register_book_tag_taxonomy' );
add_action( 'admin_init', 'my_book' );


add_shortcode( 'book', 'book_shortcode' );
function book_shortcode( $atts ) {
    ob_start();
 
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'type' => 'book',
        'order' => 'date',
        'orderby' => 'title',
        'posts' => -1,
		'book_category' => '',
		'book_tag' => ''
    ), $atts ) );
 
    // define query parameters based on attributes
    $options = array(
        'post_type' => $type,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
		'book_category' => $book_category,
		'book_tag' => $book_tag
    );
    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { ?>
        <ul class="list-posts ">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>		
            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ul>
    <?php
        $myvariable = ob_get_clean();
        return $myvariable;
    }
}


// Create a shortcode [book] to display the book(s) information.
// Shortcode attributes should be id, author_name, year, category, tag, and publisher.

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Top 5 Books', 'custom_dashboard_help');
}
function custom_dashboard_help() {
		?>
	<div id="primary">
		<div id="content" role="main">	
			<?php  
			$terms = get_terms("book_category", array('orderby' => 'count', 'order' => 'DESC'));
				if ( !empty( $terms ) && !is_wp_error( $terms ) ){
					$count=1;
					foreach ( $terms as $term ) {
						if($count<=5) :
							echo $term->name.' (' . $term->count . ')';?><br/><?php
							$count++;
						endif;
					}
					
				} 
			?> 

		</div>
	</div><?php
}


// function my_custom_sidebar() {
//     register_sidebar(
//         array (
//             'name' => __( 'Custom', 'your-theme-domain' ),
//             'id' => 'custom-side-bar',
//             'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
//             'before_widget' => '<div id="%1$s" class="widget %2$s">',
//             'after_widget'  => '</div>',
//             'before_title'  => '<h3 class="widget-title">',
//             'after_title'   => '</h3>',
//         )
//     );
// }
// add_action( 'widgets_init', 'my_custom_sidebar' );




// register My_Widget



class jpen_Example_Widget extends WP_Widget {
  /**
  * To create the example widget all four methods will be 
  * nested inside this single instance of the WP_Widget class.
  **/
  public function __construct() {
    $widget_options = array( 
      'classname' => 'example_widget',
      'description' => 'This is an Example Widget',
    );
    parent::__construct( 'example_widget', 'Example Widget', $widget_options );
  }

  public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
	echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
		<?php
		$terms = get_terms('book_category');
		echo '<ul>';
		foreach ($terms as $term) {
			echo '<li><a href="'.get_term_link($term).'">'.$term->name.' (' . $term->count . ')</a></li>';
		}
		echo '</ul>';?>
		
	<?php echo $args['after_widget'];
  }
  public function form( $instance ) {
	$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
	<p>
	  <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	  <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	</p><?php 
  }
  public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	return $instance;
  }
}
function jpen_register_example_widget() { 
	register_widget( 'jpen_Example_Widget' );
  }
  add_action( 'widgets_init', 'jpen_register_example_widget' );




add_action('admin_menu', 'admin_page_create');
function admin_page_create() {
    $page_title = 'Admin Settings Page';
    $menu_title = 'Admin Page';
    $capability = 'edit_posts';
    $menu_slug = 'admin_page';
    $function = 'my_admin_page_display';
    $icon_url = '';
    $position = 28;

	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'admin-settings', 'currency' );
	register_setting( 'admin-settings', 'number_of_books' );
}

function my_admin_page_display(){
	?>
<div class="wrap">
<h1>Custom Admin Settings Page</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'admin-settings' ); ?>
    <?php do_settings_sections( 'admin-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Number Of Books Per Page</th>
        <td><input type="text" name="number_of_books" value="<?php echo esc_attr( get_option('number_of_books') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } 


