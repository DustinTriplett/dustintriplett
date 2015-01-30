<?php if ( ! function_exists( 'et_custom_comments_display' ) ) :
function et_custom_comments_display($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="comment_body">
    <?php echo get_avatar($comment,$size='73'); ?>
        <div class="messagewrap">
        <?php printf('<h3>%s</h3>', get_comment_author_link()) ?>

          <div class="date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(esc_html__('%1$s at %2$s','Deviant'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(esc_html__('(Edit)','Deviant'),'  ','') ?></div>
      <div class="message"><?php comment_text('') ?></div>
            <div class="extender"></div>

            <?php
        $et_comment_reply_link = get_comment_reply_link( array_merge( $args, array('reply_text' => esc_attr__('Reply','Deviant'),'depth' => $depth, 'max_depth' => $args['max_depth'])) );
        if ( $et_comment_reply_link ) echo '<div class="reply-container">' . $et_comment_reply_link . '</div>';
      ?>

              <?php if ($comment->comment_approved == '0') : ?>
                <div class="extender"></div>
        <em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','Deviant') ?></em>
        <br />
         <?php endif; ?>
               </div>
               <div class="extender"></div>
  </div>


<?php }
endif; ?>