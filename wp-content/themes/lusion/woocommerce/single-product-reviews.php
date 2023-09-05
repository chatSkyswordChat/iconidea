<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}
 $single_type = Lusion_Templates::get_product_single_style();
?>

<?php if ($single_type != 'single_3'): ?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
				/* translators: 1: reviews count 2: product name */
                if($count<=9){
                    echo "0";
                }
				printf( esc_html( _n( '%1$s Reviews', '%1$s Reviews', $count, 'lusion' ) ), esc_html( $count ) );
			} else {
				_e( 'Reviews', 'lusion' );
			}
		?></h2>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'lusion' ); ?></p>

		<?php endif; ?>
	</div>
	
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Write a Review', 'lusion' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'lusion' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'lusion' ),
						'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
						'title_reply_after'    => '</h3>',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="comment-group"><p class="comment-form-author">'.
										'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="'.esc_attr__( 'Name', 'lusion' ).'" size="30" required /></p>',
							'email'  => '<p class="comment-form-email">'.
										'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="'. esc_attr__( 'Email', 'lusion' ) .'" size="30" required /></p></div>',
						),
                        'class_submit'         => 'btn btn-primary',
                        'label_submit'      => esc_html__('Submit','lusion'),
						'logged_in_as'  => '',
						'comment_field' => '',
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'lusion' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . '</label><select name="rating" id="rating" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'lusion' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'lusion' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'lusion' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'lusion' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'lusion' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'lusion' ) . '</option>
						</select></div>';
					}

                    $comment_form['comment_field'] .= '<div class="form-comment"><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'. esc_attr__('Review','lusion') .'" required></textarea></p></div>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'lusion' ); ?></p>

	<?php endif; ?>
	<?php if ($single_type === 'single_4'): ?>
		<button class="btn btn-primary add-single-review2">
			<?php if ( have_comments() ) :?>
			 	<?php echo esc_html__('Add review','lusion');?>
			<?php else:?>
				<?php echo esc_html__('Add first review','lusion');?>
			<?php endif;?>
		</button>
	<?php endif;?>
	<div class="clear"></div>
</div>
<?php endif;?>