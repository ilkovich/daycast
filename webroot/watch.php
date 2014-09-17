<?
ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them

require('parse/autoload.php');
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

$app_id = "Yqt0rTyLG1zwMbIOQ5B3FtoApz5JR0Ts5nRgnA3P";
$rest_key =  "1UW7AhZH8ZYXG0uZlFeF6pK0vIBvmCGmldkQL9Fj";
$master_key = "56xSGEMuf4Pr2wjyPVetyhwX29LPQGNdEgINXDtA";

ParseClient::initialize( $app_id, $rest_key, $master_key );
?>
<!DOCTYPE html>
<html data-cast-api-enabled='true'>
    <head>
	<link rel="stylesheet" type="text/css" href="css/demo.css">
	<script type="text/javascript" src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js"></script>
	<script src="helloVideos.js"></script>
    </head>
    <body>
        <h1>Hello Chromecast</h1>
	<h2>Google Cast Sender</h2>
	<?php

		$query = new ParseQuery('VideoObject');
		$results = $query->find();
		
		for ($i = 0; $i < count($results); $i++) { 
			$object = $results[$i];
			echo $object->get('title');
			echo $object->get('url');
			echo '<BR>';
  			//echo $object->get('title'));
		}
	?>

  <div>
    <div>
      <h2 style="display:block">Google Cast Chrome Sender SDK: Hello Videos</h2>
      <div style="float:left; width:100%; margin:10px;">
        <h3 style="display: inline-block">Choose a media below or enter your own media URL to cast</h3><br>
        <span style="font-weight:bold; color:#0000cc;">Enter custom media URL</span>: <input type="text" name="customMediaURL" value="" size="70" id="customMediaURL"><br>
        <input type="submit" name="loadCustomMeida" value="Load Custom Media" onclick="loadCustomMedia();">
      </div>
      <br>
      <div style="width:80%; margin:10px;">
        <div style="margin:0px; float:left; width: 40%;">
           <input type="radio" checked name="media" onclick="selectMedia(0);">Big Buck Bunny MP4<br>
           <input type="radio" name="media" onclick="selectMedia(1);">Elephants Dream MP4<br>
           <input type="radio" name="media" onclick="selectMedia(2);">Tears of Steel MOV<br>
           <input type="radio" name="media" onclick="selectMedia(3);">Reel MP4<br>
           <input type="radio" name="media" onclick="selectMedia(4);">Google I/O 2011 MP3<br>
        </div>
        <div style="margin:0px; float:left; width:250px;">
           <img src="images/bunny.jpg" width="250" id="thumb">
           <img src="images/cast_icon_idle.png" id="casticon" width="30">
        </div>
      </div>

      <div style=" margin:0px; float:left; display:block; width:90%;">
        <div style=" margin:10px; float:left; display:block; width:40%;">
          <button onclick="launchApp()">Launch app</button>
          <button onclick="stopApp()">Stop app</button>
          <button id="joinsessionbyid" style="float:right; display:none;" onclick="joinSessionBySessionId()">Join by session ID</button>
          <br>
          <button onclick="loadMedia()">Load media</button>
          <button id="playpauseresume" onclick="playMedia()">Play</button>
          <button onclick="stopMedia()">Stop media</button>
          <button id="muteunmute" onclick="muteMedia();">Mute media</button>
          <button id="getstatus" onclick="getMediaStatus();">Get media status</button>
        </div>

        <div style="margin-top:60px; float:left; width:15%;">
	   <input class="vertical" type="range" min="0" max="100" step="1" onmouseup="setReceiverVolume(1-this.value/100,false);">
           <div class="vertical">Volume control</div>
        </div>
      </div>
    </div>
    <div style=" margin:10px; float:left; display:block; width:100%;">
      <div style="margin:10px;">
        Progress : <input id="progress" type="range" min="1" max="100" value="1" step="1" onmouseup="seekMedia(this.value);">
        <span id="duration"></span>
        <div id="progress_tick"></div>
      </div>
      <div style="margin:10px;">
        State : <span id="playerstate">IDLE</span>
      </div>

      <div style="margin:10px;">
        <textarea rows="20" cols="70" id="debugmessage">
        </textarea>
      </div>

    </div>
  </div>
    </body>
</html>
