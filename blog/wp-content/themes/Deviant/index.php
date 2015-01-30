<?php get_header(); ?>


        <?php if (get_option('deviant_format') == 'on') { ?>
			<?php get_template_part('includes/blogstyleindex'); ?>
        <?php } else { get_template_part('includes/defaultindex'); } ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>