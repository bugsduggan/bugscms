{config_load $smarty.const.CONFIG scope=global}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{block name=title}{#site_name#} :: {$page_title|default : 'Blank page'}{/block}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
		{block name=css}
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
		{/block}
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>

		{block name=navbar}{/block}

		<div class="container">
		{block name=body}{/block}
		</div>

    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>
		{block name=javascript}{/block}

  </body>
</html>
