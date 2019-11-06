<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

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

	<div class="entry-content">
		<?php
			the_content();

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

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
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
