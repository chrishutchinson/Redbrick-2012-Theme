<!-- NAVBAR -->
<div id="nav-hole"></div>
<div id="nav">

	<ul class="full">
		<a href="<?php bloginfo('url') ?>"><li class="logo"></li></a>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block news">News</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block comment">Comment</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block sport">Sport</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block music">Music</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block arts">Arts</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block tech">Tech</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block travel">Travel</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block film">Film</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block tv">TV</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block lifestyle">Life&amp;Style</a></li>
		<li class="spacer"></li>
		<li class="link"><a href="#" class="block food">Food</a></li>
		<li class="spacer"></li>
		<li class="search">
			<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
				<input type="text" class="s-box" name="s" id="s" <?php if(is_search()) { ?>value="<?php the_search_query(); ?>" <?php } else { ?>value="Search Redbrick"<?php } ?> />
				<input type="image" class="button" id="searchsubmit" src="<?php bloginfo('template_directory'); ?>/images/search.png" />
			</form>
		</li>
		
		<li class="search-750">
			<input type="text" class="s-box" value="Search Redbrick" />
			<input type="image" class="button" src="<?php bloginfo('template_directory'); ?>/images/search.png" />
		</li>
	</ul>
	
	<ul class="mobile">
		<li class="logo"></li>
		<li class="link sections">Sections ▼</li>
		<li class="search">
			<input type="text" class="s-box" value="Search Redbrick" />
			<input type="image" class="button" src="<?php bloginfo('template_directory'); ?>/images/search.png" />
		</li>
	</ul>
	
</div>
<!-- END NAVBAR -->