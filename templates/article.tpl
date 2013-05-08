{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	{if isset($article)}

	<div class="page-header">
				<h1>{$article.title}</h1>
	</div>

	<div class="row">
		<div class="column span3">
		</div>
		<div class="column span6">
			{$article.body}
		</div>
		<div class="column span3">
		{if $logged_in}
			<p><a class="btn btn-primary" href="admin/index.php?page=edit&id={$article.id}">Edit</a></p>
		{/if}
		</div>

	</div>

	{else}

	<p class="lead">No data to display</p>
	</p><a href="index.php">Go back</a></p>

	{/if}

</div>
{/block}

{block name=javascript}
{/block}
