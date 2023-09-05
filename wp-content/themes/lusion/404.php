<?php
get_header();
$title = Lusion::setting('error_title');
$error404_content = Lusion::setting('error404_content');
$overlay_enable = Lusion::setting('overlay_enable');
$go_back_home_404 = Lusion::setting('go_back_home_404');
$text404 = Lusion::setting('text_404');
?>
    <div class="page-404 error-page <?php if ($overlay_enable == 1) echo 'overlay404'; if ( is_admin_bar_showing() ){ echo 'admin-bar';}?>">
        <div class="page-container-404 container">
            <div class="page-content-404">
                <div class="heading-404">
                    <div class="content-404">
                        <?php if (!empty($text404)) { ?>
                            <h1 class="text-404"><?php echo esc_html($text404); ?></h1>
                        <?php } ?>
                        <?php if (!empty($title)) { ?>
                            <h3 class="page-title"><?php echo esc_html($title); ?></h3>
                        <?php } ?>
                        <?php if (!empty($error404_content)) { ?>
                            <p><?php echo esc_html($error404_content); ?></p>
                        <?php } ?>
                        <div class="btn-go-home">
                            <a class="go-home" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php echo esc_html($go_back_home_404); ?></a>
                        </div>
                    </div><!-- .content-404 -->
                </div>
            </div>
        </div>
    </div>
<?php get_footer();