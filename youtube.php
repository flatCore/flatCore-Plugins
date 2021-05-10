<?php

/**
 * Plugin: youtube.php
 * Version: Version: 0.1
 * Requirement: flatCore
 * License: GNU General Public License
 * copyright (c) 2014, Patrick Konstandin
 * http://www.flatcore.de
 *
 * Description
 * This plugin embeds a youtube video
 *
 * Instructions
 * 1. copy this file in /content/plugins/
 * 2. type in pages content [plugin=youtube.php]v=VIDEOID[/plugin]
 *    Replace VIDEOID with the youtube ID of your Video
 */
 
 
$player_tpl = '
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/{vId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
';

$player_tpl = str_replace('{vId}', $v, $player_tpl);

echo $player_tpl;

?>