<!-- Start Slider -->
<div class="scrollable" id="scrollable" >
<div class="logoslider"><a href="<?php bloginfo('url') ?>" class="logohover"><img src="<?php bloginfo('template_directory'); ?>/images/logoslider.png" style="width: 143px; height:34px;"></a></div><div id="leftgreybox"><div class="left-space"><a class="prev browse left-space"><img src="<?php bloginfo('template_directory'); ?>/images/left.png"></a></div></div>
<div id="rightgreybox"><div class="right-space"><a class="next browse right-space"><img src="<?php bloginfo('template_directory'); ?>/images/right.png"></a></div></div>
 
  <div class="items">
  	<?php
  	$options = get_option('plugin_options');
	$slider_category = $options['slider_category'];
	$items_in_slider = $options['items_in_slider'];
	?>
  	<?php $the_query = new WP_Query( 'cat=' . $slider_category . '&posts_per_page=' . $items_in_slider ); // Query slider category ID ?>
  	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

  	<?php if (has_post_thumbnail( $post->ID ) ): ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
	<?php $featured = $image[0]; // Featured image URL // ?>
	<?php else: ?>
	<?php $featured = "" // Fallback image if there is none supplied // ?>
	<?php endif; ?>
	<?php
	$excerpt = get_the_excerpt();
	if(strlen($excerpt) > 60)
	{
		$excerpt = preg_replace('/\s+?(\S+)?$/', '', substr($excerpt, 0, 100)) . "...";
	}
	?>
	<div class="scrollitems" style="background-image: url(<?php echo $featured ?>);">
    	<span class="scrollitemtitle"><?php echo get_the_title() ?></span> <br><span class="scrollitemdescription"><?php echo $excerpt; ?></span>   	
    </div> 
	
	<?php endwhile; ?>
	
	<?php
	// Reset Post Data
	wp_reset_postdata();
	?>
	
  </div>
    
</div>
<!-- End Slider -->