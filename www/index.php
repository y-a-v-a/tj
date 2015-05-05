<?php
/**
 * God is a TJ by ax710 and y-a-v-a.org
 * @package God is a TJ
 * @copyright 2010 y-a-v-a.org, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 * @version 0.4 may 2015
 */
session_start();
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>God is a TJ</title>
	<meta name="viewport" content="width=device-width">
	<meta name="keywords" content="TJ, text jockey, god, ax710, y-a-v-a">
	<meta name="description" content="God is a TJ">
	<script src="js/mootools.js"></script>
	<script src="js/mootools-more.js"></script>
	<script>
		window.addEvent('load', function() {
			$('content').addEvent('mycomplete', function() {
				getLine();
			});
			getLine();
		});
		window.cC = 0;
		window.sP = 0;
	</script>
	<style>
	.color0 { color: rgb( 35,  31,  32); }
	.color1 { color: rgb(236,   0, 140); }
	.color2 { color: rgb(  0, 174, 239); }
	.color3 { color: rgb(255, 242,   0); }
	</style>
</head>

<body>
<div id="content" style="margin-bottom: 45px;">

</div>
<div style="position: fixed; bottom: 0; padding: 4px; background: #fff; width: 98%;">
<a rel="license" href="http://creativecommons.org/licenses/by/3.0/nl/">
	<img alt="Creative Commons License" style="border-width:0; vertical-align: middle; clear: both; margin-right: 4px;" src="http://creativecommons.org/images/public/somerights20.png" />
</a>
<span class="color2" xmlns:dc="http://purl.org/dc/elements/1.1/" property="dc:title">God is a TJ</span>
 van <a class="color1" xmlns:cc="http://creativecommons.org/ns#" href="http://www.ax710.org/" property="cc:attributionName" rel="cc:attributionURL">ax710</a> &amp;
<a class="color3" xmlns:cc="http://creativecommons.org/ns#" href="http://www.y-a-v-a.org/" property="cc:attributionName" rel="cc:attributionURL">y-a-v-a</a>
 is in licentie gegeven volgens een <a class="color2" rel="license" href="http://creativecommons.org/licenses/by/3.0/nl/">Creative Commons Naamsvermelding 3.0 Nederland licentie</a>.
</div>
<script>
var getLine = function getLine() {
	var r = new Request({
		method:'post',
		data: 'sp=' + window.sP,
		url:"getbibleline.php",
		onSuccess: addResp,
		onFailure: reportError
	}).send();
}

var addResp = function addResp(resp) {
	var d = $('content');
	if (resp !== 'axel') {
		var el = new Element('span');
		el.setProperty('class', 'color' + window.cC);
		el.set('html', resp + ' ');
		el.injectInside(d);
		if (window.sP == 2) {
			window.sP = 0;
			if (window.cC == 3) {
				window.cC = 0;
			} else {
				window.cC++;
			}
		} else {
			window.sP++;
		}
		var myFx = new Fx.Scroll(window).toBottom();
	}
	window.setTimeout(function() {
		d.fireEvent('mycomplete');
	}, (500 + (Math.random() * 300)));
}

var reportError = function reportError() {
	console.log('error occured');
}
</script>
</body>
</html>
