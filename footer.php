<?php
/*
Theme: Redbrick 2012
Filename: footer.php
Author(s): Chris Hutchinson and Josh Holder
Date started: 09/08/2012, 23:56
Last updated: 09/08/2012 23:56
About: This is an entirely custom theme build during the redesign in advance of the academic year 2012/2013 for Redbrick, student media group at the University of Birmingham.
*/
?>

<!--  Start Footer -->

<div class="footer">

	<div class="column" id="column-1">
		<h1><img src="http://beta.redbrickpaper.co.uk/images/logo-big.png" style="width:40px; height:40px;" /></h1>
		<ul>
			<li>About</li>
			<li>The Team</li>
			<li>Letters to the Editors</li>
			<li>Latest Edition</li>
			<li>Join Redbrick</li>
			<li>Advertising</li>
		</ul>
	</div>
	<div class="column" id="column-2">
		<h1>Sections</h1>
		<ul>
			<li>Arts</li>
			<li>Comment</li>
			<li>Film</li>
			<li>Food</li>
			<li>Life&amp;Style</li>
			<li>Music</li>
			<li>News</li>
			<li>Sports</li>
			<li>Tech</li>
			<li>Travel</li>
			<li>TV</li>
		</ul>
	</div>
	<div class="column" id="column-3">
		<h1>Most Popular</h1>
		<ul>
			<li>Story 1</li>
			<li>Story 2</li>
			<li>Story 3</li>
			<li>Story 4</li>
			<li>Story 5</li>
			<li>Story 6</li>
		</ul>
	</div>
	<div class="column" id="column-4">
		<h1>Connect</h1>
		<ul>
			<li><a class="footer" href="http://www.facebook.com/redbrickpaper">Facebook</a></li>
			<li><a class="footer" href="http://www.twitter.com/redbrickpaper">Twitter</a></li>
			<li><a class="footer" href="http://www.pinterest.com/redbrickpaper">Pinterest</a></li>
			<li><a class="footer" href="http://www.youtube.com/redbrickpaper">YouTube</a></li>
			<li><a class="footer" href="http://www.flickr.com/redbrickpaper">Flickr</a></li>
			<li><a class="footer" href="http://www.spotify.com/redbrickpaper">Spotify</a></li>
		</ul>
	</div>

</div>

<!-- End Footer -->

<?php if(is_front_page() ) { ?>
<!-- Start Scripts -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script>

$(document).resize(function() {
	var second_height = $("#lead-2").css("height");
	if(second_height < 700)
	{		
	    $("#lead-2 .image").css({"height": second_height});
	    $("#wrt").css({"height": second_height});
	}
});

$(document).ready(function(){

	var menu = $('#nav');
	var init = $('#scrollable').css("height");
	var docked;
	
	var init = init.replace('px', '');
	
	$(window).resize(function() {
		var init = $('#scrollable').css("height");
		var init = init.replace('px', '');
	});
	
	$(window).scroll(function() {
		if (!docked && (menu.offset().top - $(window).scrollTop() < 0)) {
		    menu.css({"top": "0"});
		    menu.css({"position": "fixed"});
		    $('#ticker').css({"padding-top": "50px"});
		    menu.addClass("docked"); 
		    docked = true;
		} else if (docked && $(window).scrollTop() <= init) { 
			//menu.css({"top": init + 'px'});
		    menu.css({"position": ""}); 
		    $('#ticker').css({"padding-top": "0px"});
		    menu.removeClass("docked")
		    docked = false;  
		}
	});


	var first_height = $("#lead-1").css("height");
	$("#lead-1").css({"height": first_height});
	$("#lead-1 .image").css({"height": first_height});
	
	var second_height = $("#lead-2").css("height");
	$("#lead-2 .image").css({"height": second_height});
	
	$("#wrt").css({"height": second_height});
	
	
	
	
	var triple_height = $("#triple").css("height");
	var triple_num = triple_height.replace('px','');
	if(triple_num < 500)
	{
		$("#triple .content-750").css({"height": triple_height});
	}
	
	
	
	$("#s").focusin(function(){
		var value = $("#s").val();
		if(value == "Search Redbrick")
		{
			value = $("#s").val("");
		}
	})
	
	$("#s").focusout(function() {
		var value = $("#s").val();
		if(value == "")
		{
			value = $("#sw").val("Search Redbrick");
		}
	})
	
})

</script>

<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script src="http://beta.redbrickpaper.co.uk/scrollable.js"></script>
<script type="text/javascript">
$(function() {
var root = $("#scrollable").scrollable({circular: true}).autoscroll({ autoplay: true });
window.api = root.data("scrollable");
});
</script>
<script type="text/javascript">
window.onresize = function() {
	if(TO !== false)
    clearTimeout(TO);
    TO = setTimeout(resizeStuff, 200)
	var width = $(window).width();
	$('.scrollable').width(width);    
	var margins = ($(window).width() -1000)/2;
	
	if (margins > 0) {
		$('.scrollitems').width(1000);
			var newheight = 400;
				$('.scrollitems').css({'height' : newheight});	
	$('.scrollable').css({'height' : newheight});	
	$('.scrollitems').css({'marginLeft' : margins});
	$('.scrollitems').css({'marginRight' : -margins});	
	$('#leftgreybox').css({'width' : margins});
	$('#rightgreybox').css({'width' : margins});
	$('.logoslider').css({'left' : margins+10});	
	} else {
	var newheight = (width/1000)*400;
	$('.scrollitems').css({'height' : newheight});	
	$('.scrollable').css({'height' : newheight});	
	$('.scrollitems').width(width);
	$('.scrollitems').css({'marginLeft' : 0});
	$('.scrollitems').css({'marginRight' : 0});	
}
}

function resizeStuff() {
api.move(1);
}
var TO = false;

window.onload = function() {
	var width = $(window).width();
	$('.scrollable').width(width);    
	var margins = ($(window).width() -1000)/2;
	
	if (margins > 0) {
		$('.scrollitems').width(1000);
	$('.scrollitems').css({'marginLeft' : margins});
	$('.scrollitems').css({'marginRight' : -margins});	
	$('#leftgreybox').css({'width' : margins});
	$('#rightgreybox').css({'width' : margins});
		$('.logoslider').css({'left' : margins+10});		
	} else {
	var newheight = (width/1000)*400;
	$('.scrollitems').css({'height' : newheight});	
	api.seekTo(-1,1);
	$('.scrollable').css({'height' : newheight});	
	$('.scrollitems').width(width);
	$('.scrollitems').css({'marginLeft' : 0});
	$('.scrollitems').css({'marginRight' : 0});	
	
}
}
</script>

<script src="http://beta.redbrickpaper.co.uk/ticker/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$(".newsticker-jcarousellite").jCarouselLite({
		horizontal: true,
		hoverPause:true,
		visible: 1,
		auto:3000,
		speed:4000
	});
});

</script>

<!-- End Scripts --><? } ?>

</body>
</html>