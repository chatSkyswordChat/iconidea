<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom template tags for this theme.
 */
class Lusion_Templates
{
    public static function popup_newsletter()
    {
        $setting_popup_newsletter = Lusion::setting('popup_newsletter_show');
        $newsletter_title = Lusion::setting('popup_newsletter_title');
        $newsletter_desc = Lusion::setting('popup_newsletter_description');
        $newsletter_note = Lusion::setting('popup_newsletter_note');
        if ($setting_popup_newsletter):
            ?>
            <div id="list-builder"></div>
            <div class="popup-newsletter">
                <div class="popup-title-form">
                    <?php echo esc_html__('Sign up newsletter', 'lusion'); ?>
                </div>
                <div class="popup-newsletter-content">
                    <div class="form-content">
                        <?php if ((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id')): ?>
                            <h4><?php echo esc_html__('Sign up our newsletter and save 25% off for the next purchase!', 'lusion'); ?></h4>
                        <?php elseif (isset($newsletter_title) && $newsletter_title != ''): ?>
                            <h4><?php echo esc_html($newsletter_title); ?></h4>
                        <?php endif; ?>
                        <?php if ((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id')): ?>
                            <p><?php echo esc_html__('Subscribe to our newsletters and don&rsquot; miss new arrivals, the latest fashion updates and our promotions.', 'lusion'); ?></p>
                        <?php elseif (isset($newsletter_desc) && $newsletter_desc != ''): ?>
                            <p><?php echo esc_html($newsletter_desc); ?></p>
                        <?php endif; ?>
                        <?php dynamic_sidebar('popup_newsletter'); ?>
                        <?php if ((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id')): ?>
                            <span class="note"><?php echo esc_html__('Your Information will never be shared with any third party.', 'lusion'); ?></span>
                        <?php elseif (isset($newsletter_note) && $newsletter_note != ''): ?>
                            <span class="note"><?php echo esc_html($newsletter_note); ?></span>
                        <?php endif; ?>
                        <div class="checkbox-form">
                            <label for="not_show_popup_again"
                                   class="checkcontainer"><?php echo esc_html__("Don't show this popup again", 'lusion'); ?>
                                <input type="checkbox" name="show" id="not_show_popup_again"/>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <a href="#" class="close-popup"><i class="theme-icon-close"></i></a>
            </div>
        <?php
        endif;
    }

    public static function popup_account($arg = array())
    {
        $setting_popup_account = lusion::setting('popup_account_show');
        ?>
        <?php
        if (class_exists('WooCommerce') && !is_user_logged_in()) {
            if (isset($setting_popup_account) && $setting_popup_account && !is_account_page()): ?>
                <div id="popup-account" class="popup-account">
                    <div class="popup-account-content">
                        <div class="tab-content">
                            <?php do_action('woocommerce_before_customer_login_form'); ?>
                            <div class="tab-pane fade show active lusion-login" id="login-show">
                                <form id="login" class="woocommerce-form woocommerce-form-login login" name="loginshow"
                                      method="post">
                                    <div class="popup-title">
                                        <?php echo esc_html__('Login', 'lusion'); ?>
                                    </div>
                                    <?php do_action('woocommerce_login_form_start'); ?>
                                    <div class="status "></div>
                                    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <input type="text"
                                               class="woocommerce-Input woocommerce-Input--text input-text required"
                                               name="username" id="username"
                                               placeholder="<?php esc_attr_e('Username or email address*', 'lusion'); ?>"
                                               aria-required="true" autocomplete="username"
                                               value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/>
                                    </p>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <input class="woocommerce-Input woocommerce-Input--text input-text required"
                                               type="password" name="password" id="password"
                                               placeholder="<?php esc_attr_e('Password*', 'lusion'); ?>"
                                               aria-required="true" autocomplete="current-password"/>
                                    </p>
                                     <p class="checkbox-form">
                                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme checkcontainer"><?php esc_html_e('Remember me', 'lusion'); ?>
                                            <input name="rememberme" type="checkbox" id="rememberme" value="forever"/>
                                            <span class="checkmark"></span>
                                        </label>
                                    </p>
                                    <p class="woocommerce-LostPassword lost_password">
                                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgot your password?', 'lusion'); ?></a>
                                    </p>
                                    <p class="sm-login button-register">
                                        <button type="submit"
                                                class="woocommerce-button button woocommerce-form-login__submit"
                                                name="login"
                                                value="<?php esc_attr_e('Login', 'lusion'); ?>"><?php esc_html_e('Log in', 'lusion'); ?>
                                        </button>
                                    </p>
                                    <?php do_action('woocommerce_login_form'); ?>
                                    <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

                                    <?php do_action('woocommerce_login_form_end'); ?>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="register-show">
                                <form method="post" class="woocommerce-form woocommerce-form-register register"
                                      id="register" <?php do_action('woocommerce_register_form_tag'); ?> >
                                    <div class="popup-title">
                                        <?php echo esc_html__('Register', 'lusion'); ?>
                                    </div>
                                    <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
                                    <?php do_action('woocommerce_register_form_start'); ?>
                                        <div class="status"></div>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-user">
                                            <input type="text"
                                                   class="woocommerce-Input woocommerce-Input--text input-text required"
                                                   placeholder="<?php esc_attr_e('User name*', 'lusion'); ?>"
                                                   name="username" id="reg_username" autocomplete="username"
                                                   value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/>
                                        </p>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-email">
                                        <input type="email"
                                               class="woocommerce-Input woocommerce-Input--text input-text required"
                                               name="email" id="reg_email" autocomplete="email"
                                               placeholder="<?php esc_attr_e('Email*', 'lusion'); ?>"
                                               value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"/>
                                    </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-row-pass">
                                            <input type="password"
                                                   class="woocommerce-Input woocommerce-Input--text input-text required"
                                                   placeholder="<?php esc_attr_e('Password*', 'lusion'); ?>"
                                                   name="password" id="reg_password" autocomplete="new-password"/>
                                        </p>
                                    <?php do_action('woocommerce_register_form'); ?>
                                    <div class="woocommerce-FormRow">
                                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                                        <button type="submit" class="woocommerce-Button button"
                                                value="<?php esc_attr_e('Register', 'lusion'); ?>"><?php esc_html_e('Register', 'lusion'); ?></button>
                                    </div>
                                    <?php do_action('woocommerce_register_form_end'); ?>
                                    <?php if( class_exists( 'YITH_WC_Social_Login' )){
                                         echo do_shortcode('[yith_wc_social_login]');
                                    }?>
                                    <a href="#" class="close-popup"><i class="theme-icon-close"></i></a>
                                </form>
                            </div>
                            <?php do_action('woocommerce_after_customer_login_form'); ?>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#login-show">
                                    <?php echo esc_html__('Login', 'lusion'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#register-show">
                                    <?php echo esc_html__('Register', 'lusion'); ?>
                                </a>
                            </li>
                        </ul>
                         <a href="#" class="close-popup"><i class="theme-icon-close"></i></a>
                    </div>
                </div>
            <?php endif;
        } ?>
        <?php
    }

	public static function recommended_products()
    {
        $setting_popup_sale = Lusion::setting('popup_sale_show');
		$popup_content = Lusion::setting('popup_sale_content');
		$recommend_popup_disabled_page = get_post_meta(get_the_ID(), 'recommend_popup_disabled_page', true);
		if($recommend_popup_disabled_page == 1 ){
			$setting_popup_sale = '';
		}else{
			$setting_popup_sale = Lusion::setting('popup_sale_show');
		}
        if ($setting_popup_sale && $popup_content):
            ?>
            <div class="popup-sale-wapper">
				<div class="popup-sale">
					<?php echo \Elementor\Plugin::$instance->frontend->get_builder_content($popup_content, true); ?>
					<a href="#" class="close-popup"><i class="theme-icon-close"></i></a>
				</div>
				<div class="close-box"></div>
            </div>
        <?php
        endif;
    }
	public static function sale_popup()
    {
        $setting_sale_popup = Lusion::setting('sale_popup_show');
		$sale_popup_content = Lusion::setting('sale_popup_content');
		$sale_popup_disabled_page = get_post_meta(get_the_ID(), 'sale_popup_disabled_page', true);
		if($sale_popup_disabled_page == 1 ){
			$setting_sale_popup = '';
		}else{
			$setting_sale_popup = Lusion::setting('sale_popup_content');
		}
        if ( (isset($setting_sale_popup) && $setting_sale_popup !== '') && (isset($sale_popup_content) && $sale_popup_content)):
            ?>
            <div class="sale-popup" style="position: fixed;bottom: 0;z-index: 11;">
				<?php echo \Elementor\Plugin::$instance->frontend->get_builder_content($sale_popup_content, true); ?>
			</div>
        <?php
        endif;
    }

    public static function get_related_posts($args)
    {
        $defaults = array(
            'post_id' => '',
            'number_posts' => 3,
        );
        $args = wp_parse_args($args, $defaults);
        if ($args['number_posts'] <= 0 || $args['post_id'] === '') {
            return false;
        }

        $categories = get_the_category($args['post_id']);

        if (!$categories) {
            return false;
        }

        foreach ($categories as $category) {
            if ($category->parent === 0) {
                $term_ids[] = $category->term_id;
            } else {
                $term_ids[] = $category->parent;
                $term_ids[] = $category->term_id;
            }
        }

        // Remove duplicate values from the array.
        $unique_array = array_unique($term_ids);

        $query_args = array(
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $args['number_posts'],
            'post__not_in' => array($args['post_id']),
            'no_found_rows' => true, // Skip pagination, makes the query faster.
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'terms' => $unique_array,
                    'include_children' => false,
                ),
            ),
        );

        $query = new WP_Query($query_args);

        return $query;
    }

    Public static function get_logo_sticky()
    {
        $show_sticky = Lusion::setting('header_sticky_enable');
        $logo__sticky = get_post_meta(get_the_ID(), 'logo_header_sticky', true);
        if ($logo__sticky) {
            $logo = $logo__sticky;
        } else {
            $logo = Lusion::setting('header_sticky_logo');
        }
        if ($show_sticky): ?>
            <h2 class="logo d-flex align-items-center">
                <a class="logo-sticky" href="<?php echo esc_url(home_url('/')); ?>"><img
                            src="<?php echo esc_url($logo); ?>"
                            alt="<?php echo esc_attr(get_bloginfo('name', 'display')) ?>"></a>
            </h2>
        <?php endif;
    }

    public static function get_search_box()
    {
        ?>
        <div class="search-box">
            <div class="search-box__header-container">
                <div class="container">
                    <div class="search-box__header row">
                        <div class="search-box__title col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-10">
                        </div>
                        <div class="search-box__close col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-2 text-right">
                            <span class="close-search-box"><i class="theme-icon-close"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--./search-box_header-container-->
            <div class="search-box__content">
                <div class="container">
                    <?php self::header_search(); ?>
                </div>
            </div>
        </div>
        <?php
    }

    public static function mobile_menu()
    {
        ?>
        <nav class="apr-nav-menu--main apr-nav-menu--layout-dropdown">
            <?php
            Lusion::menu_primary();
            ?>
        </nav>
        <?php
    }

    public static function footer($footer_type = '')
    {
        $footer_type = Lusion_Global::instance()->set_footer_type();
        get_template_part('footers/footer', $footer_type);
    }

    public static function footer_logo()
    {
        $logo_url = '';
        $logo_footer_url = Lusion::setting('logo_footer');
        ?>
        <div class="footer-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php if ($logo_footer_url !== '') { ?>
                    <img src="<?php echo esc_url($logo_footer_url); ?>"
                         alt="<?php esc_attr(bloginfo('name')); ?>" class="footer-logo">
                <?php } ?>
            </a>
        </div>
        <?php
    }

    public static function get_product_single_style()
    {
        $single_layout = get_post_meta(get_the_id(), 'meta_single_style', true);
        if ($single_layout && $single_layout !== 'default') {
            $single_type = $single_layout;
        } elseif (Lusion::setting('single_style')) {
            $single_type = Lusion::setting('single_style');
        } else {
            $single_type = 'single_1';
        }
        return $single_type;
    }

    public static function paging_nav($query = false)
    {
        global $wp_query, $wp_rewrite;
        if ($query === false) {
            $query = $wp_query;
        }

// Don't print empty markup if there's only one page.
        if ($query->max_num_pages < 2) {
            return;
        }

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $page_num_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $page_num_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $page_num_link = esc_url(remove_query_arg(array_keys($query_args), $page_num_link));
        $page_num_link = trailingslashit($page_num_link) . '%_%';

        $format = '';
        if ($wp_rewrite->using_index_permalinks() && !strpos($page_num_link, 'index.php')) {
            $format = 'index.php/';
        }
        if ($wp_rewrite->using_permalinks()) {
            $format .= user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged');
        } else {
            $format .= '?paged=%#%';
        }

// Set up paginated links.

        $args = array(
            'base' => $page_num_link,
            'format' => $format,
            'total' => $query->max_num_pages,
            'current' => max(1, $paged),
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $query_args),
            'prev_text' => '<span class="theme-icon-back"></span>',
            'next_text' => '<span class="theme-icon-next"></span>',
            'type' => 'array',
        );
        $pages = paginate_links($args);

        if (is_array($pages)) {
            echo '<div class="pagination-number">';
            foreach ($pages as $page) {
                printf($page);
            }
            echo '</div>';
        }
    }

    public static function paging_nav_shop($query = false)
    {
        $links = paginate_links(array(
            'prev_next' => false,
            'type' => 'array'
        ));

        if ($links) :
            echo '<nav class="woocommerce-pagination">';
            echo '<ul class="page-numbers">';

            // get_previous_posts_link will return a string or void if no link is set.
            if ($prev_posts_link = get_previous_posts_link(__('Previous', 'lusion'))) :
                echo '<li class="prev-list-item">';
                echo esc_attr($prev_posts_link);
                echo '</li>';
            endif;
            // get_next_posts_link will return a string or void if no link is set.
            if ($next_posts_link = get_next_posts_link(__('Next', 'lusion'))) :
                echo '<li class="next-list-item">';
                echo esc_attr($next_posts_link);
                echo '</li>';
            endif;
            echo '<li>';
            echo join('</li><li>', $links);
            echo '</li>';
            echo '</ul>';
            echo '</nav>';
        endif;
    }

    public static function page_links()
    {
        wp_link_pages(array(
            'before' => '<div class="page-links">',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'nextpagelink' => esc_html__('Next', 'lusion'),
            'previouspagelink' => esc_html__('Prev', 'lusion'),
        ));
    }

    public static function post_nav_links()
    {
        $args = array(
            'prev_text' => '%title',
            'next_text' => '%title',
            'in_same_term' => false,
            'excluded_terms' => '',
            'taxonomy' => 'category',
            'screen_reader_text' => esc_html__('Post navigation', 'lusion'),
        );

        $previous = get_previous_post_link('<div class="nav-previous">%link</div>', $args['prev_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy']);

        $next = get_next_post_link('<div class="nav-next">%link</div>', $args['next_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy']);

// Only add markup if there's somewhere to navigate to.
        if ($previous || $next) { ?>

            <nav class="navigation post-navigation" role="navigation">

                <?php $return_link = Lusion::setting('single_post_pagination_return_link'); ?>
                <?php if ($return_link !== '') : ?>
                    <a href="<?php echo esc_url($return_link); ?>" class="return-blog-page"><span
                                class="ion-grid"></span></a>
                <?php endif; ?>

                <?php echo '<h2 class="screen-reader-text">' . $args['screen_reader_text'] . '</h2>'; ?>

                <div class="nav-links">
                    <?php echo '<div class="previous nav-item">' . $previous . '</div>'; ?>
                    <?php echo '<div class="next nav-item">' . $next . '</div>'; ?>
                </div>
            </nav>
            <?php
        }
    }

    public static function comment_navigation($args = array())
    {
// Are there comments to navigate through?
        if (get_comment_pages_count() > 1 && get_option('page_comments')) {
            $defaults = array(
                'container_id' => '',
                'container_class' => 'navigation comment-navigation',
            );
            $args = wp_parse_args($args, $defaults);
            ?>
            <nav id="<?php echo esc_attr($args['container_id']); ?>"
                 class="<?php echo esc_attr($args['container_class']); ?>">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'lusion'); ?></h2>

                <div class="comment-nav-links">
                    <?php paginate_comments_links(array(
                        'prev_text' => esc_html__('Prev', 'lusion'),
                        'next_text' => esc_html__('Next', 'lusion'),
                    )); ?>
                </div>
            </nav>
            <?php
        }
        ?>
        <?php
    }

    public static function comment_template($comment, $args, $depth)
    {

        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment-item" id="comment-<?php comment_ID(); ?>">
            <div class="comment-content">
                <div class="box-info-comment">
                    <div class="post-author-box">
                        <div class="img-author">
                            <?php echo get_avatar($comment); ?>
                        </div>
                        <div class="info-author">
                            <?php printf('<span class="name-author">%s</span>', get_comment_author_link()); ?>
                            <span class="cmt-date"><?php echo get_comment_date(); ?></span>
                        </div>
                    </div>
                    <div class="comment-actions">
                        <div class="comment-reply">
                            <?php comment_reply_link(array_merge($args, array(
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'reply_text' => esc_html__('Reply', 'lusion'),
                            ))); ?>
                            <?php edit_comment_link(esc_html__('Edit', 'lusion')); ?>
                        </div>
                    </div>
                </div>
                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-messages"><?php esc_html_e('Your comment is awaiting moderation.', 'lusion') ?></em>
                <br/>
            <?php endif; ?>
        </div>
        <?php
    }

    public static function comment_form()
    {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $comment_login = '';
        if (is_user_logged_in()) {
            $comment_login = "comment-field-login";
        }

        $comment_args = array(
            'class_form' => 'commentform ',
            'fields' => apply_filters('comment_form_default_fields', array(
                'author' => '<div class="comment-field fields row">
                <div class="col-md-6 col-sm-12 col-xs-12 inner-info comment-form-author ">' . '<input placeholder="' . esc_attr__('Name ', 'lusion') . '" id="author" class="required" name="author" type="text" value="' .
                    esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />' .
                    '</div>',
                'email' => '<div class="col-md-6 col-sm-12 col-xs-12 inner-info comment-form-email ">' . '<input placeholder="' . esc_attr__('Email', 'lusion') . '" id="email" class="required email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />' .
                    '</div>',
                '</div>',
                'url' => '')),
            'comment_field' => '<div class=" comment-textarea"><div class="comment-right-field ' . $comment_login . ' ">' .
                '<textarea id="comment" class="required" name="comment" cols="45" rows="4" aria-required="true" placeholder="' . esc_attr__('Comment', 'lusion') . '"></textarea>' .
                '</div></div>',
            'title_reply' => esc_html__('Write a comment', 'lusion'),
            'cancel_reply_link' => esc_html__('Cancel reply', 'lusion'),

            'logged_in_as' => '',
            'comment_notes_before' => '',
            'class_submit' => 'btn btn-highlight',
            'label_submit' => esc_html__('Submit', 'lusion'),
            'comment_notes_after' => '',
        );

        comment_form($comment_args);
    }

    public static function post_author()
    {
        ?>
        <div class="entry-author">
            <div class="author-info">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('email'), '90'); ?>
                </div>
                <div class="author-description">
                    <h5 class="author-name"><?php the_author(); ?></h5>
                    <div class="author-biographical-info">
                        <?php the_author_meta('description'); ?>
                    </div>
                </div>
            </div>
            <?php
            $email_address = get_the_author_meta('email_address');
            $facebook = get_the_author_meta('facebook');
            $twitter = get_the_author_meta('twitter');
            $google_plus = get_the_author_meta('google_plus');
            $instagram = get_the_author_meta('instagram');
            $linkedin = get_the_author_meta('linkedin');
            $pinterest = get_the_author_meta('pinterest');
            ?>
            <?php if ($facebook || $twitter || $google_plus || $instagram || $linkedin || $email_address) : ?>
                <div class="author-social-networks">
                    <?php if ($email_address) : ?>
                        <a class="hint--bounce hint--top"
                           aria-label="<?php echo esc_attr__('Email', 'lusion') ?>"
                           href="mailto:<?php echo esc_url($email_address); ?>" target="_blank">
                            <i class="ion-email"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($facebook) : ?>
                        <a class="hint--bounce hint--top"
                           aria-label="<?php echo esc_attr__('Facebook', 'lusion') ?>"
                           href="<?php echo esc_url($facebook); ?>" target="_blank">
                            <i class="ion-social-facebook"></i>
                        </a>
                    <?php endif; ?>
                    <?php if ($twitter) : ?>
                        <a class="hint--bounce hint--top"
                           aria-label="<?php echo esc_attr__('Twitter', 'lusion') ?>"
                           href="<?php echo esc_url($twitter); ?>" target="_blank">
                            <i class="ion-social-twitter"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($google_plus) : ?>
                        <a class="hint--bounce hint--top"
                           aria-label="<?php echo esc_attr__('Google +', 'lusion') ?>"
                           href="<?php echo esc_url($google_plus); ?>" target="_blank">
                            <i class="ion-social-googleplus"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($instagram) : ?>
                        <a class="hint--bounce hint--top"
                           aria-label="<?php echo esc_attr__('Instagram', 'lusion') ?>"
                           href="<?php echo esc_url($google_plus); ?>" target="_blank">
                            <i class="ion-social-instagram-outline"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($linkedin) : ?>
                        <a class="hint--bounce hint--top"
                           aria-label="<?php echo esc_attr__('Linkedin', 'lusion') ?>"
                           href="<?php echo esc_url($linkedin); ?>" target="_blank">
                            <i class="ion-social-linkedin"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($pinterest) : ?>
                        <a class="hint--bounce hint--top"
                           aria-label="<?php echo esc_attr__('Pinterest', 'lusion') ?>"
                           href="<?php echo esc_url($pinterest); ?>" target="_blank">
                            <i class="ion-social-pinterest"></i>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    public static function post_sharing($args = array())
    {
        $social_sharing = Lusion::setting('single_post_item_enable');
        if (!empty($social_sharing)) {
            ?>
            <div class="post-share">
                <div class="post-share-toggle">
                    <h3><?php echo esc_html__('Share: ', 'lusion') ?></h3>
                    <div class="post-share-list">
                        <?php self::get_sharing_list($args); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    public static function product_sharing($args = array())
    {
        ?>
        <div class="product-share meta-item">
            <h6><?php echo esc_html__('Share on: ', 'lusion') ?></h6>
            <div class="product-sharing-list"><?php self::get_sharing_list($args); ?></div>
        </div>
        <?php
    }
    public static function portfolio_sharing($args = array())
    {
        ?>
            <div class="portfolio-share portfolio-sharing-list"><?php self::get_sharing_list_portfolio($args); ?></div>
        <?php
    }
     public static function blog_sharing($args = array())
    {
        ?>
            <div class="blog-sharing-list"><?php self::get_sharing_list_blog($args); ?></div>
        <?php
    }
    public static function get_sharing_list($args = array())
    {
        $defaults = array(
            'target' => '_blank',
        );
        $args = wp_parse_args($args, $defaults);
        $social_sharing = Lusion::setting('single_post_item_enable');
        if (!empty($social_sharing)) {
            foreach ($social_sharing as $social) {
                if ($social === 'facebook') {
                    $facebook_url = '//m.facebook.com/sharer.php?u=' . urlencode(get_permalink());
                    ?>
                    <a class="facebook" target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Facebook', 'lusion') ?>"
                       href="<?php echo esc_url($facebook_url); ?>">
                        <i class="theme-icon-facebook"></i>
                    </a>
                    <?php
                } elseif ($social === 'twitter') {
                    ?>
                    <a class="twitter" target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Twitter', 'lusion') ?>"
                       href="//twitter.com/share?text=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&url=<?php echo rawurlencode(get_permalink()); ?>">
                        <i class="theme-icon-twitter"></i>
                    </a>
                    <?php
                } elseif ($social === 'pinterest') {
                    $pinterest_url = '//www.pinterest.com/pin/create/button/?url=' . rawurlencode(get_permalink()) . '&media=' . wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) . '&description=' . rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                    ?>
                    <a class="pinterest"
                       target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Pinterest', 'lusion') ?>"
                       href="<?php echo esc_url($pinterest_url); ?>">
                        <i class="theme-icon-pinterest"></i>
                    </a>
                    <?php
                } elseif ($social === 'whatsapp') {
                    ?>
                    <a class="whatsapp"
                       target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Whatsapp', 'lusion') ?>"
                       href="//wa.me/?text=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>"
                       data-action="share/whatsapp/share">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <?php
                }
            }
        }
    }
    public static function get_sharing_list_blog($args = array())
    {
        $defaults = array(
            'target' => '_blank',
        );
        $args = wp_parse_args($args, $defaults);
        $blog_archive_share_enable = Lusion::setting('blog_archive_item_enable');
        if (!empty($blog_archive_share_enable)) {
            foreach ($blog_archive_share_enable as $social) {
                if ($social === 'facebook') {
                    $facebook_url = '//m.facebook.com/sharer.php?u=' . urlencode(get_permalink());
                    ?>
                    <a class="facebook" target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Facebook', 'lusion') ?>"
                       href="<?php echo esc_url($facebook_url); ?>">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <?php
                } elseif ($social === 'twitter') {
                    ?>
                    <a class="twitter" target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Twitter', 'lusion') ?>"
                       href="//twitter.com/share?text=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&url=<?php echo rawurlencode(get_permalink()); ?>">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <?php
                } elseif ($social === 'pinterest') {
                    $pinterest_url = '//www.pinterest.com/pin/create/button/?url=' . rawurlencode(get_permalink()) . '&media=' . wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) . '&description=' . rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                    ?>
                    <a class="pinterest"
                       target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Pinterest', 'lusion') ?>"
                       href="<?php echo esc_url($pinterest_url); ?>">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    <?php
                }elseif ($social === 'gmail') {
                    ?>
                    <a class="gmail"
                       target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Gmail', 'lusion') ?>"
                       href="//mail.google.com/mail/u/0/?view=cm&fs=1&to&su=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&body=<?php echo rawurlencode(get_permalink()); ?>">
                        <i class="theme-icon-gmail"></i>
                    </a>
                    <?php
                }
            }
        }
    }
    public static function get_sharing_list_portfolio($args = array())
    {
        $defaults = array(
            'target' => '_blank',
        );
        $args = wp_parse_args($args, $defaults);
        $portfolio_single_item_enable = Lusion::setting('portfolio_single_item_enable');
        if (!empty($portfolio_single_item_enable)) {
            foreach ($portfolio_single_item_enable as $social) {
                if ($social === 'facebook') {
                    $facebook_url = '//m.facebook.com/sharer.php?u=' . urlencode(get_permalink());
                    ?>
                    <a class="facebook" target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Facebook', 'lusion') ?>"
                       href="<?php echo esc_url($facebook_url); ?>">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <?php
                } elseif ($social === 'twitter') {
                    ?>
                    <a class="twitter" target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Twitter', 'lusion') ?>"
                       href="//twitter.com/share?text=<?php echo rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&url=<?php echo rawurlencode(get_permalink()); ?>">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <?php
                } elseif ($social === 'pinterest') {
                    $pinterest_url = '//www.pinterest.com/pin/create/button/?url=' . rawurlencode(get_permalink()) . '&media=' . wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) . '&description=' . rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                    ?>
                    <a class="pinterest"
                       target="<?php echo esc_attr($args['target']); ?>"
                       aria-label="<?php echo esc_attr__('Pinterest', 'lusion') ?>"
                       href="<?php echo esc_url($pinterest_url); ?>">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    <?php
                }
            }
        }
    }

    public static function header_search($arg = array())
    {
        $lusion_search_template = lusion_get_search_form();
        echo '<div class="search-block-top">' . wp_kses($lusion_search_template, lusion_allow_html()) . '</div>';
    }

    public static function searchbox_mobile()
    {
        ?>
        <div class="search-mobile">
            <form role="search" method="get" class="mobile-search-form" action="<?php echo esc_url(home_url()); ?>">
                <div class="search-content-mobile">
                    <input autocomplete="off" class="search-mobile-ajax" type="search" name="s"
                           placeholder="<?php echo esc_attr__('Search', 'lusion'); ?>">
                    <button type="submit" class="submit btn-search"><i class="fa fa-search"></i></button>
                    <input type="hidden" name="post_type" value="product">
                </div>
            </form>
            <div class="search-results-wrapper"></div>
        </div>
        <?php
    }

    public static function get_minicart_template($arg = array())
    {
        if (class_exists('lusion')) {
            if (class_exists('WooCommerce')) {
                $cart_item_count = WC()->cart->cart_contents_count;
                $cart_item_qty = WC()->cart->get_cart_total();
                ?>
                <div class="header-cart">
                    <?php if (is_cart() || is_checkout()): ?>
                        <a href="<?php echo wc_get_cart_url(); ?>" title="button-shopping">
                            <span class="theme-icon-shopping-cart1"></span>
                            <span class="count d-inline-block text-center">
                        <?php echo is_object(WC()->cart) ? WC()->cart->get_cart_contents_count() : ''; ?>
                    </span>
                        </a>
                    <?php else: ?>
                        <a class="shopping-cart-button" href="#" title="button-shopping">
                            <span class="theme-icon-shopping-cart1"></span>
                            <span class="count d-inline-block text-center">
                        <?php echo is_object(WC()->cart) ? WC()->cart->get_cart_contents_count() : ''; ?>
                    </span>
                        </a>
                    <?php endif; ?>
                </div>
                <?php
            }
        }
    }

    public static function get_setting_template($arg = array())
    {
        if (lusion_is_woocommerce_activated()) {
            $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
            $logout_url = wp_logout_url(get_permalink($account_link));
        } else {
            $account_link = wp_login_url();
        }
        if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
            $logout_url = str_replace('http:', 'https:', $logout_url);
        }

        $lusion_myaccount_page_id = get_option('woocommerce_myaccount_page_id');
        ?>
        <div class="header-account">
            <?php if (!is_user_logged_in()): ?>
            <?php if (wp_is_mobile()): ?>
            <a href="#" class="icon-login">
                <?php elseif (class_exists('WooCommerce')) : ?>
                <a href="<?php echo esc_url(get_permalink($lusion_myaccount_page_id)); ?>">
                    <?php else : ?>
                    <a href="#popup-account" class="icon-login" data-fancybox>
                        <?php endif; ?>
                        <i class="theme-icon-user2"></i>
                    </a>
                    <?php else: ?>
                        <a href="<?php echo esc_url($account_link) ?>">
                            <i class="theme-icon-user2"></i>
                        </a>
                    <?php endif; ?>
        </div>
        <?php
    }


