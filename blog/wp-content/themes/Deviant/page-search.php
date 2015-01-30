<?php
/*
Template Name: Search Page
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

			<div id="et-search">
				<div id="et-search-inner" class="clearfix">
					<p id="et-search-title"><span><?php esc_html_e('search this website','Deviant'); ?></span></p>
					<form action="<?php echo esc_url( home_url() ); ?>" method="get" id="et_search_form">
						<div id="et-search-left">
							<p id="et-search-word"><input type="text" id="et-searchinput" name="s" value="<?php esc_attr_e('search this site...','Deviant'); ?>" /></p>

							<p id="et_choose_posts"><label><input type="checkbox" id="et-inc-posts" name="et-inc-posts" /> <?php esc_html_e('Posts','Deviant'); ?></label></p>
							<p id="et_choose_pages"><label><input type="checkbox" id="et-inc-pages" name="et-inc-pages" /> <?php esc_html_e('Pages','Deviant'); ?></label></p>
							<p id="et_choose_date">
								<select id="et-month-choice" name="et-month-choice">
									<option value="no-choice"><?php esc_html_e('Select a month','Deviant'); ?></option>
									<?php
										global $wpdb, $wp_locale;

										$selected = '';
										$arcresults = $wpdb->get_results(
											$wpdb->prepare( "SELECT YEAR(post_date) AS %s, MONTH(post_date) AS %s, count(ID) as posts FROM $wpdb->posts GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC", 'year', 'month' )
										);

										foreach ( (array) $arcresults as $arcresult ) {
											if ( isset($_POST['et-month-choice']) && ( $_POST['et-month-choice'] == ($arcresult->year . $arcresult->month) ) ) {
												$selected = ' selected="selected"';
											}
											echo "<option value='{$arcresult->year}{$arcresult->month}'{$selected}>{$wp_locale->get_month($arcresult->month)}" . ", {$arcresult->year}</option>";
											if ( $selected <> '' ) $selected = '';
										}
									?>
								</select>
							</p>

							<p id="et_choose_cat"><?php wp_dropdown_categories('show_option_all=Choose a Category&show_count=1&hierarchical=1&id=et-cat&name=et-cat'); ?></p>
						</div> <!-- #et-search-left -->

						<div id="et-search-right">
							<input type="hidden" name="et_searchform_submit" value="et_search_proccess" />
							<input class="et_search_submit" type="submit" value="<?php esc_attr_e('Submit','Deviant'); ?>" id="et_search_submit" />
						</div> <!-- #et-search-right -->
					</form>
				</div> <!-- end #et-search-inner -->
			</div> <!-- end #et-search -->

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