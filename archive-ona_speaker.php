<?php
/**
 * The template for displaying Category pages.
 *
 * @subpackage Twenty_Twelve_Child for ONA
 *
 * EXACTLY LIKE THE TAG TEMPLATE, EXCEPT FOR H1
 */
get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
       

		<?php 
		if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title">Speakers</h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); 
				$category = get_the_category();
				$speaker = new ONA_Speaker( get_the_ID() ); ?>
				<div class="news_item">
                	<?php if ( has_post_thumbnail() ) {
                    	the_post_thumbnail(array(55,55));
                    } else { ?>
                    	<img class="attachment-thumbnail wp-post-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/category-filler.png" width="55" height="55"/>
                    <?php } ?>
                    <div<?php if(is_numeric($sponsor[0])) { ?> class="Sponsored"<?php } ?>>
                        <h2><a href="<?php the_permalink();?>" title="<?php the_title();?>" ><?php the_title();?></a></h2>
                        <p><?php echo $speaker->get_title().', '.$speaker->get_organization(); if( $speaker->get_twitter() != '' ) { 
						$twitterlink = str_replace("@", "", $speaker->get_twitter());
						echo ' | <a href="'.$twitterlink.'" target="_blank">'.$speaker->get_twitter().'</a>'; }?></p>
                    </div>
                </div>
			<?php endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>