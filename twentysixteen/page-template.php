<?php
 /*Template Name: Book Template
 */
 
get_header();
 ?>
<div class="container">
    <div class="content-left-wrap col-9">
        <div id="primary" class="content-area">
        
        <?php 
        $paged = get_query_var('page');
        $number_of_books =  get_option('number_of_books'); ?>
        <?php 
        $mypost = array( 
            'post_type' => 'book',
            'numberposts' => -1,
            'posts_per_page' => $number_of_books,
            'paged' => $paged
        );
        $loop = new WP_Query( $mypost );
        ?>
        <?php if ($loop->have_posts()) : ?>
            <?php while ( $loop->have_posts() ) : $loop->the_post();?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <!-- Display featured image in right-aligned floating div -->
                        <div style="float: right; margin: 10px">
                            <?php the_post_thumbnail( array( 100, 100 ) ); ?>
                        </div>
        
                        <!-- Display Title and Author Name -->
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        <!-- Display Title and Author Name -->
                        <strong>Auther Name : </strong>
                        <?php echo esc_html( get_post_meta( get_the_ID(), 'auther_name', true ) ); ?>
                        <br />
        
                        <strong>Price: </strong>
                        <?php echo esc_html( get_post_meta( get_the_ID(), 'price', true ) ); ?>
                        <br />

                        <strong>Publisher: </strong>
                        <?php echo esc_html( get_post_meta( get_the_ID(), 'publisher', true ) ); ?>
                        <br />
        
                        <strong>Year: </strong>
                        <?php echo esc_html( get_post_meta( get_the_ID(), 'year', true ) ); ?>
                        <br />

                        <strong>Edition: </strong>
                        <?php echo esc_html( get_post_meta( get_the_ID(), 'edition', true ) ); ?>
                        <br />
        
                        <strong>URL: </strong>
                        <?php echo esc_html( get_post_meta( get_the_ID(), 'url', true ) ); ?>
                        <br />

                        <?php $terms = get_the_terms( get_the_ID(), 'book_tag' );
                            if ( $terms && ! is_wp_error( $terms ) ) : 
                                $book_t = array();
                                foreach ( $terms as $term ) {
                                    $book_t[] = $term->name;
                                }
                                $book_tag = join( ", ", $book_t );
                                ?>
                        <strong>Tag: </strong>
                        <?php echo esc_html( $book_tag ); ?>
                        <br />
                        <?php endif; ?>

                        <?php $terms = get_the_terms( get_the_ID(), 'book_category' );
                            if ( $terms && ! is_wp_error( $terms ) ) : 
                                $book_c = array();
                                foreach ( $terms as $term ) {
                                    $book_c[] = $term->name;
                                }
                                $book_category = join( ", ", $book_c );
                                ?>
                        <strong>Category: </strong>
                        <?php echo esc_html( $book_category ); ?><br />
                        <div class="entry-content"><?php the_content(); ?></div>
                        <br /><br />
                        <?php endif; ?>
                    </header>
                </article>
            <?php endwhile; ?>
     <nav class="navigation pagination" role="navigation">
        <?php 
            $total_pages = $loop->max_num_pages;

            if ($total_pages > 1){

                $current_page = max(1, get_query_var('page'));

                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '/page/%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text'    => __('« prev'),
                    'next_text'    => __('next »'),
                ));
            }  ?>
	</nav>
        <?php endif; ?>
            </div>
        </div>
        <div class="sidebar-wrap col-3 content-left-wrap">
            <?php get_sidebar();?>
        </div>
    </div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
