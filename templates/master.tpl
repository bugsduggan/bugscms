{config_load $smarty.const.CONFIG scope=global}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{#site_name#} :: {$page|capitalize|default:'Blank page'}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
		<style type="text/css">
  		body {
    		padding-top: 60px;
    		padding-bottom: 40px;
  		}  	
			.navbar-search {
				margin-bottom: 4px;
			}
			.navbar-search button {
				margin-bottom: 5px;
			}
			.navbar a {
				margin-top: 4px;
			}
		</style>
		{block name=css}
		{/block}

  </head>

  <body>

		{include "navbar.tpl"}

		{block name=body}
		{/block}

		{include "footer.tpl"}

    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>
		{block name=javascript}{/block}

  </body>
</html>
