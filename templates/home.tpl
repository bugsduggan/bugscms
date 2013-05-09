{extends "master.tpl"}

{*
	blank.tpl
*}

{block name=body}
<div class="container">
	<div class="page-header">
		<h1>Home</h1>
	</div>

	{if isset($user)}
	<p>{$user->get_username()}</p>
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
{/block}

{block name=headscript}
{/block}

{block name=footerscript}
{/block}
