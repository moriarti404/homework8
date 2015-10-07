<?php
/*
Template for displaying single challenges post
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <?php echo get_the_post_thumbnail($page->ID, 'full');?> <br>
                <h1><?php the_title(); ?></h1>
                <b> <?php  the_time('F jS, Y G:i'); ?> </b>
                <p>This post was written by <b><?php the_author(); ?></b></p>
                <?php the_content(); ?>
            </div>
        <?php endwhile; // end of the loop. ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar('true_side'); ?>
<?php get_footer();
?>
