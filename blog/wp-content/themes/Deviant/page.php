<?php get_header(); ?>
		<?php if (get_option('deviant_integration_single_top') <> '' && get_option('deviant_integrate_singletop_enable') == 'on') echo(get_option('deviant_integration_single_top')); ?>
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

	<?php $thumb = '';
	$width = (int) get_option('deviant_thumbnail_width_pages');
	$height = (int) get_option('deviant_thumbnail_height_pages');
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
           </div>
		<?php if (get_option('deviant_integration_single_bottom') <> '' && get_option('deviant_integrate_singlebottom_enable') == 'on') echo(get_option('deviant_integration_single_bottom')); ?>
        <?php if (get_option('deviant_foursixeight') == 'on') { ?>
			<?php get_template_part('includes/468x60'); ?>
        <?php } ?>

        							</div>
							<div class="post_bot"></div>
						</div>


         <?php if (get_option('deviant_show_pagescomments') == 'on') { ?>
			<?php comments_template('', true); ?>
		<?php }; ?>
        <?php endwhile; ?>
        <?php else : ?>
        <!--If no results are found-->
        <h1><?php esc_html_e('No Results Found','Deviant') ?></h1>
        <p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','Deviant') ?></p>
        <!--End if no results are found-->
        <?php endif; ?>
					</div>

				</div>
					<div class="mainbot">
				</div>

			</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>