<div class="posts">
<div class="subposts">
<?php
$i = 0;

if (have_posts()) : while (have_posts()) : the_post(); $i++; ?>

<?php $thumb = '';
	$classtext = '';
	$titletext = get_the_title();
	?>

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
											<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/more.jpg" class="more" alt="read more"/></a>
										</div>
									</div>
<?php endwhile; ?>
								<div class="bord"></div>
								<div class="extender"></div>
							</div>
						</div>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
else { ?>
<p class="pagination clearfix">
    <?php next_posts_link(esc_html__('&laquo; Previous Entries','Deviant')) ?>
	<?php previous_posts_link(esc_html__('Next Entries &raquo;','Deviant')) ?>
</p>
<?php } ?>
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