<?php
/**
 * Woocommerce Compare page
 *
 * @author YITH
 * @package YITH Woocommerce Compare
 * @version 2.3.2
 */

// remove the style of woocommerce
if (defined('WOOCOMMERCE_USE_CSS') && WOOCOMMERCE_USE_CSS) wp_dequeue_style('woocommerce_frontend_styles');

$is_iframe = (bool)(isset($_REQUEST['iframe']) && $_REQUEST['iframe']);

wp_enqueue_script('jquery-imagesloaded', YITH_WOOCOMPARE_ASSETS_URL . '/js/imagesloaded.pkgd.min.js', array('jquery'), '3.1.8', true);
wp_enqueue_script('jquery-fixedheadertable', YITH_WOOCOMPARE_ASSETS_URL . '/js/jquery.dataTables.min.js', array('jquery'), '1.10.19', true);
wp_enqueue_script('jquery-fixedcolumns', YITH_WOOCOMPARE_ASSETS_URL . '/js/FixedColumns.min.js', array('jquery', 'jquery-fixedheadertable'), '3.2.6', true);

$widths = array();
foreach ($products as $product) $widths[] = '{ "sWidth": "205px", resizeable:true }';

$table_text = get_option('yith_woocompare_table_text', __('Compare products', 'lusion'));
do_action('wpml_register_single_string', 'Plugins', 'plugin_yit_compare_table_text', $table_text);
$localized_table_text = apply_filters('wpml_translate_single_string', $table_text, 'Plugins', 'plugin_yit_compare_table_text');

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if gt IE 9]>
<html class="ie"<?php language_attributes() ?>>
<![endif]-->
<!--[if !IE]>
<html <?php language_attributes() ?>>
<![endif]-->

