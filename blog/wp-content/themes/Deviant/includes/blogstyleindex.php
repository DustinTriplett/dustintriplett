<?php
$i = 0;

if (have_posts()) : while (have_posts()) : the_post(); $i++; ?>

    <?php $thumb = '';
	$width = (int) get_option('deviant_thumbnail_width_posts');
	$height = (int) get_option('deviant_thumbnail_height_posts');
	$classtext = '';
	$titletext = get_the_title();

	$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
	$thumb = $thumbnail["thumb"];
	?>




  <div class="post">
	<div class="post_top"></div>
		<div class="post_mid">
            <h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
			<?php if(get_option('deviant_postinfo2') ) { ?>
				<?php get_template_part('includes/postinfo'); ?>
			<?php } ?>

            <div id="postwrap" class="clearfix">
<?php if (get_option('deviant_thumbnails') == 'on') { ?>

<?php if($thumb <> '') { ?>
	<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height); ?>
<?php } ?>
            <?php }; ?>
			<?php the_content(); ?>
           </div>


        							</div>
							<div class="post_bot"></div>
						</div>



<?php endwhile; ?>
								<div class="bord"></div>
								<div class="extender"></div>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
else { ?>
<p class="pagination clearfix">
    <?php next_posts_link(esc_html__('&laquo; Previous Entries','Deviant')) ?>
	<?php previous_posts_link(esc_html__('Next Entries &raquo;','Deviant')) ?>
</p>
<?php } ?>
<div class="extender"></div>
<!--end recent post-->
<?php else : ?>
<!--If no results are found-->
<div class="home-post-wrap2">
    <h1><?php esc_html_e('No Results Found','Deviant') ?></h1>
    <p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','Deviant') ?></p>
</div>
<!--End if no results are found-->
<?php endif; ?>
<?php wp_reset_query(); ?>

					</div>
				</div>
                <div class="extender"></div>
				<div class="mainbot">
				</div>

				<div class="extender"></div>
			</div>