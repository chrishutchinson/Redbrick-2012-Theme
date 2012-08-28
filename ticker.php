<?php

$options = get_option('plugin_options');

$ticker_enable = $options['ticker_enable'];
$ticker_username = $options['ticker_username'];
/*
    Parse Twitter Feeds
    based on code from http://spookyismy.name/old-entries/2009/1/25/latest-twitter-update-with-phprss-part-three.html
    and cache code from http://snipplr.com/view/8156/twitter-cache/
    and other cache code from http://wiki.kientran.com/doku.php?id=projects:twitterbadge
*/
function parse_cache_feed($usernames, $limit) {
    $username_for_feed = str_replace(" ", "+OR+from%3A", $usernames);
    $feed = "http://search.twitter.com/search.atom?q=from%3A" . $username_for_feed . "&rpp=" . $limit;
    $usernames_for_file = str_replace(" ", "-", $usernames);
    $cache_file = dirname(__FILE__).'/cache/' . $usernames_for_file . '-twitter-cache';
    $last = filemtime($cache_file);
    $now = time();
    $interval = 600; // ten minutes
    // check the cache file
    if ( !$last || (( $now - $last ) > $interval) ) {
        // cache file doesn't exist, or is old, so refresh it
        $cache_rss = file_get_contents($feed);
        if (!$cache_rss) {
            // we didn't get anything back from twitter
            echo "<!-- ERROR: Twitter feed was blank! Using cache file. -->";
        } else {
            // we got good results from twitter
            echo "<!-- SUCCESS: Twitter feed used to update cache file -->";
            $cache_static = fopen($cache_file, 'wb');
            fwrite($cache_static, serialize($cache_rss));
            fclose($cache_static);
        }
        // read from the cache file
        $rss = @unserialize(file_get_contents($cache_file));
    }
    else {
        // cache file is fresh enough, so read from it
        echo "<!-- SUCCESS: Cache file was recent enough to read from -->";
        $rss = @unserialize(file_get_contents($cache_file));
    }
    // clean up and output the twitter feed
    $feed = str_replace("&amp;", "&", $rss);
    $feed = str_replace("&lt;", "<", $feed);
    $feed = str_replace("&gt;", ">", $feed);
    $clean = explode("<entry>", $feed);
    $clean = str_replace("&quot;", "'", $clean);
    $clean = str_replace("&apos;", "'", $clean);
    $amount = count($clean) - 1;
    if ($amount) { // are there any tweets?
        for ($i = 1; $i <= $amount; $i++) {
            $entry_close = explode("</entry>", $clean[$i]);
            $clean_content_1 = explode("<content type=\"html\">", $entry_close[0]);
            $clean_content = explode("</content>", $clean_content_1[1]);
            $clean_name_2 = explode("<name>", $entry_close[0]);
            $clean_name_1 = explode("(", $clean_name_2[1]);
            $clean_name = explode(")</name>", $clean_name_1[1]);
            $clean_user = explode(" (", $clean_name_2[1]);
            $clean_lower_user = strtolower($clean_user[0]);
            $clean_uri_1 = explode("<uri>", $entry_close[0]);
            $clean_uri = explode("</uri>", $clean_uri_1[1]);
            $clean_time_1 = explode("<published>", $entry_close[0]);
            $clean_time = explode("</published>", $clean_time_1[1]);
            $unix_time = strtotime($clean_time[0]);
            ?>
                
                        <li>
                            <div class="info"><a href="<? echo $clean_uri[0] ?>" target="_blank"><? echo $clean_content[0] ?></a></div>
                        </li>
                        
				<?php
		}
              
    } else { // if there aren't any tweets
    /*

require_once 'rss_php.php';    
	$rss_twitter = new rss_php;
    $rss_twitter->load('http://twitter.com/statuses/user_timeline.rss?screen_name=redbricklatest&count=5');
    $items_twitter = $rss_twitter->getItems();
   
                $limit = 3;
				foreach($items_twitter as $index => $item_twitter) {
					$title_twitter = $item_twitter['title'];
					$link_twitter = $item_twitter['link'];
					$new_title_twitter = substr($title_twitter, 15);
					preg_match('/(http:\/\/)(.*)/', $new_title_twitter, $link);
					if (empty($link[0])) {
						?>
                        <li>
                            <div class="info"><a href="<? echo $link_twitter ?>" target="_blank"><? echo $new_title_twitter ?></a></div>
                        </li>
                        <?
					} else {
						?>
                        <li>
                            <div class="info"><a href="<? echo $link[0] ?>" target="_parent"><? echo str_replace(" " . $link[0], "", $new_title_twitter) ?></a></div>
                        </li>
                        <?
					}

					if($index == $limit) { 
						break; 
					}
						
				}*/
   ?>
    <li>
	<div class="info">No latest updates, they'll be delivered soon</div>
	</li>
	<?
				
    }
}
?>
<!-- TICKER -->
<?php




if($ticker_enable == "")
{
	//ticker disabled, hide
	$show = "hide";
}
else
{
	//ticker enabled, show
	$show = "show";
}
?>

<div id="ticker" class="<?php echo $show ?>">

	<div class="latest">Latest</div>
	<div class="newsticker-jcarousellite">
		<ul>
		<?php
			parse_cache_feed($ticker_username, "5");
		?>
		</ul>
	</div>
	
</div>
<!-- END TICKER -->