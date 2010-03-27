<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>TJ</title>
	<script type="text/javascript" src="js/mootools.js"></script>

</head>

<body onload="getLine.periodical(8000)">
	<h2>TJ</h2>
<div id="content">
	
</div>
<script type="text/javascript">

function getLine() {
	var r = new Request({
		method:'get',
		url:"getline.php",
		onSuccess: addResp
	}).send();
}

function addResp(resp) {
	if (resp == 'axel') {
		return;
	}
	d = $('content');
	el = new Element('div');
	el.set('html', resp);
	el.injectInside(d);
}
</script>
</body>
</html>
