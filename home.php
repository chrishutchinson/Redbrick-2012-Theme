<?php
/*
Theme: Redbrick 2012
Filename: home.php
Author(s): Chris Hutchinson and Josh Holder
Date started: 11/08/2012, 11:46
Last updated: 11/08/2012 11:46
About: This is an entirely custom theme build during the redesign in advance of the academic year 2012/2013.
*/
?>

<?php get_header(); ?>

<?php 
$options = get_option('plugin_options');
$lead_id = $options['lead_story_id'];
$lead_hashtag = $options['lead_story_hashtag'];
$lead_timeout = $options['lead_story_time'];
$lead_end = strtotime($lead_timeout);
$lead_end = $lead_end-3600;
$now = time();

$displayed = array();

//echo "Lead end: " . $lead_end . ", Now: " . $now;

if($now < $lead_end)
{
	//Not reached end time yet

	$lead_post = get_post( $lead_id );
	array_push($displayed, $lead_post->ID); //Add ID to diplayed posts to prevent repetition further down the homepage
	$lead_image = wp_get_attachment_image_src( get_post_thumbnail_id( $lead_post->ID ), 'single-post-thumbnail' );
	$lead_featured = $lead_image[0]; // Featured image URL //
	$lead_title = $lead_post->post_title;
	
	
	$show = 200;
	
	$lead_url = get_permalink($lead_post->ID);
	
	$lead_custom = get_post_custom( $lead_post->ID );
	
	$siblings = $lead_custom['siblings'];
	if($siblings == "")
	{
		$no_siblings = "1";
	}
	else
	{
		foreach ( $siblings as $key => $value )
		{
		   $siblings = $value;
		}
		$siblings = str_replace(" ", "", $siblings);
		$siblings = explode(",", $siblings);
	}
	
	$cousins = $lead_custom['cousins'];
	if($cousins == "")
	{
		$no_cousins = "1";
	}
	else
	{
		foreach ( $cousins as $key => $value )
		{
		   $cousins = $value;
		}
		$cousins = str_replace(" ", "", $cousins);
		$cousins = explode(",", $cousins);
	}
	
	if($no_siblings == "1")
	{
		//no siblings, add 100
		$show = $show+100;
	}
	
	if($no_cousins == "1")
	{
		//no cousins, add 100
		$show = $show+100;
	}
	
	$updated = $lead_custom['updated'];
	$new = $lead_custom['new'];
	$breaking = $lead_custom['breaking'];
	$live = $lead_custom['live'];
	
	$buttons = "";
	
	if($updated[0] == "1")
	{
		$buttons = $buttons . '<span class="tag updated">Updated</span> ';
	}
	
	if($live[0] == "1")
	{
		$buttons = $buttons . '<span class="tag live">Live</span> ';
	}
	
	if($new[0] == "1")
	{
		$buttons = $buttons . '<span class="tag new">New</span> ';
	}
	
	if($breaking[0] == "1")
	{
		$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
	}
	
	$lead_excerpt = $lead_post->post_excerpt;
	
	if($lead_excerpt == "")
	{
		//No excerpt set, trim post content.
		$lead_content = $lead_post->post_content;
		$lead_excerpt = substr($lead_content, 0, $show);
	}
	?>
	
	<!-- LEAD STORY #1 -->
	<div class="content w-1000 lead">
	
	<div class="blank-content no-shadow w-1000 no-margin" id="lead-1">
	
		<div class="image w-500" style="background-image:url(<?php echo $lead_featured ?>)">
			
			<span class="hashtag" style="background-color:rgba(101,172,144,0.8);"><? echo $lead_hashtag ?></span>
			
		</div>
		
		<div class="text w-500">
			
			<h1><?php echo $buttons ?> <a href="<?php echo $lead_url ?>"><?php echo $lead_title ?></a></h1>
			<p><?php echo $lead_excerpt ?>...</p>
			
			<?php
			if($no_siblings != "1")
			{
				foreach($siblings as $sibling_id)
				{
					$sibling_post = get_post( $sibling_id );
						
					array_push($displayed, $sibling_id); //Add ID to diplayed posts to prevent repetition further down the homepage
					
					$sibling_url = get_permalink($sibling_id);
					
					$sibling_custom = get_post_custom( $sibling_post->ID );
		
					$lives = $sibling_custom['live'];
					
					$live = $lives[0];
					
					?>
					<h2>
					<?
					if($live == "1")
					{
						?>
						<div class="live">Live ►</div>
						<?
					}
					?>
					<a href="<?php echo $sibling_url ?>"><?php echo $sibling_post->post_title ?></a></h2>
					<?
				}
			}
			?>
	
			<?php
			if($no_cousins != "1")
			{
				foreach($cousins as $cousin_id)
				{
					$cousin_post = get_post( $cousin_id );
					
					array_push($displayed, $cousin_id); //Add ID to diplayed posts to prevent repetition further down the homepage
					
					$cousin_url = get_permalink($cousin_id);
					
					$cousin_custom = get_post_custom( $cousin_post->ID );
		
					$hashtags = $cousin_custom['hashtag'];
					
					$hashtag = $hashtags[0];
					
					$hashtag = str_replace("#", "", $hashtag);
					
					$comment_count = $cousin_post->comment_count;
					if($comment_count == "1")
					{
						$comment_phrase = "Comment";
					}
					else
					{
						$comment_phrase = "Comments";
					}
					?>
					<h2><a href="<?php echo $cousin_url ?>"><?php echo $cousin_post->post_title ?></a></h2>
					<h3><?php echo $cousin_post->comment_count . " " . $comment_phrase; ?>
					<?php
					if($hashtag == "")
					{
						//no hashtag provided, don't display
					}
					else
					{
						?>
						| <img src="<?php bloginfo('template_directory'); ?>/images/twitter-bird.png" /> <span class="twitter"><a href="https://twitter.com/#!/search/realtime/%23<?php echo $hashtag ?>" class="twitter" target="_blank">#<?php echo $hashtag ?></a></span></h3>
						<?
					}
				}
			}
			?>
			
			<!--<div class="photos"></div>-->
					
		</div>
	
	</div>
	
	<div class="content no-shadow w-1000 no-margin b-top more-top" style="z-index:998;">
	
		<div class="text w-1000" style="padding-bottom:0px !important;">
			<h3>MORE TOP STORIES</h3>
		</div>
		
	</div>
	
	<div class="content no-shadow no-margin w-500 more-top" style="z-index:98;">
	
		<div class="text w-500">
			<?php
			$more_category = $options['more_category'];
			$show = "2";
			
			$first_row = array(); //Wordpress takes into account ignored posts even when they are offset in the query, so these will be added to $displayed after the entire "More Top Posts" loop
			?>
			<?php
			$args = array(
				'cat' => $more_category,
				'posts_per_page' => $show,
				'post__not_in' => $displayed
			);
			?>
			<?php $the_query = new WP_Query( $args ); // Query category ID ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php
				$url = get_permalink();
				
				array_push($first_row, $post->ID); //Add ID to diplayed posts to prevent repetition further down the homepage
					
				$category = get_the_category($post->ID); 
				$main_category_name = $category[0]->cat_name;
				$main_category_id = $category[0]->cat_ID;
				
				$custom = get_post_custom( $post->ID );
				
				$updated = $custom['updated'];
				$new = $custom['new'];
				$breaking = $custom['breaking'];
				$live = $custom['live'];
				
				$buttons = "";
				
				if($updated[0] == "1")
				{
					$buttons = $buttons . '<span class="tag updated">Updated</span> ';
				}
				
				if($live[0] == "1")
				{
					$buttons = $buttons . '<span class="tag live">Live</span> ';
				}
				
				if($new[0] == "1")
				{
					$buttons = $buttons . '<span class="tag new">New</span> ';
				}
				
				if($breaking[0] == "1")
				{
					$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
				}

				if($main_category_id == $more_category)
				{
					$main_category_name = $category[1]->cat_name;
					$main_category_id = $category[1]->cat_ID;
					if($main_category_name == "")
					{
						$main_category_name = $category[0]->cat_name;
						$main_category_id = $category[0]->cat_ID;
					}
				}
				
				if (function_exists('get_terms_meta'))
				{
				    $cat_icon = get_terms_meta($main_category_id, "icon");
				}
				?>
			
				<h2><!--<img src="<?php bloginfo('template_directory'); ?>/images/icons/<?php echo $cat_icon[0] ?>" style="width:15px; height:15px;" /> --><?php echo $buttons ?> <a href="<?php echo $url ?>"><?php echo get_the_title() ?></a></h2>
				
			<?php endwhile; ?>
	
			<?php
			// Reset Post Data
			wp_reset_postdata();
			?>
		
		</div>
	
	</div>
	
	<div class="content no-shadow no-margin w-500 more-top">
	
		<div class="text w-500">
		
			<?php
			
			$second_row = array(); //Wordpress takes into account ignored posts even when they are offset in the query, so these will be added to $displayed after the entire "More Top Posts" loop
			
			$args = array(
				'cat' => $more_category,
				'post__not_in' => $displayed,
				'posts_per_page' => $show,
				'offset' => $show
			);
			?>
			<?php $the_query = new WP_Query( $args ); // Query category ID ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php
				
				array_push($second_row, $post->ID); //Add ID to diplayed posts to prevent repetition further down the homepage
				
				$url = get_permalink();
				
				$custom = get_post_custom( $post->ID );
				
				$updated = $custom['updated'];
				$new = $custom['new'];
				$breaking = $custom['breaking'];
				$live = $custom['live'];
				
				$buttons = "";
				
				if($updated[0] == "1")
				{
					$buttons = $buttons . '<span class="tag updated">Updated</span> ';
				}
				
				if($live[0] == "1")
				{
					$buttons = $buttons . '<span class="tag live">Live</span> ';
				}
				
				if($new[0] == "1")
				{
					$buttons = $buttons . '<span class="tag new">New</span> ';
				}
				
				if($breaking[0] == "1")
				{
					$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
				}
				?>
			
				<h2><?php echo $buttons ?> <a href="<?php echo $url ?>"><?php echo get_the_title() ?></a></h2>

				
			<?php endwhile; ?>
	
			<?php
			// Reset Post Data
			wp_reset_postdata();
			?>
		
		</div>
	
	</div>
	
	</div>
	
	<?
	$displayed = array_merge($displayed, $first_row);
	$displayed = array_merge($displayed, $second_row);
	?>
	<!-- END LEAD STORY #1 -->
	<?
}
else
{
	//Timeout has been reached, display auto top stories

	$more_category = $options['more_category'];
	$show = "1"; //Just main story
	$args = array(
		'cat' => $more_category,
		'posts_per_page' => $show
	);
	
	
	
	$displayed = array();
	
	$the_query = new WP_Query( $args ); // Query category ID 
	?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<?php
		$url = get_permalink();
		
		$lead_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$lead_featured = $lead_image[0]; // Featured image URL //
		$lead_title = $post->post_title;
		
		
		$show = 200;
		
		$lead_url = get_permalink($post->ID);
		
		$lead_custom = get_post_custom( $post->ID );
		
		$siblings = $lead_custom['siblings'];
		if($siblings == "")
		{
			$no_siblings = "1";
		}
		else
		{
			foreach ( $siblings as $key => $value )
			{
			   $siblings = $value;
			}
			$siblings = str_replace(" ", "", $siblings);
			$siblings = explode(",", $siblings);
		}
		
		$cousins = $lead_custom['cousins'];
		if($cousins == "")
		{
			$no_cousins = "1";
		}
		else
		{
			foreach ( $cousins as $key => $value )
			{
			   $cousins = $value;
			}
			$cousins = str_replace(" ", "", $cousins);
			$cousins = explode(",", $cousins);
		}
		
		if($no_siblings == "1")
		{
			//no siblings, add 100
			$show = $show+100;
		}
		
		if($no_cousins == "1")
		{
			//no cousins, add 100
			$show = $show+100;
		}
		
		array_push($displayed, $post->ID); //Add ID to diplayed posts to prevent repetition further down the homepage
			
		$category = get_the_category($post->ID); 
		$main_category_name = $category[0]->cat_name;
		$main_category_id = $category[0]->cat_ID;
		
		$custom = get_post_custom( $post->ID );
		
		$updated = $custom['updated'];
		$new = $custom['new'];
		$breaking = $custom['breaking'];
		$live = $custom['live'];
		
		$buttons = "";
		
		if($updated[0] == "1")
		{
			$buttons = $buttons . '<span class="tag updated">Updated</span> ';
		}
		
		if($live[0] == "1")
		{
			$buttons = $buttons . '<span class="tag live">Live</span> ';
		}
		
		if($new[0] == "1")
		{
			$buttons = $buttons . '<span class="tag new">New</span> ';
		}
		
		if($breaking[0] == "1")
		{
			$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
		}
	
		if($main_category_id == $more_category)
		{
			$main_category_name = $category[1]->cat_name;
			$main_category_id = $category[1]->cat_ID;
			if($main_category_name == "")
			{
				$main_category_name = $category[0]->cat_name;
				$main_category_id = $category[0]->cat_ID;
			}
		}
		
		if (function_exists('get_terms_meta'))
		{
		    $cat_icon = get_terms_meta($main_category_id, "icon");
		}
		
		$lead_excerpt = $post->post_excerpt;
		
		if($lead_excerpt == "")
		{
			//No excerpt set, trim post content.
			$lead_content = $post->post_content;
			$lead_excerpt = substr(strip_tags($lead_content), 0, $show);
		}
		?>
		<div class="content w-1000 lead">
	
		<div class="blank-content no-shadow w-1000 no-margin" id="lead-1">
	
		<div class="image w-500" style="background-image:url(<?php echo $lead_featured ?>)">
			
		</div>
		
		<div class="text w-500">
			
			<h1><?php echo $buttons ?> <a href="<?php echo $lead_url ?>"><?php echo $lead_title ?></a></h1>
			<p><?php echo $lead_excerpt ?>...</p>
			
			<?php
			if($no_siblings != "1")
			{
				foreach($siblings as $sibling_id)
				{
					$sibling_post = get_post( $sibling_id );
						
					array_push($displayed, $sibling_id); //Add ID to diplayed posts to prevent repetition further down the homepage
					
					$sibling_url = get_permalink($sibling_id);
					
					$sibling_custom = get_post_custom( $sibling_post->ID );
		
					$lives = $sibling_custom['live'];
					
					$live = $lives[0];
					
					?>
					<h2>
					<?
					if($live == "1")
					{
						?>
						<div class="live">Live ►</div>
						<?
					}
					?>
					<a href="<?php echo $sibling_url ?>"><?php echo $sibling_post->post_title ?></a></h2>
					<?
				}
			}
			?>
	
			<?php
			if($no_cousins != "1")
			{
				foreach($cousins as $cousin_id)
				{
					$cousin_post = get_post( $cousin_id );
					
					array_push($displayed, $cousin_id); //Add ID to diplayed posts to prevent repetition further down the homepage
					
					$cousin_url = get_permalink($cousin_id);
					
					$cousin_custom = get_post_custom( $cousin_post->ID );
		
					$hashtags = $cousin_custom['hashtag'];
					
					$hashtag = $hashtags[0];
					
					$hashtag = str_replace("#", "", $hashtag);
					
					$comment_count = $cousin_post->comment_count;
					if($comment_count == "1")
					{
						$comment_phrase = "Comment";
					}
					else
					{
						$comment_phrase = "Comments";
					}
					?>
					<h2><a href="<?php echo $cousin_url ?>"><?php echo $cousin_post->post_title ?></a></h2>
					<h3><?php echo $cousin_post->comment_count . " " . $comment_phrase; ?>
					<?php
					if($hashtag == "")
					{
						//no hashtag provided, don't display
					}
					else
					{
						?>
						| <img src="<?php bloginfo('template_directory'); ?>/images/twitter-bird.png" /> <span class="twitter"><a href="https://twitter.com/#!/search/realtime/%23<?php echo $hashtag ?>" class="twitter" target="_blank">#<?php echo $hashtag ?></a></span></h3>
						<?
					}
				}
			}
			?>
			
			<!--<div class="photos"></div>-->
					
		</div>
	
		</div>
	<?php endwhile; ?>
	
	<?php
	// Reset Post Data
	wp_reset_postdata();
	


	array_push($displayed, $lead_post->ID); //Add ID to diplayed posts to prevent repetition further down the homepage
	$lead_image = wp_get_attachment_image_src( get_post_thumbnail_id( $lead_post->ID ), 'single-post-thumbnail' );
	$lead_featured = $lead_image[0]; // Featured image URL //
	$lead_title = $lead_post->post_title;
	
	
	$show = 200;
	
	$lead_url = get_permalink($lead_post->ID);
	
	$lead_custom = get_post_custom( $lead_post->ID );
	
	$siblings = $lead_custom['siblings'];
	if($siblings == "")
	{
		$no_siblings = "1";
	}
	else
	{
		foreach ( $siblings as $key => $value )
		{
		   $siblings = $value;
		}
		$siblings = str_replace(" ", "", $siblings);
		$siblings = explode(",", $siblings);
	}
	
	$cousins = $lead_custom['cousins'];
	if($cousins == "")
	{
		$no_cousins = "1";
	}
	else
	{
		foreach ( $cousins as $key => $value )
		{
		   $cousins = $value;
		}
		$cousins = str_replace(" ", "", $cousins);
		$cousins = explode(",", $cousins);
	}
	
	if($no_siblings == "1")
	{
		//no siblings, add 100
		$show = $show+100;
	}
	
	if($no_cousins == "1")
	{
		//no cousins, add 100
		$show = $show+100;
	}
	
	$updated = $lead_custom['updated'];
	$new = $lead_custom['new'];
	$breaking = $lead_custom['breaking'];
	$live = $lead_custom['live'];
	
	$buttons = "";
	
	if($updated[0] == "1")
	{
		$buttons = $buttons . '<span class="tag updated">Updated</span> ';
	}
	
	if($live[0] == "1")
	{
		$buttons = $buttons . '<span class="tag live">Live</span> ';
	}
	
	if($new[0] == "1")
	{
		$buttons = $buttons . '<span class="tag new">New</span> ';
	}
	
	if($breaking[0] == "1")
	{
		$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
	}
	
	$lead_excerpt = $lead_post->post_excerpt;
	
	if($lead_excerpt == "")
	{
		//No excerpt set, trim post content.
		$lead_content = $lead_post->post_content;
		$lead_excerpt = substr($lead_content, 0, $show);
	}
	?>
	
	<!-- LEAD STORY #1 -->
	
	
	
	
	<div class="content no-shadow w-1000 no-margin b-top" style="z-index:998;">
	
		<div class="text w-1000" style="padding-bottom:0px !important;">
			<h3>MORE TOP STORIES</h3>
		</div>
		
	</div>
	
	<div class="content no-shadow no-margin w-500 " style="z-index:98;">
	
		<div class="text w-500">
			<?php
			$more_category = $options['more_category'];
			$show = "2";
			
			$first_row = array(); //Wordpress takes into account ignored posts even when they are offset in the query, so these will be added to $displayed after the entire "More Top Posts" loop
			?>
			<?php
			$args = array(
				'cat' => $more_category,
				'posts_per_page' => $show,
				'post__not_in' => $displayed
			);
			?>
			<?php $the_query = new WP_Query( $args ); // Query category ID ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php
				$url = get_permalink();
				
				array_push($first_row, $post->ID); //Add ID to diplayed posts to prevent repetition further down the homepage
					
				$category = get_the_category($post->ID); 
				$main_category_name = $category[0]->cat_name;
				$main_category_id = $category[0]->cat_ID;
				
				$custom = get_post_custom( $post->ID );
				
				$updated = $custom['updated'];
				$new = $custom['new'];
				$breaking = $custom['breaking'];
				$live = $custom['live'];
				
				$buttons = "";
				
				if($updated[0] == "1")
				{
					$buttons = $buttons . '<span class="tag updated">Updated</span> ';
				}
				
				if($live[0] == "1")
				{
					$buttons = $buttons . '<span class="tag live">Live</span> ';
				}
				
				if($new[0] == "1")
				{
					$buttons = $buttons . '<span class="tag new">New</span> ';
				}
				
				if($breaking[0] == "1")
				{
					$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
				}

				if($main_category_id == $more_category)
				{
					$main_category_name = $category[1]->cat_name;
					$main_category_id = $category[1]->cat_ID;
					if($main_category_name == "")
					{
						$main_category_name = $category[0]->cat_name;
						$main_category_id = $category[0]->cat_ID;
					}
				}
				
				if (function_exists('get_terms_meta'))
				{
				    $cat_icon = get_terms_meta($main_category_id, "icon");
				}
				?>
			
				<h2><!--<img src="<?php bloginfo('template_directory'); ?>/images/icons/<?php echo $cat_icon[0] ?>" style="width:15px; height:15px;" /> --><?php echo $buttons ?> <a href="<?php echo $url ?>"><?php echo get_the_title() ?></a></h2>
				
			<?php endwhile; ?>
	
			<?php
			// Reset Post Data
			wp_reset_postdata();
			?>
		
		</div>
	
	</div>
	
	<div class="content no-shadow no-margin w-500">
	
		<div class="text w-500">
		
			<?php
			
			$second_row = array(); //Wordpress takes into account ignored posts even when they are offset in the query, so these will be added to $displayed after the entire "More Top Posts" loop
			
			$args = array(
				'cat' => $more_category,
				'post__not_in' => $displayed,
				'posts_per_page' => $show,
				'offset' => $show
			);
			?>
			<?php $the_query = new WP_Query( $args ); // Query category ID ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php
				
				array_push($second_row, $post->ID); //Add ID to diplayed posts to prevent repetition further down the homepage
				
				$url = get_permalink();
				
				$custom = get_post_custom( $post->ID );
				
				$updated = $custom['updated'];
				$new = $custom['new'];
				$breaking = $custom['breaking'];
				$live = $custom['live'];
				
				$buttons = "";
				
				if($updated[0] == "1")
				{
					$buttons = $buttons . '<span class="tag updated">Updated</span> ';
				}
				
				if($live[0] == "1")
				{
					$buttons = $buttons . '<span class="tag live">Live</span> ';
				}
				
				if($new[0] == "1")
				{
					$buttons = $buttons . '<span class="tag new">New</span> ';
				}
				
				if($breaking[0] == "1")
				{
					$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
				}
				?>
			
				<h2><?php echo $buttons ?> <a href="<?php echo $url ?>"><?php echo get_the_title() ?></a></h2>

				
			<?php endwhile; ?>
	
			<?php
			// Reset Post Data
			wp_reset_postdata();
			?>
		
		</div>
	
	</div>
	
	</div>
	
	<?
	$displayed = array_merge($displayed, $first_row);
	$displayed = array_merge($displayed, $second_row);
	?>
	<!-- END LEAD STORY #1 -->
	<?
}
?>

