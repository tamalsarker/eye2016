<?php
/**
 * Template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to eye2015_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage EYE_2015
 * @since EYE 2015 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'eye2015' ); ?></p>
			</div><!-- #comments -->
<?php
		/*
		 * Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'eye2015' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'eye2015' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'eye2015' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/*
					 * Loop through and list the comments. Tell wp_list_comments()
					 * to use eye2015_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define eye2015_comment() and that will be used instead.
					 * See eye2015_comment() in eye2015/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'eye2015_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'eye2015' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'eye2015' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

	<?php
	/*
	 * If there are no comments and comments are closed, let's leave a little note, shall we?
	 * But we only want the note on posts and pages that had comments in the first place.
	 */
	if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'eye2015' ); ?></p>
	<?php endif;  ?>

<?php endif; // end have_comments() ?>

<?php //comment_form(); ?>

<?php
$comments_args = array(

        // remove "Text or HTML to be displayed after the set of comment fields"
        'class_submit' => 'btn btn-default',
        'title_reply'=>'Leave a Comment', 
        'label_submit'      => __( 'Submit Comment' ),
        'comment_notes_before' => '<div class="comment-wrap">',
        'comment_notes_after' => '</div><br/>',
        
       'fields' => apply_filters( 'comment_form_default_fields', array(

		    'author' =>
		        '<div class="form-group">' .
					'<label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<input class="form-control" placeholder="Name*" id="author" name="author" type="text" 
						value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
				</div>',

		    'email' =>
		      	'<div class="form-group">
			  		<label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
		      		( $req ? '<span class="required">*</span>' : '' ) .
		      		'<input class="form-control" placeholder="Email*" id="email" name="email" type="text" 
						value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' />
				</div>',

		    'url' =>
		      '<div class="form-group">
			  	<label for="url">' .
		      __( 'Website', 'domainreference' ) . '</label>' .
		      	'<input class="form-control" placeholder="Website" id="url" name="url" type="text" 
					value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" />
			  </div>'
		    )
        ),
		
		'logged_in_as' => '<div class="comment-wrap">' .
    sprintf(
    __( '<p>Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a></p>' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '',
		
		'comment_field' => '<label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea class="form-control" placeholder="Type your comment here*" id="comment" name="comment" aria-required="true"></textarea>',

); ?>

<?php comment_form($comments_args); ?>

</div><!-- #comments -->
