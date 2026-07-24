<?php
/**
 * TJ - shared page template by ax710 and y-a-v-a.org
 * Expects a $site configuration array, see apps/<site>/public/index.php:
 *   title        string  page and artwork title
 *   keywords     string  optional, meta keywords
 *   description  string  optional, meta description
 *   ie_compat    bool    optional, emit X-UA-Compatible meta tag
 *   jsonld       string  schema.org JSON-LD block
 *   endpoint     string  URL the frontend polls for new lines
 *   delayed_next bool    true: wait 500-800ms before requesting the next line
 *                        (use when the endpoint itself does not sleep)
 *   title_class  string  color class of the title in the footer
 *   creators     array   list of array('name' => ..., 'url' => ..., 'class' => ...)
 * @package TJ
 * @copyright 2010 y-a-v-a.org, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 */
session_start(); // to create a cookie so Varnish will not cache responses on ONI server
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<?php if (!empty($site['ie_compat'])) : ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php endif; ?>
	<title><?php echo $site['title']; ?></title>
	<meta name="viewport" content="width=device-width">
<?php if (!empty($site['keywords'])) : ?>
	<meta name="keywords" content="<?php echo $site['keywords']; ?>">
<?php endif; ?>
<?php if (!empty($site['description'])) : ?>
	<meta name="description" content="<?php echo $site['description']; ?>">
<?php endif; ?>
	<script type="application/ld+json">
<?php echo $site['jsonld'] . "\n"; ?>
	</script>
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
<a rel="license" href="https://creativecommons.org/licenses/by/3.0/nl/">
	<img alt="Creative Commons License" style="border-width:0; vertical-align: middle; clear: both; margin-right: 4px;" src="https://creativecommons.org/images/public/somerights20.png" />
</a>
<span class="<?php echo $site['title_class']; ?>" xmlns:dc="http://purl.org/dc/elements/1.1/" property="dc:title"><?php echo $site['title']; ?></span>
 van <a class="<?php echo $site['creators'][0]['class']; ?>" xmlns:cc="http://creativecommons.org/ns#" href="<?php echo $site['creators'][0]['url']; ?>" property="cc:attributionName" rel="cc:attributionURL"><?php echo $site['creators'][0]['name']; ?></a> &amp;
<a class="<?php echo $site['creators'][1]['class']; ?>" xmlns:cc="http://creativecommons.org/ns#" href="<?php echo $site['creators'][1]['url']; ?>" property="cc:attributionName" rel="cc:attributionURL"><?php echo $site['creators'][1]['name']; ?></a>
 is in licentie gegeven volgens een <a class="color2" rel="license" href="https://creativecommons.org/licenses/by/3.0/nl/">Creative Commons Naamsvermelding 3.0 Nederland licentie</a>.
</div>
<script>
var getLine = function getLine() {
	var r = new Request({
		method:'post',
		data: 'sp=' + window.sP,
		url:"<?php echo $site['endpoint']; ?>",
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
<?php if (!empty($site['delayed_next'])) : ?>
	window.setTimeout(function() {
		d.fireEvent('mycomplete');
	}, (500 + (Math.random() * 300)));
<?php else : ?>
	d.fireEvent('mycomplete');
<?php endif; ?>
}

var reportError = function reportError() {
	console.log('error occured');
}
</script>
</body>
</html>
