<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=1250">
	<link rel="stylesheet" href="<?=$cssFilePath?>" type="text/css" media="screen">
	<script src="<?=$jqueryFilePath?>"></script>
	<script src="<?=$jsLOCALSfilePath?>"></script>
	<script src="<?=$jsFunctionsFilePath?>"></script>
	<title><?=$l_websiteNameTitle?></title>
	<? if ( $getpage!=$homepageGet){?>
	<script type="text/javascript">
	//<![CDATA[
	  (function() {
		var shr = document.createElement('script');
		shr.setAttribute('data-cfasync', 'false');
		shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
		shr.type = 'text/javascript'; shr.async = 'true';
		shr.onload = shr.onreadystatechange = function() {
		  var rs = this.readyState;
		  if (rs && rs != 'complete' && rs != 'loaded') return;
		  var site_id = 'a76375cab7f7596a7ae5b4f14d070dae';
		  try { Shareaholic.init(site_id); } catch (e) {}
		};
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(shr, s);
	  })();
	//]]>
	</script>
	<?}?>
	
	
	
</head>
<body>