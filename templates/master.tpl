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
		{block name=custom_css}{/block}
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>

		{include "navbar.tpl"}

    <div class="container">

			{block name=content}
				<div class="page-header"><h1>{lorem_ipsum count=2 style=single}</h1></div>
				<p class="lead">{lorem_ipsum count=10 style=single}</p>
				{lorem_ipsum}
			{/block}

			{if $debug}
			<hr>
			<div class="row">

			<div class="column span3">
				<p class="lead">Page debug</p>
				<p class="muted">$page_tag = '{$page.tag}'</p>
				<p class="muted">$template = '{$page.template}'</p>
				{block name=page_debug}{/block}
			</div>

			<div class="column span3">
				<p class="lead">User debug</p>
				{if isset($page.user)}
				<p class="muted">$uid = '{$page.user.uid}'</p>
				{else}
				<p class="muted">not logged in</p>
				{/if}
				{block name=user_debug}{/block}
			</div>

			<div class="column span3">
				<p class="lead">Content debug</p>
				{block name=content_debug}{/block}
			</div>

			<div class="column span3">
				<p class="lead">General debug</p>
				{block name=general_debug}{/block}
			</div>

			</div>
			{/if}

    </div> <!-- /container -->

    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>
