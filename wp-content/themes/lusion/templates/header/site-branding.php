<div class="site-branding">
    <?php if (is_front_page()) : ?>
        <h1>
            <?php the_custom_logo(); ?>
        </h1>
    <?php else : ?>
        <?php the_custom_logo(); ?>
    <?php endif; ?>
    <?php if (!has_custom_logo()):?>
    <div class="site-branding-text ">
        <p class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               rel="home"><?php echo esc_html(get_bloginfo('name', 'display')) ?></a>
        </p>
        <?php
        $description = get_bloginfo('description', 'display');

        if ($description || is_customize_preview()) :
            ?>
            <p class="site-description"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
    </div><!-- .site-branding-text -->
    <?php endif;?>
</div><!-- .site-branding -->