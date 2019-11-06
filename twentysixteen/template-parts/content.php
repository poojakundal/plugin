<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
		<?php endif; ?>

		
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<header class="entry-header">
                        <!-- Display featured image in right-aligned floating div -->
                        <div style="float: right; margin: 10px">
                            <?php the_post_thumbnail( array( 100, 100 ) ); ?>
                        </div>
        
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
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php twentysixteen_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
