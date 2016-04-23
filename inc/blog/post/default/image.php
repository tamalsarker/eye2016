<?php
/**
 * @package 	WordPress
 * @subpackage 	Business
 * @version		1.0.0
 * 
 * Blog Page Default Image Post Format Template
 * Created by TemplateEYE
 * 
 */


echo 'Image Page<br/>';

?>
<div class="page-header">
    <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    <small><?php eye2015_posted_on(); ?></small>
</div>
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'eye2015' ), 'after' => '</div>' ) ); ?>
<?php edit_post_link( __( '<span class="glyphicon glyphicon-erase"></span> Edit', 'eye2015' ), '', '' ); ?>
<?php comments_template( '', true ); ?>