<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

$offset = $_GET["offset"];
$cat = $_GET["cat"];

// our loop
$categoryPosts = new WP_Query();
$categoryPosts->query('showposts=6&cat='.$cat.'&offset='.$offset);

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


</div> <? endwhile;
wp_reset_query();
?>