    public static function string_limit_words($string, $word_limit)
    {
        $words = explode(' ', $string, $word_limit + 1);
        if (count($words) > $word_limit) {
            array_pop($words);
        }

        return implode(' ', $words);
    }

    public static function string_limit_characters($string, $limit)
    {
        $string = substr($string, 0, $limit);
        $string = substr($string, 0, strripos($string, " "));

        return $string;
    }

    public static function excerpt($args = array())
    {
        $defaults = array(
            'limit' => 10,
            'after' => '&hellip;',
            'type' => 'word',
        );
        $args = wp_parse_args($args, $defaults);

        $excerpt = '';

        if ($args['type'] === 'word') {
            $excerpt = self::string_limit_words(get_the_excerpt(), $args['limit']);
        } elseif ($args['type'] === 'character') {
            $excerpt = self::string_limit_characters(get_the_excerpt(), $args['limit']);
        }
        if ($excerpt !== '' && $excerpt !== '&nbsp;') {
            printf('<p>%s %s</p>', $excerpt, $args['after']);
        }
    }

    public static function grid_filters($post_type = 'post', $filter_enable = '', $filter_align = '', $filter_counter = '', $filter_wrap = '0')
    {
        if ($filter_enable == 1) :

            $_catPrefix = '';
            $_categories = array();

            switch ($post_type) {
                case 'portfolio' :
                    $_categories = get_terms(array(
                        'taxonomy' => 'portfolio_cat',
                        'hide_empty' => true,
                    ));
                    $_catPrefix = '.portfolio_cat-';
                    break;
                case 'product' :
                    $_categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                    ));

