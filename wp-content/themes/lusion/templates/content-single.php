<?php
    $blog_post_meta = Lusion::setting( 'single_post_meta' );
    $other_news_title = Lusion::setting( 'other_news_title' );
    $single_post_related_number = Lusion::setting( 'single_post_related_number' );
    $number_related = apply_filters( 'lusion_related_posts', 3 );
    $related        = lusion_get_related_posts( $post->ID, $single_post_related_number );
    $description_admin =  get_the_author_meta( 'description' );
?>
<div class="blog post-single">
    <div class="blog-content blog-item <?php if ( !has_post_thumbnail() &&  get_post_format() !=='quote' && get_post_format() !=='link' && get_post_format() !=='audio' ) {echo 'no-image';}?>">
        <div class="blog-info-single">
            <?php if (!empty($blog_post_meta)){
                foreach ($blog_post_meta as $value){
                    if (in_array($value, $blog_post_meta,true)){ ?>
                        <?php if ($value ==='date'):?>
                            <div class="info default-date">
                               <i class="theme-icon-calendar"></i> <a href="<?php the_permalink(); ?>">
                                    <?php echo get_the_date(); ?>
                                </a>
                            </div>
                        <?php endif;?>
                        <?php if ($value ==='categories'):?>
                            <div class="info cate-post">
                                <?php
                                    $cate = get_the_term_list($post->ID, 'category', '', ', ');
                                    if(!empty($cate)) {
                                        echo '<i class="theme-icon-list"></i>';
                                        echo get_the_term_list($post->ID,'category', '',', ','' );
                                    }
                                ?>
                            </div>
                        <?php endif;?>
                         <?php if ($value ==='comment'):?>
                            <div class="info info-comment">
                                <i class="theme-icon-comment"></i>
                                 <?php comments_popup_link(esc_html__('0 comments', 'lusion'), esc_html__('1 comment', 'lusion'), esc_html__('% comments', 'lusion')); ?>
                            </div>  
                        <?php endif;?>
                        <?php if ($value ==='author'):?>
                            <div class="info author-post">
                                <i class="theme-icon-user1"></i> 
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                    <?php the_author(); ?>
                                </a>     
                            </div>
                        <?php endif;?>
                        <?php
                    }
                }
            }
        ?>
        </div>
        <div class="title-post-single">
            <h1><?php echo get_the_title(); ?></h1>
        </div>

        <?php lusion_get_post_media();?>
        <!-- <h3 class="title-post-single">
            <?php echo the_title_attribute();?>
        </h3> -->
        <?php 
          $content_desc = get_the_content();
            if(!empty($content_desc)){
            echo '<div class="blog_post_desc">';                   
            the_content();
             echo '</div>';
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'lusion' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'lusion' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) );   
            }  
        ?>            
    </div>
    <?php if ( Lusion::setting( 'single_post_tag_enable' ) === '1' || Lusion::setting( 'single_post_share_enable' ) === '1' ) : ?>
    <div class="tag-share">
        <?php if ( Lusion::setting( 'single_post_tag_enable' ) === '1' ) : ?>
             <?php
            $tag = get_the_tag_list(' ',' ',' ');
            if(!empty($tag)){
                echo '<div class="tag-post-single">';
                echo '<div class="info-tag">';
                echo get_the_tag_list(' ',' ',' ');
                echo '</div>';
                echo '</div>';
            }
            ?>
        <?php endif; ?>
        
        <?php if ( Lusion::setting( 'single_post_share_enable' ) === '1' ) : ?>
            <div class="action">
                <?php Lusion_Templates::post_sharing(); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php endif; ?>
    <?php if ( Lusion::setting( 'single_post_description_author_enable' ) === '1' && $description_admin != '' ) : ?>
        <div class="author-post-single">
            <div class="img-author">
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                   <?php if($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE): ?>
                    <img src="<?php echo esc_url( get_avatar_url( get_the_author_meta('ID'))); ?>" alt="<?php get_the_title(); ?>">
                    <?php endif; ?>
                   
                </a> 
            </div>
             <div class="info-author">
                <h4><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></h4>
                <p>
                    <?php echo get_the_author_meta( 'description' );?>
                </p>
             </div>  
        </div> 
    <?php endif; ?>
    
    <div class="pagination-link">
        <nav class="navigation case-navigation">
            <div class="nav-links">
                <div class="nav-previous">
                    <div class="icon-prev">
                        <?php previous_post_link( '%link', '<i class="theme-icon-back"></i>'); ?>
                    </div>
                    <div class="text-prev">
                        <?php previous_post_link( '%link', __( 'Previous post', 'lusion' )); ?>
                        <?php previous_post_link('%link', '%title'); ?>
                    </div>
                    
                </div>
                <div class="nav-next">
                    <div class="text-next">
                        <?php next_post_link( '%link', __( 'Next Post', 'lusion' ) );?>
                        <?php next_post_link('%link', '%title'); ?>
                    </div>
                    <div class="icon-next">
                        <?php previous_post_link( '%link', '<i class="theme-icon-next"></i>'); ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <?php if ( Lusion::setting( 'single_post_related_enable' ) === '1' ) : ?>
    <?php
    if ( $related->have_posts() ) {
       ?>
       <div class="related-archive">
           <?php if($other_news_title !== ''): ?>
                    <?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): ?>
                        <h3><?php echo esc_html__('Other news from the Lusion: ','lusion' );?> </h3>
                    <?php else :?> 
                        <h3><?php echo esc_html($other_news_title); ?></h3>
                    <?php endif;?>
                <?php endif;?>
           <?php
           echo '<div class="item-posts">';
           while ( $related->have_posts() ) {
           $related->the_post();?>
           <h5>
               <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( the_title_attribute() ); ?>"><?php the_title(); ?></a>
           </h5>
           <?php
           }
           wp_reset_postdata();
           echo '</div>';
           ?>
       </div>
    <?php }?>
    <?php endif; ?> 
    <?php
        if ( Lusion::setting( 'single_post_comment_enable' ) === '1' ) {
        comments_template('', true);
    }?>
</div>