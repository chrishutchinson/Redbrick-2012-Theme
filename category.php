<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
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
<div class="categoryname"><?php $cat_id=$_GET['cat']; $category = get_cat_name( $cat_id ); echo $category; ?></div><div class="containercontainer"><div class="container">
<?php

if(empty($_GET["page"])) {
} else {
	$page = $_GET["page"];
}
	
if ($page > 1) {
	$offset   = 8 + (($page - 2) * 9);
	$numposts = 9;
} else {
	$numposts = 9;
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
        <a style="color:#636363;" href="<?php echo get_category_link( $deepChild->term_id ); ?>" title="View All"><?php if ($deepChild->name == "Music Slider") { echo "Music"; } else { echo $deepChild->name; }?></a>
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