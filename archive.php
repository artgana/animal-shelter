<?php
/**
 * The template for displaying archive pages
 */

get_header();
get_template_part( 'parts/overall', 'header' );
?>


	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<div class="container">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</div>
		</header>
	<?php endif; ?>

	<section class="animals animals-shelter">
		<div class="container">
			<div class="wrap">
				<?php if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();

						include(locate_template('parts/part-animal-card.php'));

					endwhile;
				endif; ?>
			</div>
		</div>
	</section>


<?php
get_template_part( 'parts/overall', 'footer' );
get_footer();
