<?php
/*
Plugin Name: YouTube Feed
Plugin URI: http://jameslow.com/2008/11/06/youtube-feed/
Version: 0.2.1
Description: Create youtube and other video links in your posts, and have them show up as links in facebook
Author: James Low
Author URI: http://jameslow.com
*/

	function isfacebook() {
		return strpos($_SERVER['HTTP_USER_AGENT'],'FacebookFeedParser') !== false;
	}

	function youtube($video, $center = true, $width = 425, $height = 319) {
		/*
		if (isfacebook()) {
			$url = "http://www.youtube.com/watch?v=$video";
			echo '<a href="'.$url.'">'.$url.'</a>';
		} else {
			global $issidebar;
			if ($issidebar) {
					$size = 'width="280" height="235"';
			} else {
				$size = 'width="425" height="344"';
			}
			if ($center) {
				echo '<div align="center">';
			}
?>
			<object <?php echo $size; ?>><param name="movie" value="http://www.youtube.com/v/<?php echo $video; ?>"></param><embed src="http://www.youtube.com/v/<?php echo $video; ?>" type="application/x-shockwave-flash" <?php echo $size; ?>></embed></object>
<?php
			if ($center) {
				echo '</div>';
			}
		}
		*/
		global $issidebar;
		if ($issidebar) {
			$height = 280 * $height / $width;
		}
		$height = $height+25;
		$size = 'width="'.$width.'" height="'.$height.'"';
		$url = "http://www.youtube.com/watch?v=$video";
		generalvideo(generallink('http://www.youtube.com/watch?v=',$video),
			'<object '.$size.'><param name="movie" value="http://www.youtube.com/v/'.$video.'"></param><embed src="http://www.youtube.com/v/'.$video.'" type="application/x-shockwave-flash"'.$size.'></embed></object>',
			$center);
	}
	
	//Could do the same thing for video file
	function audiofile($audio) {
		if (isfacebook()) {
			echo '<a href="'.$file.'">'.$file.'</a>';
		} else { ?>
[coolplayer width="200" height="20" autoplay="0" loop="0" charset="utf-8" download="0" mediatype=""]
<?php echo $file; ?>
[/coolplayer]
	<?php }
	}
	
	function googlevideo($video, $center = true) {
		generalvideo(generallink('http://video.google.com/videoplay?docid=',$video),
			'<embed id="VideoPlayback" src="http://video.google.com/googleplayer.swf?docid='.$video.'&hl=en&fs=true" style="width:400px;height:326px" allowFullScreen="true" allowScriptAccess="always" type="application/x-shockwave-flash"> </embed>',
			$center);
	}
	
	function tangle($video, $center = true) {
		generalvideo(generallink('http://www.tangle.com/view_video.php?viewkey=',$video),
			'<embed src="http://www.tangle.com/flash/swf/flvplayer.swf" FlashVars="viewkey='.$video.'" wmode="transparent" quality="high" width="330" height="270" name="tangle" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>',
			$center);
	}
	
	function gsfn($video, $link, $image, $center = true) {
	$img = '<a href="http://www.globalshortfilmnetwork.com/films/'.$link.'"><img width="450" height="254" src="http://www.globalshortfilmnetwork.com/product_images/'.$image.'" /></a>';
	generalvideo($img,
		$img,
		$center);
/*		generalvideo(generallink('http://www.globalshortfilmnetwork.com/films/',$link),
  "
  <div id=\"player_film_55\"></div>
  <script src=\"http://www.globalshortfilmnetwork.com/javascripts/all.js?1245082226\" type=\"text/javascript\"></script>
  <script type=\"text/javascript\" charset=\"utf-8\">
    var so = new SWFObject('/flash/player-licensed.swf','player_55','318','238','9');
    so.addParam('allowscriptaccess','always');
    so.addParam('allowfullscreen','true');
    so.addParam('wmode', 'opaque');
    so.addParam('flashvars','file=/file_uploads/".$video."&image=/product_images/".$image."' + 
                            //'&viral.functions=embed' + 
                            '&plugins=googlytics-1,yourlytics-1,viral' +
                            '&yourlytics.callback=http://www.globalshortfilmnetwork.com/films/play' +
                            '&skin=/flash/modieus.swf' + 
                            '&wmode=opaque' +
                            '&viral.callout=mouse' +
                            '&viral.onpause=false' +
                            '');
    so.useExpressInstall('/flash/expressinstall.swf');
    so.write('player_film_55');
  </script>"
		,$center);*/
	}
	
	function generallink($begin, $end) {
		$url = $begin.$end;
		return '<a href="'.$url.'">'.$url.'</a>';
	}
	
	function generalvideo($feed, $embeded, $center = true) {
		if (isfacebook()) {
			echo $feed;
		} else {
			if ($center) {
				echo '<div align="center">';
			}
				echo $embeded;
			if ($center) {
				echo '</div>';
			}
		}	
	}
	
	function coolplayer($url) {

	}
?>