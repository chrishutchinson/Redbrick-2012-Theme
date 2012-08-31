<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script src="http://beta.redbrickpaper.co.uk/scrollable.js"></script>
<script src="http://redbrickpaper.co.uk/new/wp-content/themes/redbrick/js/ajaxLoop.js"></script>
<?php
get_header();
?>

<script>
$(function() {
  // initialize scrollable
  $(".scrollablecat").scrollable({circular: true}).autoscroll({ autoplay: true });
});

function resizeStuff() {
var api2 = $(".scrollablecat").data("scrollable");
api2.move(1);
}
var TO = false;
</script>
<!-- Start Slider -->
<div class="sliderholder">
<div id="leftgreyboxcat"><div class="left-space"><a class="prev browse left-space"><img src="<?php bloginfo('template_directory'); ?>/images/left.png"></a></div></div>
<div id="rightgreyboxcat"><div class="right-space"><a class="next browse right-space"><img src="<?php bloginfo('template_directory'); ?>/images/right.png"></a></div></div>
<div class="scrollablecat" id="scrollablecat"><div class="itemscat">
  <?php $the_query = new WP_Query( 'cat='.$slidercategoryID ); // Query slider category ID ?>
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

  <?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<?php $featured = $image[0]; // Featured image URL // ?>
<?php else: ?>
<?php $featured = "" // Fallback image if there is none supplied // ?>
<?php endif; ?>
<div class="scrollitemscat" style="background-image: url(<?php echo $featured ?>); background-size:cover;">
    <span class="scrollitemtitle"><a href="<?php echo get_permalink( $id ); ?>"><?php echo get_the_title() ?></a></span> <br><span class="scrollitemdescription"><?php echo get_the_excerpt() ?></span>  
    </div> 
<?php endwhile; ?>
</div>
 
</div>
</div>
<!-- End Slider -->
<style>
.item h2 a:visited, .item h2 a:link, .item h2 a:active {
	color: <? echo $sectioncolor; ?>
}
.current-cat a:link, .current-cat a:active, .current-cat a:visited{
	background-color: <? echo $sectioncolor; ?>
}
.catnav li a:hover {
	background-color: <? echo $sectioncolor; ?>
}
</style>
<div class="catnav"><li <? if (get_cat_id( single_cat_title("",false) ) == $categoryID) { ?>class="current-cat" <? } ?>><a href="<?php echo get_category_link($categoryID); ?>"><? echo $categoryname; ?></a></li><?php
wp_list_categories('title_li=&orderby=id&show_count=0&use_desc_for_title=0&child_of='.$categoryID.'&exclude='.$slidercategoryID.$navcatexclusions);
?></div>
<div class="featurearea"><?php include(TEMPLATEPATH . '/featureareas/'.$categoryname.'.php'); ?></div>
<div class="container">
<script> var category = "<?= get_query_var('cat'); ?>";</script>
<? 
$categoryPosts = new WP_Query();
$categoryPosts->query('showposts=6&cat='.get_query_var('cat'));

while ($categoryPosts->have_posts()): //determines the child category for the post
$categoryPosts->the_post();
$image_url = wp_get_attachment_url(get_post_thumbnail_id($id));
$categories = get_the_category();
if ( $categories ) :
$deepChild = get_deep_child_category( $categories );
 if ($deepChild->name == "Slider (".$categoryname.")") { $categoryecho = $categoryname; } else { $categoryecho = $deepChild->name; }?></a>
 <?php $category_ID = get_category_id($categoryecho); endif; if (function_exists('get_terms_meta'))
{
$new_value = get_terms_meta($category_ID, 'categorypagesize', true);
}?>

<div class="item">

<!-- Displays the post in either mini, full or half form, through a series of if statements -->
<?php if ($new_value == "mini") { 
if (strlen(get_the_title()) < 18) { ?> 
<div class="postthumbnailmini" style="background-image: url(<? echo $image_url; ?>);"></div><div class="categorytextmini"><h2><a class="categoryname" href="<?php echo get_category_link($category_ID); ?>"><? echo substr($categoryecho, 0, 29); ?></a></h2><h1><a href="<?php echo get_permalink(); ?>"><? the_title(); ?></a></h1></div> <? } else { ?> <div class="postthumbnailmini2" style="background-image: url(<? echo $image_url; ?>);"></div><div class="categorytextmini2"><h2><a class="categoryname" href="<?php echo get_category_link($category_ID); ?>"><? echo $categoryecho; ?></a></h2><h1><a href="<?php echo get_permalink(); ?>"><? the_title(); ?></a></h1></div> <? }} elseif ($new_value == "half") { ?> <div class="postthumbnail" style="background-image: url(<? echo $image_url; ?>);"></div><div class="categorytext"><h2><a class="categoryname" href="<?php echo get_category_link($category_ID); ?>"><? echo $categoryecho; ?></a></h2><h1><a href="<?php echo get_permalink(); ?>"><? the_title(); ?></a></h1></div> <? } else { ?>
<div class="postthumbnail" style="background-image: url(<? echo $image_url; ?>);"></div><div class="categorytext"><h2><a class="categoryecho" href="<?php echo get_category_link($category_ID); ?>"><? echo $categoryecho; ?></a></h2><h1><a href="<?php echo get_permalink(); ?>"><? the_title(); ?></a></h1><? the_excerpt(); ?></div> <? } ?>


</div> <? endwhile; ?>
</div>
<script src="http://masonry.desandro.com/jquery.masonry.min.js"></script>
<script>
$(function(){
  $('.container').masonry({
    // options
    itemSelector : '.item',
    columnWidth : 340
  });
});
</script>
<?
get_footer()
?>