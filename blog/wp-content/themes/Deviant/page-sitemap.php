<?php
/*
Template Name: Sitemap Page
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

			<div id="sitemap">
				<div class="sitemap-col">
					<h2><?php esc_html_e('Pages','Deviant'); ?></h2>
					<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
				</div> <!-- end .sitemap-col -->

				<div class="sitemap-col">
					<h2><?php esc_html_e('Categories','Deviant'); ?></h2>
					<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
				</div> <!-- end .sitemap-col -->

				<div class="sitemap-col">
					<h2><?php esc_html_e('Tags','Deviant'); ?></h2>
					<ul id="sitemap-tags">
						<?php $tags = get_tags();
						if ($tags) {
							foreach ($tags as $tag) {
								echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li> ';
							}
						} ?>
					</ul>
				</div> <!-- end .sitemap-col -->

				<div class="sitemap-col<?php echo ' last'; ?>">
					<h2><?php esc_html_e('Authors','Deviant'); ?></h2>
					<ul id="sitemap-authors" ><?php wp_list_authors('show_fullname=1&optioncount=1&exclude_admin=0'); ?></ul>
				</div> <!-- end .sitemap-col -->
			</div> <!-- end #sitemap -->

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