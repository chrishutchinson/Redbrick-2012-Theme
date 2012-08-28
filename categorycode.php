<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script src="http://beta.redbrickpaper.co.uk/scrollable.js"></script>
<script src="http://beta.redbrickpaper.co.uk/infinite.js"></script>
<script>
(function($) {
	$.fn.equalHeights = function(minHeight, maxHeight) {
		tallest = (minHeight) ? minHeight : 0;
		this.each(function() {
			if($(this).height() > tallest) {
				tallest = $(this).height();
			}
		});
		if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
		return this.each(function() {
			$(this).height(tallest).css("overflow","auto");
		});
	}
})(jQuery);
</script>
<script>
$(document).ready(function() {
	var width = $(window).width();
if (width > 1000) {
		$(".1").equalHeights(100,600); $(".2").equalHeights(100,600); $(".3").equalHeights(100,600);}   
});
</script>

<?php
get_header();
?>
<script>
$(function() {
  // initialize scrollable
  $(".scrollablecat").scrollable({circular: true}).autoscroll({ autoplay: true });
});

var Counter = 1;
window.onresize = function() {
var width = $(window).width();
var Number = 0;

while(Number <= Counter)
  {
if (width > 1000) {
		$("." + Number).equalHeights(100,600);
		Number++;
} else {
		$("." + Number).height("auto");
		Number++;
}
}
		
if(TO !== false)
    clearTimeout(TO);
    TO = setTimeout(resizeStuff, 200)
}

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
.categorylist a:hover {
	background-color:<? echo $sectioncolor; ?>;
	}
</style>
<div class="categoryname"><?php $cat_id=$_GET['cat']; $category = get_cat_name( $cat_id ); echo $category; ?></div><div class="containercontainer"><? if(empty($_GET["page"]) or $_GET["page"] == "1") { ?><div class="categoryoptions postbox 1"><div style="width: 100%; background-color: <?php echo $sectioncolor; ?>; padding: 5px; font-size: 14px; color: #FFFFFF; 	border-top-left-radius:4px; border-top-right-radius:4px; background-image: url(<?php bloginfo('template_directory'); ?>/images/optionsr.png); background-size: 32px 29px; background-position: left; background-repeat: no-repeat; padding-left: 38px;"><?php echo $twittername; ?></div><div class="optionscontainer">Categories:<div class="categorylist"><a href="<?php
echo site_url();
?>/?cat=<? echo $categoryID; ?>">Show All</a><?php
wp_list_categories('orderby=id&show_count=0&use_desc_for_title=0&child_of='.$categoryID.'&style=none&exclude='.$slidercategoryID);
?></div><div class="meettheeditors">Meet The Editors:</div>
<div class="editor"><img src="<?php echo $editor1image; ?>" style="width: 40px; height: 40px; float:left; margin-right: 5px;"><?php echo $editor1name; ?><br><img src="<?php bloginfo('template_directory'); ?>/images/twitter-bird.png"> <a href="https://twitter.com/<?php echo $editor1twitter; ?>"><?php echo $editor1twitter; ?></a>
</div>
<div class="editor"><img src="<?php echo $editor2image; ?>" style="width: 40px; height: 40px; float:left; margin-right: 5px;"><?php echo $editor2name; ?><br><img src="<?php bloginfo('template_directory'); ?>/images/twitter-bird.png"> <a href="https://twitter.com/<?php echo $editor2twitter; ?>"><?php echo $editor2twitter; ?></a>
</div>
<div class="editor" style="float:none;"><img src="<?php echo $editor3image; ?>" style="width: 40px; height: 40px; float:left; margin-right: 5px;"><?php echo $editor3name; ?><br><img src="<?php bloginfo('template_directory'); ?>/images/twitter-bird.png"> <a href="https://twitter.com/<?php echo $editor3twitter; ?>"><?php echo $editor3twitter; ?></a>
</div>
<div class="meettheeditors">Meeting Time: <? echo $meetingtime; ?>
	
</div> <? } ?>
</div></div><div class="container">
<?php

if(empty($_GET["page"])) {
} else {
	$page = $_GET["page"];
}
	
if ($page > 1) {
	$offset   = 8 + (($page - 2) * 9);
	$numposts = 9;
} else {
	$numposts = 8;
}
$categoryPosts = new WP_Query();
$categoryPosts->query('offset=' . $offset . '&showposts=' . $numposts . '&cat=' . get_query_var('cat'));
$incid       = 1;
$fouronwards = 1;
if (isset($oddcounter)) { echo "HEY";
} else { $oddcounter  = 1; }
while ($categoryPosts->have_posts()):
	$categoryPosts->the_post();
	$image_url = wp_get_attachment_url(get_post_thumbnail_id($id));
	
	if ($incid == 3) {
		if ($page < 2) {
			if ($fouronwards == 1) {

/* Script here */
		
				$incid       = 1;
				$fouronwards = 2;
				$oddcounter++;
				
			}
		}
	}
?> 
<div class="postbox <?php
	if ($incid == 1) {
		echo "left1 ";
	} else if ($incid == 2) {
		echo "middle1 ";
	} else if ($incid == 3) {
		echo "right1 ";
	}
	echo $oddcounter+(($page-1)*3);
?>"><div class="postthumbnail" style="background-image: url(<?
	echo $image_url;
?>);"></div><div class="categorytext"><h2 class="music"><?php $categories = get_the_category();
if ( $categories ) :
    $deepChild = get_deep_child_category( $categories );
    ?>
        <a style="color:<?php echo $sectioncolor; ?>;" href="<?php echo get_category_link( $deepChild->term_id ); ?>" title="View All"><?php if ($deepChild->name == "Slider (".$categoryname.")") { echo $categoryname; } else { echo $deepChild->name; }?></a>
    <?php 
endif; ?></h2><a href="<?php echo get_permalink( $id ); ?>"><h1><?php
	the_title();
?></h1></a><?
	the_excerpt();
?><h3><?php
	the_time('F jS, Y');
?> | <?php
	_e('Written by', 'WpAdvNewspaper');
?> <?php
	if (function_exists('coauthors_posts_links')) {
		coauthors();
	} else {
		the_author_posts_link(); 
	}
?></h3></div></div>
				
<?php
	$incid++;
	if ($incid > 3) {
	?> <script>Counter++;</script> <?
		if ($oddcounter == 3) {
?>
		<div class="navigation"><a id="next" href="<?php
			echo site_url();
			$goto = $page + 1;
?>/?cat=<? echo $_GET["cat"]; ?>&page=<?
			echo $goto;
?>">Next Page</a></div>
	<?
		}
		$incid = 1;
		$oddcounter++;
	}
endwhile;
?></div></div>
<script type="text/javascript">
$('.container').infinitescroll({
 
  navSelector  : "a#next",            
                 // selector for the paged navigation (it will be hidden)
 
  nextSelector : "a#next",    
                 // selector for the NEXT link (to page 2)
 
  itemSelector : ".container",          
                 // selector for all items you'll retrieve
  },function(arrayOfNewElems){
var width = $(window).width();  
if (width > 1000) {
var AnotherCount = 1;
while(AnotherCount <= 3) {
$("." + Counter).equalHeights(100,600);
Counter++;
AnotherCount++;
}
}
}); </script>
  <?
  get_footer()
?>