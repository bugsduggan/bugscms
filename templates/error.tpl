{extends "master.tpl"}

{*
	error.tpl

	Expects to be passed an error array.
*}

{block name=centerpanel}
<p class="lead">Oops! Looks like we've encountered an error!</p>
<p>Sorry about that!</p>
{if #debug#}<hr>

<table class="table table-bordered span4">

	<tr><th colspan="2">{$error.message}</th></tr>
	<tr><th class="span3">Variable</th><th class="span3">Value</th></tr>

	{foreach $error key=k item=v}
		{if $k != 'message'}
			<tr><td>{$k}</td><td>{$v}</td></tr>
		{/if}
	{/foreach}

</table>

{/if}
{/block}
