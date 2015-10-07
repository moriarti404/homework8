</div><!-- close .main-content-inner -->

<div class="sidebar col-sm-12 col-md-4">
    <div class="sidebar-padder">

        <?php do_action( 'before_sidebar' ); ?>
        <?php if ( is_active_sidebar( 'my_sidebar' ) ) : ?>
            <aside id="my-sidebar" class="sidebar">
                <?php dynamic_sidebar( 'my_sidebar' ); ?>
            </aside>
        <?php endif; ?>
    </div><!-- close .sidebar-padder -->