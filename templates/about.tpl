{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>About</h1>
	</div>

	{if isset($about)}
	{$about}
	{else}
	<p class="lead">No data to display</p>
	{/if}

</div>
{/block}

{block name=javascript}
{/block}
