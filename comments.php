<div class="comments">
    <div class="section-detail-wrapper review-form">
        <div class="review-wrapper">
            <h3 class="big-title-event">
                <?php comments_number (__('0 Comment on this Article', DIRESS_DOMAIN), __('1 Comment on this Article', DIRESS_DOMAIN), __('% Comments on this Article', DIRESS_DOMAIN))?>
            </h3>

            <ul class="media-list comment-list">
                <?php if( have_comments() ){

                    wp_list_comments( array ('callback' => 'et_blog_list_comments'));


                    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                        <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', DIRESS_DOMAIN ) ); ?></div>
                            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', DIRESS_DOMAIN ) ); ?></div>
                        </nav><!-- #comment-nav-below -->
                    <?php endif; // Check for comment navigation. 
                }
                ?>
            </ul>
        </div>
    </div>
    <?php  if( comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) { ?>

        <?php comment_form ( array (
            'comment_field'        => '<div class="form-item"><label for="comment">' . __( 'Comment', DIRESS_DOMAIN ) . '</label>
                                                    <div class="input">
                                                        <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                    </div> </div>',
            //'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', DIRESS_DOMAIN ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            //'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', DIRESS_DOMAIN ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'title_reply'          => __("Add a comment", DIRESS_DOMAIN),
            'title_reply_to'       => __( 'Leave a Reply to %s', DIRESS_DOMAIN),
            'cancel_reply_link'    => __( 'Cancel reply',DIRESS_DOMAIN ),
            'label_submit'         => __( 'Submit Comment', DIRESS_DOMAIN ),

        ) )?>

    <?php } else { ?>
        <div class="comment-form">
            <h3 class="widget-title"><?php _e("Comment closed!", DIRESS_DOMAIN);?></h3>
        </div>
    <?php } ?>
</div>


<?php
/**
 * Display list comment in blog
 * @param array $comment
 * @param array $args
 * @param $depth
 */
function et_blog_list_comments( $comment, $args, $depth ){
    $GLOBALS['comment'] = $comment;

    ?>
<li class="media" id="li-comment-<?php comment_ID();?>">
    <div id="comment-<?php comment_ID(); ?>">
        <a class="pull-left avatar-comment" href="#">
            <?php echo get_avatar( $comment->comment_author_email, 60 );?>
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php comment_author()?></h4>
            <p><?php comment_text(); ?></p>
            <span class="time-review"><i class="fa fa-clock-o"></i><?php echo $comment->comment_date; ?></time></span>
            <?php
            comment_reply_link(array_merge($args,   array(
                'reply_text' => __( '&nbsp;&nbsp;|&nbsp;&nbsp; Reply', DIRESS_DOMAIN ),
                'depth' => $depth,
                'max_depth' => $args['max_depth'] ) ));
            ?>
        </div>
    </div>
    <?php
}