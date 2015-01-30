<div class="posts">
<?php
$i = 0;
if (have_posts()) : while (have_posts()) : the_post(); $i++; ?>

    <?php $thumb = '';
	$classtext = '';
	$titletext = get_the_title();
	?>






     <?php if ($paged<=1) { ?>

<?php if ($i>2) { ?>
        <?php if ($i==3) { ?>
    <div class="subposts">
    <?php }; ?>
							   <?php if (($i%2)<>0) { ?>
							<div class="bord"></div>
						   <?php }; ?>

							<div class="sub_post_wrapper <?php if (($i%2)<>0) { ?>left<?php }; ?>">
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<div class="sub_post_content">

								<?php $width = 108; $height = 108;
									  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
									  $thumb = $thumbnail["thumb"];	?>

								<?php if ((get_option('deviant_index_thumbnails') == 'on') && ($thumb != '')) { ?>
									<div class="sub_post_image">
										<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height); ?>
									</div>
								<?php }; ?>
									<p><?php truncate_post(100); ?></p>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/more.jpg" class="more" alt="read more"/></a>
								</div>
							</div>

<?php } else { ?>


			<div class="mainpost">
						<div class="content_wrapper">
							<?php $width = 489; $height = 235;
								  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
								  $thumb = $thumbnail["thumb"];	?>
							<div class="post_content" style="background: url('<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, '', true, true); ?>') no-repeat 0px 58px;">
								<h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permanent Link to %s','Deviant'), get_the_title()) ?>"><?php truncate_title(35); ?></a></h2>
								<div class="text">
									<p><?php truncate_post(150); ?></p>
								</div>
								<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permanent Link to %s','Deviant'), get_the_title()) ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/more.png" class="more" alt="read more"/></a>
							</div>
						</div>
						<div class="post_details">
							<div class="info">
								<img src="<?php echo get_template_directory_uri(); ?>/images/authorlogo.gif" alt=""/>
								<p><?php the_author_posts_link(); ?></p>
								<div class="extender"></div>
							</div>
							<div class="info">
								<img src="<?php echo get_template_directory_uri(); ?>/images/calendarlogo.gif" alt=""/>
								<p><?php the_time(get_option('deviant_date_format')) ?></p>
								<div class="extender"></div>
							</div>
							<div class="info">
								<img src="<?php echo get_template_directory_uri(); ?>/images/commentlogo.gif" alt=""/>
								<p><?php comments_popup_link(esc_html__('0 comments','Deviant'), esc_html__('1 comment','Deviant'), '% '.esc_html__('comments','Deviant')); ?></p>
								<div class="extender"></div>
							</div>
						</div>
					</div>

<?php }; ?>

<?php } else { ?>

					<?php if ($i==1) { ?>
<div class="subposts">
<?php }; ?>
									<?php if (($i%2)<>0) { ?>
							<div class="bord"></div>
						   <?php }; ?>

							<div class="sub_post_wrapper <?php if (($i%2)<>0) { ?>left<?php }; ?>">
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<div class="sub_post_content">

								<?php $width = 108; $height = 108;
									  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
									  $thumb = $thumbnail["thumb"];	?>

								<?php if (get_option('deviant_index_thumbnails') == 'on' && ($thumb != '')) { ?>
									<div class="sub_post_image">
										<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height); ?>
									</div>
									<?php }; ?>
									<p><?php truncate_post(100); ?></p>
									<a href="<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/more.jpg" class="more" alt="read more"/></a>
								</div>
							</div>


<?php }; ?>




<?php endwhile; ?>
						<div class="bord"></div>
						<div class="extender"></div>
					</div>
				</div>
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
			</div>
		</div>
		<div class="extender"></div>
		<div class="mainbot">
		</div>

		<div class="extender"></div>
	</div>