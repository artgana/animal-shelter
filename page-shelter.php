<?php
/*
Template name: Притулок тварин
*/
get_header();
get_template_part( 'parts/overall', 'header' );
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="content page">
        <div class="container">

            <header class="entry-header">
                <h1><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </div>
    </div>
<?php endwhile; endif; ?>

<section class="animals animals-shelter">
	<div class="container">

		<div class="wrap">
			<?php
			$args = array(
				'post_type' => 'animals',
				'post_status' => 'publish',
				'no_found_rows' => true,
				'posts_per_page' => -1,
				'orderby' => 'rand',
			);

			$query = new WP_Query($args);
			while ($query->have_posts()) : $query->the_post();

				include(locate_template('parts/part-animal-card.php'));

			endwhile;
			wp_reset_query(); ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'parts/overall', 'footer' );
get_footer();
