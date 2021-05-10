<?php

/**
 * [plugin=video.js.php]v=myvideo[/plugin]
 * filename = filename of the video
 * name your preview image (poster) like poster_filename.jpg
 * upload your video to /content/files/
 * upload your video poster to /content/images/
 * supportet video formats: mp4 (more coming soon)
 *
 * videojs license: https://github.com/videojs/video.js/blob/master/LICENSE
 */

/* backend */
	
$plugin = array();
$plugin['title'] = 'Video Plugin';
$plugin['description'] = '<p>Includes a Video Player using video.js (http://videojs.com)</p>';
$plugin['version'] = '0.1';
$plugin['author'] = 'Patrick Konstandin';

/* frontend */

if(FC_SOURCE == 'frontend') {
	
	$video_file = basename($v);
	$video_poster = 'poster_'.$v.'.jpg';
	   
  echo '<link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">';
  echo '

	<video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
	  poster="/content/images/'.$video_poster.'" data-setup="{}">
	  <source src="/content/files/'.$v.'.mp4" type="video/mp4">
	    <p class="vjs-no-js">
	      To view this video please enable JavaScript, and consider upgrading to a web browser that
	      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
	    </p>
	</video>';

	echo '<script src="http://vjs.zencdn.net/5.8.8/video.js"></script>'; 
}

?>