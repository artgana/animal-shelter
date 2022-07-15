<?php
/*
Template name: Головна сторінка
*/
get_header();
get_template_part('parts/overall', 'header');

$text = get_field('text');
$activities = get_field('activities');
$animals = get_field('animals');
?>

<?php if($text) : ?>
<section class="text">
	<div class="container">
		<?php echo process_text_tags($text); ?>
	</div>
</section>
<?php endif; ?>

<?php if(isset($activities[0])) : ?>
<section class="activities">
	<div class="container">
		<?php foreach ($activities as $item) : ?>
			<div class="item">
				<?php if($item['photo']) : ?>
				<div class="img-wrap">
					<?php echo svg_or_img($item['photo']); ?>
				</div>
				<?php endif; if($item['title']) : ?>
					<b><?php echo $item['title']; ?></b>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>

<section class="animals">
	<div class="container">
		<h3><?php echo process_text_tags($animals['title']); ?></h3>

		<div class="wrap">
			<?php
			$args = array(
				'post_type' => 'animals',
				'post_status' => 'publish',
				'no_found_rows' => true,
				'posts_per_page' => -1,
				'orderby' => 'rand',
				'tax_query' => array(
					array (
						'taxonomy' => 'types',
						'field' => 'term_id',
						'terms' => $animals['category']
					)
				),
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
get_template_part('parts/overall', 'footer');
get_footer();