                    $_catPrefix = '.product_cat-';
                    break;
                default :
                    $_categories = get_terms(array(
                        'taxonomy' => 'category',
                        'hide_empty' => true,
                    ));

                    $_catPrefix = '.category-';
                    break;
            }

            $filter_classes = array('tm-filter-button-group', $filter_align);
            if ($filter_counter == 1) {
                $filter_classes[] = 'show-filter-counter';
            }
            ?>

            <div class="<?php echo implode(' ', $filter_classes); ?>"
                <?php
                if ($filter_counter == 1) {
                    echo 'data-filter-counter="true"';
                }
                ?>
            >
                <div class="tm-filter-button-group-inner">
                    <?php if ($filter_wrap == '1') { ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php } ?>
                                <a href="javascript:void(0);" class="btn-filter current"
                                   data-filter="*">
                                    <span class="filter-text"><?php esc_html_e('All', 'lusion'); ?></span>
                                </a>
                                <?php
                                foreach ($_categories as $term) {
                                    printf('<a href="javascript:void(0);" class="btn-filter" data-filter="%s"><span class="filter-text">%s</span></a>', esc_attr($_catPrefix . $term->slug), $term->name);
                                }
                                ?>
                                <?php if ($filter_wrap == '1') { ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        <?php
        endif;
    }

    public static function grid_pagination($lusion_query, $number, $pagination, $pagination_align, $pagination_button_text)
    {
        if ($pagination !== '' && $lusion_query->found_posts > $number) { ?>
            <div class="tm-grid-pagination" style="text-align:<?php echo esc_attr($pagination_align); ?>">
                <?php if ($pagination === 'loadmore_alt' || $pagination === 'loadmore' || $pagination === 'infinite') { ?>
                    <div class="tm-loader"></div>

                    <?php if ($pagination === 'loadmore') { ?>
                        <a href="#" class="tm-button style-outline tm-button-grey tm-grid-loadmore-btn">
                            <span><?php echo esc_html($pagination_button_text); ?></span>
                        </a>
                    <?php } ?>
                <?php } elseif ($pagination === 'pagination') { ?>
                    <?php Lusion_Templates::paging_nav($lusion_query); ?>
                <?php } ?>
            </div>
            <div class="tm-grid-messages" style="display: none;">
                <?php esc_html_e('All items displayed.', 'lusion'); ?>
            </div>
            <?php
        }
    }

    /**
     * Echo rating html template.
     *
     * @param int $rating
     */
    public static function get_rating_template($rating = 5)
    {
        $full_stars = intval($rating);
        $template = '';

        $template .= str_repeat('<i class="fa fa-star"></i>', $full_stars);

        $half_star = floatval($rating) - $full_stars;

        if ($half_star != 0) {
            $template .= '<i class="fa fa-star-half-alt"></i>';
        }

        $empty_stars = intval(5 - $rating);
        $template .= str_repeat('<i class="fa fa-star"></i>', $empty_stars);

        echo esc_attr($template);
    }


    public static function page_title()
    {

        global $post, $wp_query, $author;

        $home = esc_html__('Home', 'lusion');

        $shop_page_id = false;
        $front_page_shop = false;
        if (defined('WOOCOMMERCE_VERSION')) {
            $shop_page_id = wc_get_page_id('shop');
            $front_page_shop = get_option('page_on_front') == wc_get_page_id('shop');
        }

        if ((!is_home() && !is_front_page() && !(is_post_type_archive() && $front_page_shop)) || is_paged()) {

            if (is_home()) {

            } else if (is_category() && !is_tax('product_cat')) {

                echo single_cat_title('', false);

            } elseif (is_search()) {

                echo esc_html__('Search results for &ldquo;', 'lusion') . get_search_query() . '&rdquo;';

            } elseif (is_tax('product_cat') || is_tax('portfolio_cat') || is_tax('yith_product_brand')) {

                $queried_object = $wp_query->get_queried_object();
                echo esc_html($queried_object->name);

            } elseif (is_tax('product_tag')) {

                $queried_object = $wp_query->get_queried_object();
                echo esc_html__('Products tagged &ldquo;', 'lusion') . $queried_object->name . '&rdquo;';

            } elseif (is_day()) {

                printf(esc_html__('Daily Archives: %s', 'lusion'), get_the_date());

            } elseif (is_month()) {

                printf(esc_html__('Monthly Archives: %s', 'lusion'), get_the_date(_x('F Y', 'monthly archives date format', 'lusion')));

            } elseif (is_year()) {

                printf(esc_html__('Yearly Archives: %s', 'lusion'), get_the_date(_x('Y', 'yearly archives date format', 'lusion')));

            } elseif (is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id) {

                $_name = wc_get_page_id('shop') ? get_the_title(wc_get_page_id('shop')) : '';

                if (!$_name) {
                    $product_post_type = get_post_type_object('product');
                    $_name = $product_post_type->labels->singular_name;
                }

                if (is_search()) {
                    echo esc_html__('Search results for &ldquo;', 'lusion') . get_search_query() . '&rdquo;';
                } elseif (is_paged()) {

                } else {

                    echo esc_html($_name);

                }

            } elseif (is_post_type_archive('portfolio')) {

                echo esc_html(Lusion::setting('portfolio_title'));

            } elseif (is_post_type_archive()) {
                sprintf(esc_html__('Archives: %s', 'lusion'), post_type_archive_title('', false));
            } elseif (is_single() && !is_attachment()) {
                if ('post' == get_post_type()) {
                    echo get_the_title();
                } elseif ('portfolio' == get_post_type()) {
                    echo get_the_title();
                } elseif ('wpsl_stores' == get_post_type()) {
                    echo esc_html__('STORE LOCATOR', 'lusion');
                } else {
                    echo get_the_title();
                }
            } elseif (is_404()) {
                echo esc_html__('Error 404', 'lusion');
            } elseif (is_attachment()) {
                echo get_the_title();
            } elseif (is_page() && !$post->post_parent) {
                if (class_exists('WooCommerce')) {
                    if (is_edit_account_page()) {
                        echo esc_html__( 'Account Information', 'lusion' );
                    }elseif (is_account_page()) {

                        if (is_wc_endpoint_url( 'edit-address' )) {
                            echo esc_html__( 'Address Book', 'lusion' );
                        }elseif(is_wc_endpoint_url( 'view-order' )){
                            echo esc_html__( 'My Orders', 'lusion' );
                        }else{
                            echo esc_html__( 'My Account', 'lusion' );
                        }
                    }
                    else{
                        echo get_the_title();
                    }
                }else{
                    echo get_the_title();
                }
            } elseif (is_page() && $post->post_parent) {
                echo get_the_title();
            } elseif (is_search()) {
                echo esc_html__('Search results for &ldquo;', 'lusion') . get_search_query() . '&rdquo;';
            } elseif (is_tag()) {
                echo esc_html__('Posts tagged &ldquo;', 'lusion') . single_tag_title('', false) . '&rdquo;';
            } elseif (is_author()) {
                $userdata = get_userdata($author);
                echo esc_html__('Author:', 'lusion') . ' ' . $userdata->display_name;
            }

            if (get_query_var('paged')) {
                echo ' (' . esc_html__('Page', 'lusion') . ' ' . get_query_var('paged') . ')';
            }
        } else {
            if (is_home() && !is_front_page()) {
                if (!empty($home)) {
                    echo force_balance_tags(Lusion::setting('blog_title'));
                }
            }
        }
    }

    public static function breadcrumbs()
    {
        global $post, $wp_query, $author;
        $prepend = '';
        $before = '<li>';
        $after = '</li>';
        $home = '<span>' . esc_html__('Home', 'lusion') . '</span>';
        $shop_page_id = false;
        $shop_page = false;
        $front_page_shop = false;
        if (defined('WOOCOMMERCE_VERSION')) {
            $permalinks = get_option('woocommerce_permalinks');
            $shop_page_id = wc_get_page_id('shop');
            $shop_page = get_post($shop_page_id);
            $front_page_shop = get_option('page_on_front') == wc_get_page_id('shop');
        }

        // If permalinks contain the shop page in the URI prepend the breadcrumb with shop
        if ($shop_page_id && $shop_page && strstr($permalinks['product_base'], '/' . $shop_page->post_name) && get_option('page_on_front') != $shop_page_id) {
            $prepend = $before . '<a href="' . get_permalink($shop_page) . '">' . $shop_page->post_title . '</a> ' . $after;
        }

        if ((!is_home() && !is_front_page() && !(is_post_type_archive() && $front_page_shop)) || is_paged()) {
            echo '<ul class="breadcrumb">';

            if (!empty($home)) {
                echo wp_kses($before, array('li' => array())) . '<a class="home" href="' . apply_filters('woocommerce_breadcrumb_home_url', home_url('/')) . '"><i class="' . esc_attr(Lusion::setting('icon_link')) . '"></i> ' . $home . '</a>' . $after;
            }

            if (is_home()) {

                echo wp_kses($before, array('li' => array())) . single_post_title('', false) . $after;

            } else if (is_category()) {

                if (get_option('show_on_front') == 'page') {
                    echo wp_kses($before, array('li' => array())) . '<a href="' . get_permalink(get_option('page_for_posts')) . '">' . get_the_title(get_option('page_for_posts', true)) . '</a>' . $after;
                }

                $cat_obj = $wp_query->get_queried_object();
                $this_category = get_category($cat_obj->term_id);

                echo wp_kses($before, array('li' => array())) . single_cat_title('', false) . $after;

            } elseif (is_search()) {

                echo wp_kses($before, array('li' => array())) . esc_html__('Search results for &ldquo;', 'lusion') . get_search_query() . '&rdquo;' . $after;

            } elseif (is_tax('product_cat')) {

                echo wp_kses($prepend, lusion_allow_html());
                if (is_tax('product_cat')) {
                    $post_type = get_post_type_object('product');
                    echo wp_kses($before, array('li' => array())) . '<a href="' . get_post_type_archive_link('product') . '">' . $post_type->labels->singular_name . '</a>' . $after;
                }
                $current_term = $wp_query->get_queried_object();

                $ancestors = array_reverse(get_ancestors($current_term->term_id, get_query_var('taxonomy')));

                foreach ($ancestors as $ancestor) {
                    $ancestor = get_term($ancestor, get_query_var('taxonomy'));
                    if (!is_wp_error($ancestor) && $ancestor) {
                        echo wp_kses($before, array('li' => array())) . '<a href="' . get_term_link($ancestor->slug, get_query_var('taxonomy')) . '">' . esc_html($ancestor->name) . '</a>' . $after;
                    }
                }

                echo wp_kses($before, array('li' => array())) . esc_html($current_term->name) . $after;

            } elseif (is_tax('product_tag')) {

                $queried_object = $wp_query->get_queried_object();
                echo wp_kses($prepend, lusion_allow_html()) . wp_kses($before, array('li' => array())) . ' ' . esc_html__('Products tagged &ldquo;', 'lusion') . $queried_object->name . '&rdquo;' . $after;

            } elseif (is_tax('portfolio_cat')) {
                if (is_tax('portfolio_cat')) {

                    echo wp_kses($prepend, lusion_allow_html());

                    $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

                    $ancestors = array_reverse(get_ancestors($current_term->term_id, get_query_var('taxonomy')));

                    foreach ($ancestors as $ancestor) {
                        $ancestor = get_term($ancestor, get_query_var('taxonomy'));

                        echo wp_kses($before, array('li' => array())) . '<a href="' . get_term_link($ancestor->slug, get_query_var('taxonomy')) . '">' . esc_html($ancestor->name) . '</a>' . $after;
                    }

                    echo wp_kses($before, array('li' => array())) . esc_html($current_term->name) . $after;
                } else {
                    $queried_object = $wp_query->get_queried_object();
                    echo wp_kses($prepend, lusion_allow_html()) . wp_kses($before, array('li' => array())) . ' ' . esc_html__('Portfolio', 'lusion') . $queried_object->name . '&rdquo;' . $after;
                }
            } elseif (is_day()) {

                echo wp_kses($before, array('li' => array())) . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . $after;
                echo wp_kses($before, array('li' => array())) . '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after;
                echo wp_kses($before, array('li' => array())) . get_the_time('d') . $after;

            } elseif (is_month()) {

                echo wp_kses($before, array('li' => array())) . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after;
                echo wp_kses($before, array('li' => array())) . get_the_time('F') . $after;

            } elseif (is_year()) {

                echo wp_kses($before, array('li' => array())) . get_the_time('Y') . $after;

            } elseif (is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id) {

                $_name = wc_get_page_id('shop') ? get_the_title(wc_get_page_id('shop')) : '';

                if (!$_name) {
                    $product_post_type = get_post_type_object('product');
                    $_name = $product_post_type->labels->singular_name;
                }

                if (is_search()) {

                    echo wp_kses($before, array('li' => array())) . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . esc_html__('Search results for &ldquo;', 'lusion') . get_search_query() . '&rdquo;' . $after;

                } elseif (is_paged()) {

                    echo wp_kses($before, array('li' => array())) . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;

                } else {

                    echo wp_kses($before, array('li' => array())) . $_name . $after;

                }

            }elseif (is_post_type_archive('portfolio')) {
                if (Lusion::setting('portfolio_title') && Lusion::setting('portfolio_title') != "") {
                    $post_type = get_post_type_object(get_post_type());
                    echo wp_kses($before, array('li' => array())) . esc_html(Lusion::setting('portfolio_title')) . $after;
                } else {
                    $post_type = get_post_type_object('portfolio');
                    echo wp_kses($before, array('li' => array())) . '<a href="' . get_post_type_archive_link('portfolio') . '">' . esc_html($post_type->labels->name) . '</a>' . $after;
                }

            } elseif (is_single() && !is_attachment()) {

                if ('product' == get_post_type()) {

                    echo wp_kses($prepend, lusion_allow_html());

                    if ($terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'))) {
                        $main_term = $terms[0];
                        $ancestors = get_ancestors($main_term->term_id, 'product_cat');
                        $ancestors = array_reverse($ancestors);

                        foreach ($ancestors as $ancestor) {
                            $ancestor = get_term($ancestor, 'product_cat');

                            if (!is_wp_error($ancestor) && $ancestor) {
                                echo wp_kses($before, array('li' => array())) . '<a href="' . get_term_link($ancestor) . '">' . $ancestor->name . '</a>' . $after;
                            }
                        }

                        echo wp_kses($before, array('li' => array())) . '<a href="' . get_term_link($main_term) . '">' . $main_term->name . '</a>' . $after;

                    }

                    echo wp_kses($before, array('li' => array())) . get_the_title() . $after;

                } elseif (is_post_type_archive('portfolio')) {

                    if (Lusion::setting('portfolio_title') && Lusion::setting('portfolio_title') != "") {
                        $post_type = get_post_type_object(get_post_type());
                        $slug = $post_type->rewrite;
                        echo wp_kses($before, array('li' => array())) . esc_html(Lusion::setting('portfolio_title')) . $after;
                    } else {
                        $post_type = get_post_type_object('portfolio');
                        echo wp_kses($before, array('li' => array())) . '<a href="' . get_post_type_archive_link('portfolio') . '">' . esc_html($post_type->labels->name) . '</a>' . $after;
                    }

                } elseif ('wpsl_stores' == get_post_type()) {
                    $post_type = get_post_type_object(get_post_type());
                    echo wp_kses($before, array('li' => array())) . '<a href="' . get_permalink($post->post_parent) . '">' . esc_html__('Store Locator', 'lusion') . '</a>' . $after;
                    echo wp_kses($before, array('li' => array())) . get_the_title() . $after;

                } elseif ('post' != get_post_type()) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo wp_kses($before, array('li' => array())) . '<a href="' . get_post_type_archive_link(get_post_type()) . '">' . $post_type->labels->singular_name . '</a>' . $after;
                    echo wp_kses($before, array('li' => array())) . get_the_title() . $after;

                } else {

                    if ('post' == get_post_type() && get_option('show_on_front') == 'page') {
                        echo wp_kses($before, array('li' => array())) . '<a href="' . get_permalink(get_option('page_for_posts')) . '">' . get_the_title(get_option('page_for_posts', true)) . '</a>' . $after;
                    }

                    $cat = current(get_the_category());
                    if (($parents = get_category_parents($cat, TRUE, $after . $before)) && !is_wp_error($parents)) {
                        echo wp_kses($before, array('li' => array())) . substr($parents, 0, strlen($parents) - strlen($after . $before)) . $after;
                    }
                    echo wp_kses($before, array('li' => array())) . get_the_title() . $after;

                }

            } elseif (is_404()) {

                echo wp_kses($before, array('li' => array())) . esc_html__('Error 404', 'lusion') . $after;

            } elseif (!is_single() && !is_page() && get_post_type() != 'post') {

                $post_type = get_post_type_object(get_post_type());

                if ($post_type) {
                    echo wp_kses($before, array('li' => array())) . $post_type->labels->singular_name . $after;
                }

            } elseif (is_attachment()) {

                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                if (isset($cat[0])) {
                    $cat = $cat[0];
                }
                if (($parents = get_category_parents($cat, TRUE, $after . $before)) && !is_wp_error($parents)) {
                    echo wp_kses($before, array('li' => array())) . substr($parents, 0, strlen($parents) - strlen($after . $before)) . $after;
                }
                echo wp_kses($before, array('li' => array())) . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>' . $after;
                echo wp_kses($before, array('li' => array())) . get_the_title() . $after;

            } elseif (is_page() && !$post->post_parent) {

                echo wp_kses($before, array('li' => array())) . get_the_title() . $after;

            } elseif (is_page() && $post->post_parent) {

                $parent_id = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);

                foreach ($breadcrumbs as $crumb) {
                    echo '' . $before . $crumb . $after;
                }

                echo wp_kses($before, array('li' => array())) . get_the_title() . $after;

            } elseif (is_search()) {

                echo wp_kses($before, array('li' => array())) . esc_html__('Search results for &ldquo;', 'lusion') . get_search_query() . '&rdquo;' . $after;

            } elseif (is_tag()) {

                echo wp_kses($before, array('li' => array())) . esc_html__('Posts tagged &ldquo;', 'lusion') . single_tag_title('', false) . '&rdquo;' . $after;

            } elseif (is_author()) {

                $userdata = get_userdata($author);
                echo wp_kses($before, array('li' => array())) . esc_html__('Author:', 'lusion') . ' ' . $userdata->display_name . $after;

            }

            if (get_query_var('paged')) {
                echo wp_kses($before, array('li' => array())) . '&nbsp;(' . esc_html__('Page', 'lusion') . ' ' . get_query_var('paged') . ')' . $after;
            }

            echo '</ul>';
        } else {
            if (is_home() && !is_front_page()) {
                echo '<ul class="breadcrumb">';

                if (!empty($home)) {
                    echo wp_kses($before, array('li' => array())) . '<a class="home" href="' . apply_filters('woocommerce_breadcrumb_home_url', home_url('/')) . '"> ' . $home . '</a>' . $after;

                    echo wp_kses($before, array('li' => array())) . esc_html(Lusion::setting('blog_title')) . $after;
                }

                echo '</ul>';
            }
        }
    }
}
