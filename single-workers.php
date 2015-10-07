<?php
/*
Template for displaying single workers post
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h1><?php the_title(); ?></h1>
                <?php //вывод таксономии
                $taxo_text = "";
                $os_list = get_the_term_list($post->ID, 'position', '<strong>Position:</strong> ', ', ', '');
                if ('' != $os_list) {
                    $taxo_text .= "$os_list<br />\n";
                }
                if ('' != $taxo_text) {
                    echo $taxo_text;
                } // endif
                $taxo_text = "";
                $os_list = get_the_term_list($post->ID, 'project', '<strong>Project:</strong> ', ', ', '');
                if ('' != $os_list) {
                    $taxo_text .= "$os_list<br />\n";
                }
                if ('' != $taxo_text) {
                    echo $taxo_text;
                } // endif
                ?>
                <?php the_content(); ?>
                <p><b>Salary:</b> <?php echo(get_post_meta($post->ID, 'salary', true)); ?></p>

                <p><b>Employment:</b> <?php echo(get_post_meta($post->ID, 'employment', true)); ?></p>

                <p>This post was written by <b><?php the_author(); ?></b></p>
                </div>
            <?php endwhile; // end of the loop. ?>
        </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar('true_side'); ?>
<?php get_footer(); ?>