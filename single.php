<?php
/*
* Default single page
*/
get_header();
get_template_part( 'parts/overall', 'header' );

$terms = wp_get_post_terms( get_the_ID(), 'types');

$photo = get_field('photo');
$sex = get_field('sex');
$years = get_field('years');
$size = get_field('size');
$color = get_field('color');
$health = get_field('health');
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="single-wrap">
        <div class="container">

            <div class="entry-content">
				<div class="left">
					<?php if ($photo['url']) : ?>
						<img src="<?php echo $photo['url']; ?>" alt="<?php echo get_the_title(); ?>" loading="lazy" class="img-fluid img-cover">
					<?php endif; ?>
				</div>
				<div class="right">
					<h1><?php the_title(); ?></h1>

					<p><b>Тип: </b><?php echo $terms[0]->name; ?></p>
					<p><b>Стать: </b><?php echo $sex; ?></p>
					<p><b>Вік: </b><?php echo $years; ?></p>
					<p><b>Розмір: </b><?php echo $size; ?></p>
					<p><b>Забарвлення: </b><?php echo $color; ?></p>
					<p><b>Здоров’я: </b><?php echo $health; ?></p>
				</div>
            </div>

        </div>
    </div>
<?php endwhile; endif; ?>

<?php
get_template_part( 'parts/overall', 'footer' );
get_footer();
