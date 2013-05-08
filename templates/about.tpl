{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	{if isset($about)}

	<div class="page-header">
		<h1>{$about.title}</h1>
	</div>

	<div class="row">
	<div class="column span3"></div>
	<div class="column span6">
	{$about.body}
	</div>
	<div class="column span3"></div>

	</div>

	{else}

	<div class="page-header">
		<h1>About</h1>
	</div>

	<p class="lead">No data to display</p>

	{/if}

</div>
{/block}

{block name=javascript}
{/block}
