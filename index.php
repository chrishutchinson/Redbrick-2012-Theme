<?php
/*
Theme: Redbrick 2012
Filename: index.php
Author(s): Chris Hutchinson and Josh Holder
Date started: 09/08/2012, 23:03
Last updated: 09/08/2012 23:03
About: This is an entirely custom theme build during the redesign in advance of the academic year 2012/2013.
*/
?>

<?php get_header() ?>

<?php query_posts($query_string); // Pull out query from URL and run // ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<? the_content() ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>


<?php get_footer() ?>