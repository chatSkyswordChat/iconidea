<?php
$cols = Lusion_Global::get_page_sidebar();
$blog_archive_layout = Lusion_Post::blog_layout();
$blog_column = Lusion_Post::blog_columns();
$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
$blog_layout_list_style = Lusion::setting('blog_archive_layout_list_style');
$blog_meta_enable = Lusion::setting('blog_archive_meta_enable');
$blog_meta = Lusion::setting('blog_archive_meta');
$desc_enable = Lusion::setting('blog_archive_desc_enable');
$limit_desc = Lusion::setting('limit_desc');
$featured_post = get_post_meta(get_the_ID(), 'featured_post', true);
$gallery = get_post_meta(get_the_ID(), 'gallery_metabox', true);
$blog_id =  'blog_id-' . wp_rand();
$cat_post = get_category(get_query_var('cat'));
if (is_category()) {
	$blog_layout = lusion_get_meta_value('blog_layout', false);
	$blog_layout_list_style = lusion_get_meta_value('blog_list_style', false);
	$blog_pagination = lusion_get_meta_value('post_pagination', false);
}
$i = 1;
if ($blog_layout_list_style === 'style_3') {
	$blog_layout_list_style_class = 'blog-list-style-3';
} elseif ($blog_layout_list_style === 'style_2') {
	$blog_layout_list_style_class = 'blog-list-style-2';
} elseif ($blog_layout_list_style === 'style_1') {
	$blog_layout_list_style_class = 'blog-list-style-1';
} else {
	$blog_layout_list_style_class = '';
}

if ($blog_layout_list_style === 'style_3') :
	$cat_post = get_category(get_query_var('cat'));
	$args = array(
		'post_type' => 'post',
		'terms'     => $cat_post,
		'post__in' => get_option('sticky_posts'),
		'posts_per_page' => 3
	);

	$the_query = new WP_Query($args);
