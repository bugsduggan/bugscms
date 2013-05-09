{extends "master.tpl"}

{*
	error.tpl
*}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Error</h1>
	</div>

	<p><a class="btn-large btn-primary" href="index.php">Home</a></p>

	{if #debug#}
		<p class="lead">
			{if isset($error)}
			{$error.msg}
			{else}
			Unknown error
			{/if}
		</p>
	{/if}

</div>
{/block}

{block name=navbar}
{/block}

{block name=sidebar}
{/block}

{block name=footer}
{/block}

{block name=style}
	.lead {
		margin-top: 20px;
	}
{/block}

{block name=headscript}
{/block}

{block name=footerscript}
{/block}
