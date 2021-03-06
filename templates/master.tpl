{config_load $smarty.const.CONFIG section=globals scope=global}

{*
	master.tpl

	This is the absolute base for all pages and should not be extended directly!
	You should extend one of the style templates instead.
*}

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>{#site_name#} :: {$page|capitalize|default:'Blank page'}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="css/bootstrap.css" rel="stylesheet">
	<style>
		html,
    body {
      height: 100%;
    }
    #wrap {
      min-height: 100%;
      height: auto !important;
      height: 100%;
      margin: 0 auto -60px;
			padding-bottom: 20px;
    }
    #push,
    #footer {
      height: 60px;
    }
    #footer {
      background-color: #f5f5f5;
    }
		#footer .pull-right {
			padding-right: -70px;
		}
    .container .credit {
      margin: 20px 0;
    }
		@media (min-width: 1200px) {
			body {
				padding-top: 60px;
			}
		}
		@media (max-width: 767px) {
      #footer {
        margin-left: -20px;
        margin-right: -20px;
        padding-left: 20px;
        padding-right: 20px;
      }
    }
	{block name=style}{/block}
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.css" />
	<link rel="stylesheer" href="css/jquery-ui-timepicker-addon.css">

	<link href="css/style.css" rel="stylesheet">

  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<script src="js/jquery.ui.map.min.js" type="text/javascript"></script>
	<script src="js/underscore-min.js"></script>
	{block name=headscript}{/block}
</head>

<body>

	<div id="wrap">
	{block name=navbar}{include "navbar.tpl"}{/block}

	{block name=body}
	<div class="container">
	{block name=title}
	<div class="page-header">
		<h1>{$page|capitalize|default:'Blank page'}</h1>
	</div>
	{/block}
	<div class="row">
		<div class="span2">
		{block name=leftpanel}{/block}
		</div><div class="span8">
		{block name=centerpanel}<p>{lorem_ipsum}</p>{/block}
		</div><div class="span2">
		{block name=rightpanel}{/block}
		</div>
	</div>
	</div><!-- end of container -->
	<div id="push"></div>
	{/block}
	</div><!-- end of wrap -->

	{block name=footer}
	<div id="footer">
		<div class="container">
			<p class="muted credit pull-right">Built using BugsCMS &copy; <a href="https://github.com/BugsCMS/bugscms">BugsCMS</a> 2013</p>
			<p class="muted credit">{#footer#}</p>
		</div>
	</div>
	{/block}

	<script src="js/bootstrap.js"></script>
	<script>
	{block name=footerscript}{/block}
	</script>

</body>

</html>