?>
	<div class="blog-list-top">

		<?php if ($the_query->have_posts()) : ?>
			<div class="row load-item  blog-entries-wrap list_post_sticky <?php echo esc_attr($blog_archive_layout); ?> <?php echo esc_attr($blog_layout_list_style_class); ?>">
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
						$format_class = '';
						if (get_post_format() === 'quote') {
							$format_class = 'post-quote';
						} elseif (get_post_format() === 'link') {
							$format_class = 'post-link';
						} elseif (get_post_format() === 'audio') {
							$format_class = 'post-audio';
						} elseif (get_post_format() === 'video') {
							$format_class = 'post-video';
						} elseif (get_post_format() === 'image') {
							$format_class = 'post-image blog-has-img';
						} elseif (has_post_thumbnail()) {
							$format_class = 'blog-has-img';
						} else {
							$format_class = "";
						}
				?>
						<div class="item animate-top <?php echo esc_attr($blog_column); ?> item-page<?php echo esc_attr($current_page); ?>">
							<div class="blog-item  <?php echo esc_attr($format_class); ?>  <?php if (!has_post_thumbnail() &&  get_post_format() !== 'quote' && get_post_format() !== 'link' && get_post_format() !== 'audio') {
																								echo 'no-image';
																							} ?> <?php if (get_post_format() === 'gallery') {
																																																														echo 'item-gallery';
																																																													} ?> <?php if (is_sticky()) {
																																																																															echo 'post_sticky';
																																																																														} ?>">

								<?php if (get_post_format() === 'video') : ?>
									<?php $video = get_post_meta(get_the_ID(), 'post_video', true); ?>
									<?php if ($video && $video != '') : ?>
										<div class="blog-video blog-img">
											<a class="fancybox" data-fancybox href="<?php echo esc_url($video); ?>">
												<?php if (has_post_thumbnail()) {
													echo get_the_post_thumbnail(null, array(1920, 850), array(
														'class' =>  "no-lazyload",
														// "alt" => the_title_attribute(),
													));
												}
												?>
												<span class="btn-video"><i class="fa fa-play" aria-hidden="true"></i></span></a>
										</div>
									<?php endif; ?>
								<?php elseif (get_post_format() == 'gallery') : ?>
									<?php if (is_array($gallery) && count($gallery) > 1) : ?>
										<div id="<?php echo esc_attr($blog_id); ?>" class="slider blog-gallery blog-img">
											<?php
											$index = 0;
											foreach ($gallery as $key => $value) :
												$alt = get_post_meta($value, '_wp_attachment_image_alt', true);
											?>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<?php
													echo wp_get_attachment_image($value, array(1920, 850), false, array(
														'class' => "no-lazyload",
														// "alt"  => esc_attr($alt),
													)); ?>
												</a>
											<?php
												$index++; 
											endforeach; 
											?> 
										</div>
									<?php endif; ?>
								<?php elseif (get_post_format() == 'image') : ?>
									<?php if (has_post_thumbnail()) : ?>
										<div class="blog-img ">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php
												echo get_the_post_thumbnail(null, array(1920, 850), array(
													'class' => "no-lazyload",
													// "alt" => the_title_attribute(),
												));
												?>
											</a>
										</div>
									<?php endif; ?>
								<?php else : ?>
									<?php if (has_post_thumbnail()) : ?>
										<div class="blog-img">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php
												echo get_the_post_thumbnail(null, array(1920, 850), array(
													'class' => "no-lazyload",
													// "alt" => the_title_attribute(),
												));
												?>
											</a>
										</div>
									<?php endif; ?>
								<?php endif; ?>
								<div class="blog-post-info">
									<?php if (is_sticky()) : ?>
										<div class="icon-sticky"><i class="theme-icon-ray"></i></div>
									<?php endif; ?>
									<div class="category-post">
										<div class="info cate-post">
											<?php
											$cate = get_the_term_list($post->ID, 'category', '', ' ');
											if (!empty($cate)) {
												echo get_the_term_list($post->ID, 'category', '', '');
											}
											?>
										</div>
									</div>
									<h4 class="post-name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
									<div class="info-post">
										<div class="info default-date">
											<a href="<?php the_permalink(); ?>">
												<?php echo get_the_date(); ?>
											</a>
										</div>
										<div class="info info-comment">
											<?php comments_popup_link(esc_html__('Comment (0)', 'lusion'), esc_html__('Comment (1)', 'lusion'), esc_html__('Comment (%)', 'lusion')); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php
						$i++;
					endwhile;
				endif;

				wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
		<?php
		$feature_args = array(
			'post_type' => 'post',
			'post__not_in' => get_option("sticky_posts"),
			'posts_per_page' => 3,
			'meta_query' => array(
				array(
					'key' => 'featured_post',
					'value' => '1',
				)
			),
		);
		$the_query_featured = new WP_Query($feature_args);
		?>
		<?php if ($the_query_featured->have_posts()) : ?>
			<div class="load-item featured-post">
				<div class="container">
					<div class="row">
						<?php if ($the_query_featured->have_posts()) { ?>
							<div class=" col-md-12">
								<h2 class="tt-featured text-center"><?php echo esc_html__('Featured Post', 'lusion'); ?></h2>
							</div>
						<?php } ?>
						<?php if ($the_query_featured->have_posts()) : while ($the_query_featured->have_posts()) : $the_query_featured->the_post();
								$do_not_duplicate = $post->ID;
								$format_class = '';
								if (get_post_format() === 'quote') {
									$format_class = 'post-quote';
								} elseif (get_post_format() === 'link') {
									$format_class = 'post-link';
								} elseif (get_post_format() === 'audio') {
									$format_class = 'post-audio';
								} elseif (get_post_format() === 'video') {
									$format_class = 'post-video';
								} elseif (get_post_format() === 'image') {
									$format_class = 'post-image blog-has-img';
								} elseif (has_post_thumbnail()) {
									$format_class = 'blog-has-img';
								} else {
									$format_class = "";
								}
						?>

								<div class=" col-md-4 item animate-top item-page<?php echo esc_attr($current_page); ?>">
									<div class="blog-item  <?php echo esc_attr($format_class); ?>  <?php if (!has_post_thumbnail() &&  get_post_format() !== 'quote' && get_post_format() !== 'link' && get_post_format() !== 'audio') {
																										echo 'no-image';
																									} ?> <?php if (get_post_format() === 'gallery') {
																																																																echo 'item-gallery';
																																																															} ?> ">
										<div class="blog-img-top">
											<?php lusion_get_post_media(); ?>
											<?php if ($blog_meta_enable) :
												if (!empty($blog_meta)) { ?>
													<div class="blog-post-cat">
														<?php foreach ($blog_meta as $value) {
															if (in_array($value, $blog_meta, true)) { ?>
																<?php if ($value === 'categories') : ?>
																	<?php
																	$cate = get_the_term_list($post->ID, 'category', '', ' ');
																	if (!empty($cate)) {
																		echo get_the_term_list($post->ID, 'category', '', '', '');
																	}
																	?>
																<?php endif; ?>
														<?php
															}
														}
														?>
													</div>
											<?php
												}
											endif; ?>
										</div>
										<div class="blog-post-info">
											<div class="img-author">
												<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>">
													<?php if ($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE) : ?>
														<img src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))); ?>" alt="<?php get_the_title(); ?>">
													<?php endif; ?>

												</a>
											</div>
											<h4 class="post-name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
											<?php
											$excerpt = get_the_excerpt();
											if ($desc_enable && !empty($excerpt)) {
												echo '<div class= "blog_post_desc">';
												lusion_limit_excerpt($limit_desc);
												echo '</div>';
												wp_link_pages(array(
													'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'lusion') . '</span>',
													'after'       => '</div>',
													'link_before' => '<span>',
													'link_after'  => '</span>',
													'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'lusion') . ' </span>%',
													'separator'   => '<span class="screen-reader-text">, </span>',
												));
											}
											?>
											<div class="read_more">
												<a href="<?php the_permalink(); ?>" title="Read more"><?php echo esc_html__('Read more', 'lusion'); ?></a>
											</div>
										</div>
									</div>
								</div>
						<?php

							endwhile;
						endif;

						wp_reset_postdata(); ?>

					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>