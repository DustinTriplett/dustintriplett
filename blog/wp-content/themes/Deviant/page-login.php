<?php
/*
Template Name: Login Page
*/
?>
<?php
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>

<?php get_header(); ?>
		<?php if (get_option('deviant_integration_single_top') <> '' && get_option('deviant_integrate_singletop_enable') == 'on') echo(get_option('deviant_integration_single_top')); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php $thumb = '';
	$width = get_option('deviant_thumbnail_width_pages');
	$height = get_option('deviant_thumbnail_height_pages');
	$classtext = '';
	$titletext = get_the_title();

	$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
	$thumb = $thumbnail["thumb"];
	?>

        <!--Begin Post-->
  <div class="post">
	<div class="post_top"></div>
		<div class="post_mid">
            <h1 id="h1page"><?php the_title() ?></h1>
            <div id="postwrap" class="clearfix">
<?php if (get_option('deviant_page_thumbnails') == 'on') { ?>

<?php if($thumb <> '') { ?>
	<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height); ?>
<?php } ?>
            <?php }; ?>
			<?php the_content(); ?>

			<div id="et-login">
				<div class='et-protected'>
					<div class='et-protected-form'>
						<?php $scheme = apply_filters( 'et_forms_scheme', null ); ?>

						<form action='<?php echo esc_url( home_url( '', $scheme ) ); ?>/wp-login.php' method='post'>
							<p><label><span><?php esc_html_e('Username','Deviant'); ?>: </span><input type='text' name='log' id='log' value='<?php echo esc_attr($user_login); ?>' size='20' /><span class='et_protected_icon'></span></label></p>
									<p><label><span><?php esc_html_e('Password','Deviant'); ?>: </span><input type='password' name='pwd' id='pwd' size='20' /><span class='et_protected_icon et_protected_password'></span></label></p>
							<input type='submit' name='submit' value='Login' class='etlogin-button' />
						</form>
					</div> <!-- .et-protected-form -->
				</div> <!-- .et-protected -->
			</div> <!-- end #et-login -->

			<div class="clear"></div>

           </div>
		<?php if (get_option('deviant_integration_single_bottom') <> '' && get_option('deviant_integrate_singlebottom_enable') == 'on') echo(get_option('deviant_integration_single_bottom')); ?>
        <?php if (get_option('deviant_foursixeight') == 'on') { ?>
			<?php get_template_part('includes/468x60'); ?>
        <?php } ?>

        							</div>
							<div class="post_bot"></div>
						</div>
						<?php endwhile; endif; ?>
                    </div>

				</div>
					<div class="mainbot">
				</div>

			</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>