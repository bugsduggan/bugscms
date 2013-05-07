{config_load $smarty.const.CONFIG scope=global}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{#site_name#} :: {$page_title|default:'Blank page'}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
		{block name=css}
		{/block}

  </head>

  <body>

		{include "navbar.tpl"}

		{block name=body}
		{/block}

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
		{block name=javascript}{/block}

  </body>
</html>
