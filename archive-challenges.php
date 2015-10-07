<?php
/*
The template for displaying challenges archives
*/
?>

<?php get_header(); ?>



<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h1><?php the_title(); ?></h1>
                <?php echo get_the_post_thumbnail($page->ID, 'medium');?> <br>
                <b> <?php  the_time('F jS, Y G:i'); ?> </b>
            </div>
        <?php endwhile; // end of the loop. ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer();
?>
