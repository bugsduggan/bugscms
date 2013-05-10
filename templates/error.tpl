{extends "master.tpl"}

{*
	error.tpl

	Expects to be passed an error array with the following required fields:

		page_requested - The $page attribute from index.php indicating the
		                 template requested. Probably from $_GET['page'].

	It can also display the following optional fields:
		
		action         - $_GET['id'] if it was set.
		id             - $_GET['id'] if it was set.

*}

{block name=centerpanel}
<p class="lead">Oops! Looks like we've encountered an error!</p>
<p>Sorry about that!</p>
{if #debug#}<hr>

<table class="table table-bordered span4">

	<tr><th colspan="2">{$error.message}</th></tr>
	<tr><th class="span3">Variable</th><th class="span3">Value</th></tr>

	{if isset($error.action)}
	<tr><td>Action requested:</td><td>{$error.action}</td></tr>
	{/if}

	{if isset($error.id)}
	<tr><td>Id requested:</td><td>{$error.id}</td><tr>
	{/if}

	<tr><td>Page requested:</td><td>{$error.page_requested}</td></tr>

</table>

{/if}
{/block}
