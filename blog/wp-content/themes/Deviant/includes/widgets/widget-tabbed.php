<?php class TabbedWidget extends WP_Widget
{
    function TabbedWidget(){
		$widget_ops = array('description' => 'Displays Recent-Popular-Comments widget');
		$control_ops = array('width' => 400, 'height' => 500);
		parent::WP_Widget(false,$name='ET Tabbed',$widget_ops,$control_ops);
	}

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$recentPostsNumber = empty($instance['recentPostsNumber']) ? '' : (int) $instance['recentPostsNumber'];
		$popularPostsNumber = empty($instance['popularPostsNumber']) ? '' : (int) $instance['popularPostsNumber'];
		$commentsNumber = empty($instance['commentsNumber']) ? '' : (int) $instance['commentsNumber'];

?>

<?php $width = 38; $height = 38; ?>

	<div class="widget">

					<div class="tablinks">
						<ul>
							<li><a href="#" class="rec"><?php esc_html_e('recent','Deviant')?></a></li>
							<li><a href="#" class="current pop"><?php esc_html_e('popular','Deviant')?></a></li>
							<li><a href="#" class="ran"><?php esc_html_e('random','Deviant')?></a></li>
						</ul>
					</div>

                    <div class="widget_content recent">
						<ul>
				<?php query_posts("posts_per_page=$recentPostsNumber"); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php $thumb = '';
						  $classtext = '';
						  $titletext = get_the_title();

						  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
						  $thumb = $thumbnail["thumb"];	?>

							<li>
								<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height); ?>
								<p class="title">
									<a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','Deviant'), get_the_title()) ?>"><?php truncate_title(20); ?></a>
								</p>
								<p class="date">
									<?php esc_html_e('Posted by ','Deviant')?> <?php the_author_posts_link(); ?><?php esc_html_e(' on ','Deviant')?><?php the_time(get_option('deviant_date_format')) ?>
								</p>
							</li>
				<?php endwhile; endif; wp_reset_query(); ?>
						</ul>
					</div>

                     <div class="widget_content popular">
						<ul>
				<?php global $wpdb;
				$result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $popularPostsNumber");
				foreach ($result as $post) {
					#setup_postdata($post);
					$postid = (int) $post->ID;
					$title = $post->post_title;
					$commentcount = (int) $post->comment_count;
					if ($commentcount != 0) { ?>
						<?php query_posts("p=$postid"); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php global $post; ?>

						  <?php $thumb = '';
						  $classtext = '';
						  $titletext = get_the_title();

						  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
						  $thumb = $thumbnail["thumb"];	?>
							<li>
								<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height); ?>
								<p class="title">
									<a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','Deviant'), get_the_title()) ?>"><?php truncate_title(20); ?></a>
								</p>
								<p class="date">
									<?php esc_html_e('Posted by ','Deviant')?> <?php the_author_posts_link(); ?><?php esc_html_e(' on ','Deviant')?><?php the_time(get_option('deviant_date_format')) ?>
								</p>
							</li>
				<?php endwhile; endif; wp_reset_query(); ?>
                					<?php };
				}; ?>
						</ul>
					</div>

                    <div class="widget_content random">
						<ul>
				<?php query_posts("posts_per_page=$commentsNumber&orderby=rand"); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php global $post;	?>

							<?php $thumb = '';
						    $classtext = '';
						    $titletext = get_the_title();

						    $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
						    $thumb = $thumbnail["thumb"]; ?>
							<li>
								<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height); ?>
								<p class="title">
									<a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','Deviant'), get_the_title()) ?>"><?php truncate_title(20); ?></a>
								</p>
								<p class="date">
									<?php esc_html_e('Posted by ','Deviant')?> <?php the_author_posts_link(); ?><?php esc_html_e(' on ','Deviant')?><?php the_time(get_option('deviant_date_format')) ?>
								</p>
							</li>
				<?php endwhile; endif; wp_reset_query(); ?>
						</ul>
					</div>
</div>
<div class="extender"></div>
<?php
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['recentPostsNumber'] = (int) $new_instance['recentPostsNumber'];
		$instance['popularPostsNumber'] = (int) $new_instance['popularPostsNumber'];
		$instance['commentsNumber'] = (int) $new_instance['commentsNumber'];

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('recentPostsNumber'=>'3', 'popularPostsNumber'=>'3', 'commentsNumber'=>'3') );

		$recentPostsNumber = esc_attr($instance['recentPostsNumber']);
		$popularPostsNumber = esc_attr($instance['popularPostsNumber']);
		$commentsNumber = esc_attr($instance['commentsNumber']);

		# Number of Recent Posts
		echo '<p><label for="' . $this->get_field_id('recentPostsNumber') . '">' . 'Number of Recent Posts:' . '</label><input class="widefat" id="' . $this->get_field_id('recentPostsNumber') . '" name="' . $this->get_field_name('recentPostsNumber') . '" type="text" value="' . $recentPostsNumber . '" /></p>';

		# Number of Popular Posts
		echo '<p><label for="' . $this->get_field_id('popularPostsNumber') . '">' . 'Number of Popular Posts:' . '</label><input class="widefat" id="' . $this->get_field_id('popularPostsNumber') . '" name="' . $this->get_field_name('popularPostsNumber') . '" type="text" value="' . $popularPostsNumber . '" /></p>';

		# Number of Comments
		echo '<p><label for="' . $this->get_field_id('commentsNumber') . '">' . 'Number of Random Posts:' . '</label><input class="widefat" id="' . $this->get_field_id('commentsNumber') . '" name="' . $this->get_field_name('commentsNumber') . '" type="text" value="' . $commentsNumber . '" /></p>';

	}

}// end TabbedWidget class

function TabbedWidgetInit() {
	register_widget('TabbedWidget');
}

add_action('widgets_init', 'TabbedWidgetInit');