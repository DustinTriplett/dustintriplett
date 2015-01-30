<img src="<?php echo get_template_directory_uri(); ?>/images/post_details_top.gif" class="post_details_top" alt="post details top" />
<div class="post_details">
<?php if (in_array('author', get_option('deviant_postinfo2'))) { ?>
  <div class="info"> <img src="<?php echo get_template_directory_uri(); ?>/images/admin.png" alt=""/> <span><?php the_author_posts_link(); ?></span> </div>
  <?php }; ?>
  <?php if (in_array('date', get_option('deviant_postinfo2'))) { ?>
  <div class="info"> <img src="<?php echo get_template_directory_uri(); ?>/images/date.png" alt=""/> <span><?php the_time(get_option('deviant_date_format')) ?></span> </div>
  <?php }; ?>
  <?php if (in_array('categories', get_option('deviant_postinfo2'))) { ?>
  <div class="info"> <img src="<?php echo get_template_directory_uri(); ?>/images/news.png" alt=""/> <span><?php the_category(', ') ?></span> </div>
  <?php }; ?>
  <?php if (in_array('commments', get_option('deviant_postinfo2'))) { ?>
  <div class="info"> <img src="<?php echo get_template_directory_uri(); ?>/images/comments.png" alt=""/> <span><?php comments_popup_link(esc_html__('0 comments','Deviant'), esc_html__('1 comment','Deviant'), '% '.esc_html__('comments','Deviant')); ?></span> </div>
  <?php }; ?>

</div>
<img src="<?php echo get_template_directory_uri(); ?>/images/post_details_top.gif" class="post_details_bottom" alt="post details top" />