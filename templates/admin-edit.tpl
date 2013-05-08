{extends "admin-master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Edit page</h1>
	</div>

	{if isset($article)}
	<form class="form-horizontal" method="post" action="index.php?action=save_page">
	{else}
	<form class="form-horizontal" method="post" action="index.php?action=save_page">
	{/if}

		{if isset($article)}
		<input type="hidden" id="id" name="id" value="{$article.id}">
		{/if}

		{if isset($article)}
		<input type="hidden" id="status" name="status" value="{$article.status}">
		{else}
		<input type="hidden" id="status" name="status" value="{#status_active#}">
		{/if}

		<div class="control-group">
			<label class="control-label" for="title">Title</label>
			<div class="controls">
				{if isset($article)}
				<input type="text" class="span8" id="title" name="title" value="{$article.title}">
				{else}
				<input type="text" class="span8" id="title" name="title" placeholder="Title">
				{/if}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="body">Body</label>
			<div class="controls">
				{* The textarea needs to be inside the if so we don't get extra spaces *}
				{if isset($article)}
				<textarea class="span8" id="body" name="body" rows="18">{$article.body}</textarea>
				{else}
				<textarea class="span8" id="body" name="body" rows="18"></textarea>
				{/if}
			</div>
		</div>

		<div class="form-controls">
			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn" href="index.php?page=pages">Back</a>
		</div>

	</form>

</div>
{/block}

{block name=javascript}
{/block}
