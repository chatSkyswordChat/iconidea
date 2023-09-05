<?php
if ( ! class_exists( 'Apr_Core_Posts_Widget' ) ) {
	class Apr_Core_Posts_Widget extends Apr_Widget {

		public function __construct() {

			$cat_options = array(
				'recent_posts' => esc_html__( 'Recent Posts', 'apr-core' ),
			);
			$categories  = get_categories(array('taxonomy' => 'portfolio_cat'));;
			if ( $categories ) {
				foreach ( $categories as $category ) {
					$cat_options[ $category->term_id ] = esc_html__( 'Category: ', 'apr-core' ) . $category->name;
				}
			}

			$this->widget_cssclass    = 'tm-posts-widget';
			$this->widget_description = esc_html__( 'Get list blog/portfolio post.', 'apr-core' );
			$this->widget_id          = 'tm-posts-widget';
			$this->widget_name        = esc_html__( '[APR] Posts', 'apr-core' );
			$this->settings           = array(
				'post_type'           => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Post Type', 'apr-core' ),
					'options' => array(
						'post' => 'Post',
						'portfolio' => 'Portfolio',
					),
					'std'     => '01',
				),
				'title'           => array(
					'type'  => 'text',
					'label' => esc_html__( 'Title', 'apr-core' ),
					'std'   => '',
				),
				'cat'             => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Category', 'apr-core' ),
					'options' => $cat_options,
					'std'     => 'recent_posts',
				),
				'show_thumbnail'  => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show Thumbnail', 'apr-core' ),
					'std'   => 1,
				),
				'show_title'  => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show Title', 'apr-core' ),
					'std'   => 1,
				),
				'show_categories' => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show Categories', 'apr-core' ),
					'std'   => 1,
				),
				'show_date'       => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show Date', 'apr-core' ),
					'std'   => 0,
				),
				'show_more_post'  => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show More Post', 'apr-core' ),
					'std'   => 0,
				),
				'num'             => array(
					'type'  => 'number',
					'label' => esc_html__( 'Number Posts', 'apr-core' ),
					'step'  => 1,
					'min'   => 1,
					'max'   => 40,
					'std'   => 5,
				),
			);

			parent::__construct();
		}

		public function widget( $args, $instance ) {
			$post_type           = isset( $instance['post_type'] ) ? $instance['post_type'] : $this->settings['post_type']['std'];
			$cat             = isset( $instance['cat'] ) ? $instance['cat'] : $this->settings['cat']['std'];
			$num             = isset( $instance['num'] ) ? $instance['num'] : $this->settings['num']['std'];
			$show_thumbnail  = isset( $instance['show_thumbnail'] ) && $instance['show_thumbnail'] === 1 ? 'true' : 'false';
			$show_title  = isset( $instance['show_title'] ) && $instance['show_title'] === 1 ? 'true' : 'false';
			$show_categories = isset( $instance['show_categories'] ) && $instance['show_categories'] === 1 ? 'true' : 'false';
			$show_date       = isset( $instance['show_date'] ) && $instance['show_date'] === 1 ? 'true' : 'false';
			$show_more_post       = isset( $instance['show_more_post'] ) && $instance['show_more_post'] === 1 ? 'true' : 'false';
			$this->widget_start( $args, $instance );

			if ( $cat === 'recent_posts' ) {
				$query_args = array(
					'post_type'           => $post_type,
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
					'orderby'             => 'date',
					'order'               => 'DESC',
				);
			}else {
				$query_args = array(
					'post_type'           => $post_type,
					'cat'                 => $cat,
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
				);
			}
			//query_posts($query_args);
			$apr_query = new WP_Query( $query_args );
			if ( $apr_query->have_posts() ) {
				$count        = $apr_query->post_count;
				$i            = 0;
				$wrap_classes = "tm-posts-widget-wrapper";
				?>
				<div class="<?php echo esc_attr( $wrap_classes ); ?>">
					<div class="blog-all-item">
					<?php
					while ( $apr_query->have_posts() ) {
						$apr_query->the_post();
						$i ++;
						$classes = array( 'post-item' );
						if ( $i === 1 ) {
							$classes[] = 'first-post';
						} elseif ( $i === $count ) {
							$classes[] = 'last-post';
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?> >
							<?php if ( $show_thumbnail === 'true' ) : ?>
								<div class="post-widget-thumbnail">
						        	<a href="<?php the_permalink(); ?>">
						        		<?php
											echo get_the_post_thumbnail(null, array(70,70), array(
												'alt' => get_the_title(),
											));
	                                    ?>
						        	</a>
								</div>
							<?php endif; ?>
							<div class="post-widget-info">
								<?php if ( $show_categories === 'true' ) : ?>
									<div class="post-widget-categories">
										<?php if ( $post_type === 'post' ) : ?>
											<?php the_category( ', ' ); ?>
										<?php else: ?>
											<?php echo get_the_term_list($post->ID, 'portfolio_cat', '', ', ', ''); ?>
										<?php endif; ?>	
									</div>
								<?php endif; ?>
								<?php if ( $show_title === 'true' ) : ?>
									<h5 class="post-widget-title">
										<a href="<?php the_permalink(); ?>"
										   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h5>
								<?php endif; ?>
								<?php if ( $show_date === 'true' ) : ?>
									<div class=" custom-date ">
		                                <a href="<?php the_permalink(); ?>">
		                                    <span><?php echo get_the_time('F'); ?> <?php echo get_the_time('j'); ?>, <?php echo get_the_time('Y'); ?></span>
		                                </a>
		                            </div>
	                            <?php endif; ?>
							</div>
						</div>
					<?php }?>
					</div>
					<?php if($show_more_post === 'true') :?>
				        <div class="btn-viewmore">
				            <a class="view_more " href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html('View all &nbsp;','apr-core') .'<i class="fa fa-long-arrow-right" aria-hidden="true"></i>';?></a>
				        </div>
				    <?php endif; ?>  
				</div>
			<?php
			}
			wp_reset_query();

			$this->widget_end( $args );
		}
	}
}
