<?php
$photo = get_field('photo'); ?>

<div class="animal-card">
	<a href="<?php echo get_the_permalink(); ?>" class="cases-card-picture">
		<?php if ($photo['url']) : ?>
			<img src="<?php echo $photo['url']; ?>" alt="<?php echo get_the_title(); ?>" loading="lazy" class="img-fluid img-cover">
		<?php endif; ?>

		<?php
		$terms = wp_get_post_terms( get_the_ID(), 'types');
		?>
		<div class="card-title"><?php echo get_the_title(); ?></div>
	</a>
	<div class="card-subtitle"><?php echo $terms[0]->name; ?></div>
</div>