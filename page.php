<?php
/*
* Default page
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

<?php
get_template_part( 'parts/overall', 'footer' );
get_footer();
