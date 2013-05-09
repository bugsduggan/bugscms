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
	{block name=style}{/block}
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">

	<script>
	{block name=headscript}{/block}
	</script>
</head>

<body>

	{block name=navbar}{/block}

	{block name=sidebar}{/block}

	{block name=body}{/block}

	{block name=footer}{/block}

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script>
	{block name=footerscript}{/block}
	</script>

</body>

</html>
