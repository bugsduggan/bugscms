{config_load $smarty.const.CONFIG scope=global}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{#site_name#} :: {$page_title|default : 'Blank page'}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>

		{include "navbar.tpl"}

    <div class="container">

			<div class="page-header">
			{block name=page_header}
				<h1>{lorem_ipsum style=single count=2}</h1>
			{/block}
			</div>

			{block name=sub_header}
			<p class="lead">{lorem_ipsum style=single lorem=false}</p>
			{/block}

			{block name=content}
			{lorem_ipsum style=paragraph lorem=true}
			{/block}

			{if $debug}
			<hr>
			<p class="muted">$page_tag = '{$page.tag}'</p>
			<p class="muted">$template = '{$page.template}'</p>
			{if isset($page.user)}
			<p class="muted">$uid = '{$page.user.uid}'</p>
			{/if}
			{block name=debug}{/block}
			{/if}

    </div> <!-- /container -->

    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>
