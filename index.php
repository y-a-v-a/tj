<?php
/**
 * Neuropolis N by ax710 and vincentbruijn
 * @package Neuropolis N
 * @copyright 2010 vincent bruijn, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 */
header('Content-type: text/html; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
	"http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Neuropolis N</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="js/mootools.js"></script>
	<script type="text/javascript" src="js/mootools-more.js"></script>
	<script type="text/javascript">
		window.addEvent('load', function() {
			$('content').addEvent('mycomplete', function() {
				getLine();
			});
			$('content').fireEvent('mycomplete');
		});
		window.cC = 0;
		window.sP = 0;
	</script>
	<style type="text/css">
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
<span class="color2" xmlns:dc="http://purl.org/dc/elements/1.1/" property="dc:title">Neuropolis N</span>
 van <a class="color1" xmlns:cc="http://creativecommons.org/ns#" href="http://www.ax710.org/" property="cc:attributionName" rel="cc:attributionURL">ax710</a> &amp; 
<a class="color3" xmlns:cc="http://creativecommons.org/ns#" href="http://www.alweervincent.nl/" property="cc:attributionName" rel="cc:attributionURL">alweervincent</a>
 is in licentie gegeven volgens een <a class="color2" rel="license" href="http://creativecommons.org/licenses/by/3.0/nl/">Creative Commons Naamsvermelding 3.0 Nederland licentie</a>.
</div>
<script type="text/javascript">
function getLine() {
	var r = new Request({
		method:'get',
		url:"getline.php?sp=" + window.sP,
		onSuccess: addResp
	}).send();
}

function addResp(resp) {
	d = $('content');
	if (resp !== 'axel') {
		el = new Element('span');
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
	d.fireEvent('mycomplete');
}
</script>
</body>
</html>
