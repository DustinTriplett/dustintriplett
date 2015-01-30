<?php get_header(); ?>


        <?php if (get_option('deviant_format') == 'on') { ?>
			<?php get_template_part('includes/blogstylecat'); ?>
        <?php } else { get_template_part('includes/defaultcat'); } ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>