<!-- ROW 2 HOLDER -->
<div class="blank-content-padding w-1000">

	
	<?php
	$second_lead_id = $options['second_lead_story_id'];
	$second_lead_hashtag = $options['second_lead_story_hashtag'];
	$second_lead_timeout = $options['second_lead_story_time'];
	$second_lead_end = strtotime($second_lead_timeout);
	$second_lead_end = $second_lead_end-3600;
	$now = time();
	
	if($now < $second_lead_end)
	{
		//Not reached end time yet
		$second_lead_post = get_post( $second_lead_id );
		$second_lead_image = wp_get_attachment_image_src( get_post_thumbnail_id( $second_lead_post->ID ), 'single-post-thumbnail' );
		
		$second_lead_featured = $second_lead_image[0]; // Featured image URL //
		$second_lead_title = $second_lead_post->post_title;
		
		
		$second_lead_url = get_permalink($second_lead_post->ID);
		
		$second_lead_custom = get_post_custom( $second_lead_post->ID );
		
		$second_siblings = $second_lead_custom['siblings'];
		if($second_siblings == "")
		{
			$second_no_siblings = "1";
		}
		else
		{
			foreach ( $second_siblings as $key => $value )
			{
			   $second_siblings = $value;
			}
			$second_siblings = str_replace(" ", "", $second_siblings);
			$second_siblings = explode(",", $second_siblings);
		}
		
		$second_cousins = $second_lead_custom['cousins'];
		if($second_cousins == "")
		{
			$second_no_cousins = "1";
		}
		else
		{
			foreach ( $second_cousins as $key => $value )
			{
			   $second_cousins = $value;
			}
			$second_cousins = str_replace(" ", "", $second_cousins);
			$second_cousins = explode(",", $second_cousins);
		}
		
		if($second_no_cousins == "1")
		{
			//no cousins, add 180 chars
			$add = $add + 180;
		}
		
		if($second_no_siblings == "1")
		{
			//no siblings, add 180 chars
			$add = $add + 180;
		}
		$second_lead_excerpt = $second_lead_post->post_excerpt;
		if($second_lead_excerpt == "")
		{
			//No excerpt set, trim post content.
			$trim = $add + 100;
			$second_lead_content = $second_lead_post->post_content;
			$second_lead_excerpt = substr($second_lead_content, 0, $trim);
		}
		
		$custom = get_post_custom( $second_lead_post->ID );
		
		$updated = $custom['updated'];
		$new = $custom['new'];
		$breaking = $custom['breaking'];
		$live = $custom['live'];
		
		$buttons = "";
		
		if($updated[0] == "1")
		{
			$buttons = $buttons . '<span class="tag updated">Updated</span> ';
		}
		
		if($live[0] == "1")
		{
			$buttons = $buttons . '<span class="tag live">Live</span> ';
		}
		
		if($new[0] == "1")
		{
			$buttons = $buttons . '<span class="tag new">New</span> ';
		}
		
		if($breaking[0] == "1")
		{
			$buttons = $buttons . '<span class="tag breaking">Breaking</span> ';
		}
		?>
		<!-- LEAD STORY #2 -->
		<div class="content w-600 lead left" id="lead-2">
		
			<div class="image w-300" style="background-image:url(<?php echo $second_lead_featured ?>)">
				
				<span class="hashtag" style="background-color:rgba(167, 74, 52 ,0.8);"><?php echo $second_lead_hashtag ?></span>
				
			</div>
			
			<div class="text w-300">
				
				<h1><?php echo $buttons ?> <a href="<?php echo $second_lead_url ?>"><?php echo $second_lead_title ?></a></h1>
				<p><?php echo $second_lead_excerpt ?></p>
				
				<?php
				if($second_no_siblings != "1")
				{
					foreach($second_siblings as $second_sibling_id)
					{
						$second_sibling_post = get_post( $second_sibling_id );
						
						$second_sibling_url = get_permalink($second_sibling_id);
						
						$second_sibling_custom = get_post_custom( $second_sibling_post->ID );
			
						$second_lives = $second_sibling_custom['live'];
						
						$second_live = $second_lives[0];
						
						?>
						<h2>
						<?
						if($second_live == "1")
						{
							?>
							<div class="live">Live ►</div>
							<?
						}
						?>
						<a href="<?php echo $second_sibling_url ?>"><?php echo $second_sibling_post->post_title ?></a></h2>
						<?
					}
				}
				?>
		
				<?php
				if($second_no_cousins != "1")
				{
					foreach($second_cousins as $second_cousin_id)
					{
						$second_cousin_post = get_post( $second_cousin_id );
						
						$second_cousin_url = get_permalink($second_cousin_id);
						
						$second_cousin_custom = get_post_custom( $second_cousin_post->ID );
			
						$second_hashtags = $second_cousin_custom['hashtag'];
						
						$second_hashtag = $second_hashtags[0];
						
						$second_hashtag = str_replace("#", "", $second_hashtag);
					
						?>
						<h2><a href="<?php echo $second_cousin_url ?>"><?php echo $second_cousin_post->post_title ?></a></h2>
						<h3><?php echo $second_cousin_post->comment_count ?> Comments
						<?php
						if($second_hashtag == "")
						{
							//no hashtag provided, don't display
						}
						else
						{
							?>
							| <img src="<?php bloginfo('template_directory'); ?>/images/twitter-bird.png" /> <span class="twitter"><a href="https://twitter.com/#!/search/realtime/%23<?php echo $second_hashtag ?>" class="twitter" target="_blank">#<?php echo $second_hashtag ?></a></span></h3>
							<?
						}
					}
				}
				?>
						
			</div>
		
		</div>
		<!-- END LEAD STORY #2 -->
		<?
	}
	?>
	
	
	<!-- WORTH READING TODAY -->
	<div class="content w-380 right" id="wrt">
	
		<div class="text w-380 align-r">
			
			<h1>Worth<br />Reading<br /><span class="wrt-pink">Today</span><br /><br /></h1>
			<?php
			
			$wrt_1 = $options['wrt_id_1'];
			$wrt_1_post = get_post( $wrt_1 );
			$wrt_1_url = get_permalink($wrt_1_post->ID);
			
			$wrt_2 = $options['wrt_id_2'];
			$wrt_2_post = get_post( $wrt_2 );
			$wrt_2_url = get_permalink($wrt_2_post->ID);
			
			$wrt_3 = $options['wrt_id_3'];
			$wrt_3_post = get_post( $wrt_3 );
			$wrt_3_url = get_permalink($wrt_3_post->ID);
			
			?>
			<p class="wrt"><a href="<?php echo $wrt_1_url ?>"><?php echo $wrt_1_post->post_title ?></a></p>
			<p class="wrt"><a href="<?php echo $wrt_2_url ?>"><?php echo $wrt_2_post->post_title ?></a></p>
			<p class="wrt"><a href="<?php echo $wrt_3_url ?>"><?php echo $wrt_3_post->post_title ?></a></p>
				
		</div>
	
	</div>
	<!-- END WORTH READING TODAY -->