<!-- START HEAD -->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <?php wp_title(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>

    <?php wp_head() ?>

    <?php do_action('yith_woocompare_popup_head') ?>

    <link rel="stylesheet" href="<?php echo esc_attr(YITH_WOOCOMPARE_URL) ?>assets/css/colorbox.css"/>
    <link rel="stylesheet" href="<?php echo esc_attr(YITH_WOOCOMPARE_URL) ?>assets/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="<?php echo esc_attr($this->stylesheet_url()); ?>" type="text/css"/>

    <style type="text/css">
        body.loading {
            background: url("<?php echo esc_attr( YITH_WOOCOMPARE_URL ) ?>assets/images/colorbox/loading.gif") no-repeat scroll center center transparent;
        }
        body{
            font-family: 'Jost', san-serif;
        }
        body h1{
            background-color: #ebebeb;
            font-size: 24px;
            color: #2c2c2c;
            line-height: 32px;
            font-weight: 400;
           text-transform: inherit;
            padding: 18px 45px; 
        }
        body::-webkit-scrollbar {
            width: 6px;
        }
         
        body::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px #f5f5f5;
        }
         
        body::-webkit-scrollbar-thumb {
          background-color: #eaeaea;
          outline: 1px solid #f5f5f5;
        }
        .dataTables_scrollBody::-webkit-scrollbar-thumb {
          background-color: #eaeaea;
          outline: 1px solid #f5f5f5;
        }
        .dataTables_scrollBody::-webkit-scrollbar {
            height: 6px;
        }
        .dataTables_scrollBody::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px #eaeaea;
        }
        .dataTables_scrollBody table.compare-list{
            padding-bottom: 40px;
        }

        .yith-woocompare{
            padding-bottom: 0;
        }
        table.dataTable.compare-list tbody th, table.dataTable.compare-list tbody td{
            padding-left: 15px;
            padding-right: 15px;
        }
        body #yith-woocompare{
            padding: 10px 40px 40px;
        }
        table.compare-list td.odd {
            background: transparent;
        }
        table.compare-list tr.odd ,
        table.compare-list tr.image.even th ,
        table.compare-list tr.odd th, 
        table.compare-list tr.even,
        table.compare-list tr.even th,
        table.dataTable.compare-list tbody tr.even th {
            background: #fff !important;
        }
        .theme-icon-close{
            font-size: 14px;
            display: inline-block;
            height: 14px;
            width: 14px;
        }
        table.compare-list .image td{
            position: relative;
        }
        table.compare-list td.even {
            background: transparent;
        }
        table.compare-list .image  td a .remove{
            border-radius: 0;
            background-color: transparent;
            color: #2c2c2c;
            background: url("<?php echo esc_attr( LUSION_THEME_URI ) ?>/assets/images/remove.png");
            background-repeat: no-repeat;
            height: 10px;
            width: 10px;
            display: inline-block;
        }
        table.compare-list .image  td div.remove{
            height: 10px;
            width: 10px;
            position: absolute;
            right: 10px;
            top: 10px;
        }
        table.dataTable.compare-list tbody th, table.dataTable.compare-list tbody td{
            border-color: #ebeeee;
        }
        table.compare-list tbody th,
        table.dataTable.compare-list tbody th{
            background-color: #fff;
            padding-left: 43px;
            border-left: 1px solid #ebeeee;
            font-weight: 400;
            padding-top: 25px;
            padding-bottom: 25px;
            max-width: 190px;
            width: 190px;
            min-width: 190px;
        }
        table.compare-list .image  td a:hover .remove{
            background-color: transparent;
        }
        table.compare-list td img{
            padding: 0;
            margin-bottom: -4px;
            max-width: 100%;
            border: 0;
        }
        table.compare-list td{
            font-size: 16px;
            padding-right: 15px;
            padding-left: 15px;
        }
        table.dataTable.compare-list tbody .image td{
            padding: 0;
        }
        table.dataTable.compare-list tbody .title  td{
            font-size: 16px;
            color: #2c2c2c;
            line-height: 20px;
            letter-spacing: 0.02em;
        }
        table.compare-list tbody th, table.dataTable.compare-list tbody .image th {
            border: 0;
            border-right: 1px solid #ebeeee;
        }
        table.dataTable tbody tr.even{
            background-color: #f6f6f6;
        }
        table.compare-list .price td {
            text-decoration: none;
            font-size: 18px;
        }
        ins{
            text-decoration: none;
        }
        table.compare-list .add-to-cart td a:not(.unstyled_button){
            background-color: transparent;
            color: #707070;
            letter-spacing: 0.05em;
            text-transform: initial;
            font-size: 16px;
            padding: 0;
        }
        table.compare-list .add-to-cart td a:not(.unstyled_button){
            position: relative;
        }
        table.compare-list .add-to-cart td a:not(.unstyled_button):before{
            content: '';
            background-image: url("<?php echo esc_attr( LUSION_THEME_URI ) ?>/assets/images/icon-right-cart.png");
            height: 15px;
            width: 15px;
            background-color: #ff6e69;
            background-position: center;
            position: absolute;
            right: -24px;
            background-repeat: no-repeat;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }
        table.compare-list .add-to-cart td a:not(.unstyled_button):hover{
            background: transparent;
            color: #ff6e69;
        }
        table.compare-list .description td ul{
            padding-left: 16px;
        }
        table.compare-list .stock td span{
            color: #9a9a9a;
            font-size: 16px;
        }
    </style>
</head>
<!-- END HEAD -->

<?php global $product; ?>

<!-- START BODY -->
<body <?php body_class('woocommerce yith-woocompare-popup') ?>>

<h1>
    <?php echo wp_kses_post($localized_table_text); ?>
    <?php if (!$is_iframe) : ?><a class="close" href="#"><?php esc_html_e('Close window [X]', 'lusion' ) ?></a><?php endif; ?>
</h1>

