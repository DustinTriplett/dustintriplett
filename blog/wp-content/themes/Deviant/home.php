<?php get_header(); ?>


        <?php if (get_option('deviant_format') == 'on') { ?>
			<?php get_template_part('includes/blogstyle'); ?>
        <?php } else { get_template_part('includes/default'); } ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>