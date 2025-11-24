<?php get_header(); 
/*
* Template Name: Home
*/
?>

    <?php while(have_posts()): the_post();

        /** Index */
        get_template_part('templates/index'); 


     endwhile; ?>

<?php get_footer(); ?>