</div>
<!-- END ROW 2 HOLDER -->

<!-- ROW 3 HOLDER -->

<div class="blank-content w-1000 shadow" id="triple">	
	<?php
	$triple_category = $options['triple_category'];
	
	$args = array(
		'cat' => $triple_category,
		'posts_per_page' => "3",
		'post__not_in' => $displayed
	);
	
	$the_query = new WP_Query( $args ); // Query category ID 
	$x = "1";
  	while ( $the_query->have_posts() ) : $the_query->the_post();

  	if (has_post_thumbnail( $post->ID ) )
  	{
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$featured = $image[0]; // Featured image URL //
	}
	else
	{
		$featured = ""; // Fallback image if there is none supplied //
	}
	
	if($x == "3")
  	{
		$width = "w-34-per";
	}
	else
	{
		$width = "w-33-per";
	}
	
	$post_custom = get_post_custom( $post->ID );
	if($post_custom['video'][0] == "1")
	{
		$watch = '<span class="hashtag" style="background-color:rgba(0,0,0,0.8);">Watch This</span>';
	}
	else
	{
		$watch = "";
	}
	
	$episode = $post_custom['episode_number'];
	if($episode[0] == "")
	{
		$ep = "";
	}
	else
	{
		$ep = "Episode " . $episode[0] . " | ";
	}
	
	$twitter_author = $post_custom['twitter_author'];
	if($twitter_author[0] == "")
	{
		$i = new CoAuthorsIterator();
		$i->iterate();
		
		$id = get_the_author_ID();
		$link = get_author_posts_url($id);
		
		$auth = "<a href=" . $link . ">" . get_the_author() . "</a>";
		while($i->iterate()){
		    $separator = $i->is_last() ? ' and ' : ', ';
		    
		    $id = get_the_author_ID();
		    $link = get_author_posts_url($id);
		    
		    $auth = $auth . $separator . "<a href=" . $link . ">" . get_the_author() . "</a>";
		    
		}
		$author = get_the_date('jS F Y') . " | " . $auth;
	}
	else
	{
		$author = '<img src="' . get_bloginfo('template_directory') . '/images/twitter-bird.png" /> <span class="twitter"><a href="http://www.twitter.com/' . str_replace("@", "", $twitter_author[0]) . '" class="twitter" target="_blank">' . $twitter_author[0] . '</a></span>';
	}
	
	
	$triple_title = $post->post_title;
		
	$triple_url = get_permalink($post->ID);
	
	$category = get_the_category($post->ID); 
	$main_category_name = $category[0]->cat_name;
	$main_category_id = $category[0]->cat_ID;
	
	if($main_category_id == $triple_category)
	{
		$main_category_name = $category[1]->cat_name;
		$main_category_id = $category[1]->cat_ID;
		if($main_category_name == "")
		{
			$main_category_name = $category[0]->cat_name;
			$main_category_id = $category[0]->cat_ID;
		}
	}
	
	if (function_exists('get_terms_meta'))
	{
	    $cat_colour = get_terms_meta($main_category_id, "colour");
	}
	?>
	
	<div class="content-750 no-margin no-shadow <?php echo $width ?>">
		
		<div class="image w-100-per h-200" style="background-image:url(<?php echo $featured ?>)">
			
			<?php echo $watch ?>
			
		</div>
		
		<div class="text w-100-per">
			
			<h2 style="color:#<?php echo $cat_colour[0] ?>"><?php echo $main_category_name ?></h2>
			
			<h1><a href="<?php echo $triple_url ?>"><?php echo $triple_title ?></a></h1>
			<h3><? echo $ep ?><?php echo $author ?></h3>
					
		</div>
		
	</div>
	
	<?php $x++; ?>
	
	<?php endwhile; ?>
	
	<?php
	// Reset Post Data
	wp_reset_postdata();
	?>

</div>

<!-- END ROW 3 HOLDER -->

<?php get_footer() ?>