<div id="yith-woocompare" class="woocommerce">

    <?php do_action('yith_woocompare_before_main_table'); ?>

    <table class="compare-list" cellpadding="0"
           cellspacing="0"<?php if (empty($products)) echo ' style="width:100%"' ?>>
        <thead>
        <tr>
            <th>&nbsp;</th>
            <?php foreach ($products as $product_id => $product) : ?>
                <td></td>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <?php foreach ($products as $product_id => $product) : ?>
                <td></td>
            <?php endforeach; ?>
        </tr>
        </tfoot>
        <tbody>

        <?php if (empty($products)) : ?>

            <tr class="no-products">
                <td><?php esc_html_e('No products added in the compare table.', 'lusion') ?></td>
            </tr>

        <?php else : ?>
            
            <?php foreach ($fields as $field => $name) : ?>

                <tr class="<?php echo esc_attr( $field ); ?>">

                    <th>
                        <?php if ($field != 'image') echo esc_html( $name ); ?>
                    </th>

                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' product_' . $product_id; ?>
                        <td class="<?php echo esc_attr( $product_class ); ?>">  
                            <?php
                            switch ($field) {

                                case 'image':
                                    echo '<div class="image-wrap">' . $product->get_image('yith-woocompare-image')  . '</div>';
                                    echo '<div class="remove"><a href=' . add_query_arg('redirect', 'view', $this->remove_product_url($product_id)) . ' data-product_id=' . esc_attr( $product_id ) . '><span class="remove"></span></a></div>';
                                    break;

                                case 'add-to-cart':
                                    woocommerce_template_loop_add_to_cart();
                                    break;

                                default:
                                    echo empty($product->fields[$field]) ? '&nbsp;' : $product->fields[$field]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    break;
                            }
                            ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach; ?>

                </tr>

            <?php endforeach; ?>

            <?php if ($repeat_price == 'yes' && isset($fields['price'])) : ?>
                <tr class="price repeated">
                    <th><?php echo wp_kses_post($fields['price']) ?></th>

                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' product_' . $product_id ?>
                        <td class="<?php echo esc_attr( $product_class ) ?>"><?php echo wp_kses_post( $product->fields['price'] ); ?></td>
                        <?php
                        ++$index;
                    endforeach; ?>

                </tr>
            <?php endif; ?>

            <?php if ($repeat_add_to_cart == 'yes' && isset($fields['add-to-cart'])) : ?>
                <tr class="add-to-cart repeated">
                    <th><?php echo wp_kses_post( $fields['add-to-cart'] ); ?></th>

                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' product_' . $product_id ?>
                        <td class="<?php echo esc_attr( $product_class ); ?>">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach; ?>

                </tr>
            <?php endif; ?>

        <?php endif; ?>

        </tbody>
    </table>

    <?php do_action('yith_woocompare_after_main_table'); ?>

</div>

<?php if (wp_script_is('responsive-theme', 'enqueued')) wp_dequeue_script('responsive-theme') ?><?php if (wp_script_is('responsive-theme', 'enqueued')) wp_dequeue_script('responsive-theme') ?>
<?php print_footer_scripts(); ?>

<script type="text/javascript">

    jQuery(document).ready(function ($) {
        $('a').attr('target', '_parent');

        var oTable;
        $('body').on('yith_woocompare_render_table', function () {

            var t = $('table.compare-list');

            if (typeof $.fn.DataTable != 'undefined' && typeof $.fn.imagesLoaded != 'undefined' && $(window).width() > 767) {
                t.imagesLoaded(function () {
                    oTable = t.DataTable({
                        'info': false,
                        'scrollX': true,
                        'scrollCollapse': true,
                        'paging': false,
                        'ordering': false,
                        'searching': false,
                        'autoWidth': false,
                        'destroy': true,
                        'fixedColumns': true
                    });
                });
            }
        }).trigger('yith_woocompare_render_table');

        // add to cart
        var redirect_to_cart = false,
            body = $('body');

        // close colorbox if redirect to cart is active after add to cart
        body.on('adding_to_cart', function ($thisbutton, data) {
            if (wc_add_to_cart_params.cart_redirect_after_add == 'yes') {
                wc_add_to_cart_params.cart_redirect_after_add = 'no';
                redirect_to_cart = true;
            }
        });

        body.on('wc_cart_button_updated', function (ev, button) {
            $('a.added_to_cart').attr('target', '_parent');
        });

        // remove add to cart button after added
        body.on('added_to_cart', function (ev, fragments, cart_hash, button) {

            $('a').attr('target', '_parent');

            if (redirect_to_cart == true) {
                // redirect
                parent.window.location = wc_add_to_cart_params.cart_url;
                return;
            }

            // Replace fragments
            if (fragments) {
                $.each(fragments, function (key, value) {
                    $(key, window.parent.document).replaceWith(value);
                });
            }
        });

        // close window
        $(document).on('click', 'a.close', function (e) {
            e.preventDefault();
            window.close();
        });

        $(window).on('resize yith_woocompare_product_removed', function () {
            $('body').trigger('yith_woocompare_render_table');
        });

    });

</script>

</body>
</html>