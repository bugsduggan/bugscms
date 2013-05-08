{extends "admin-master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Pages</h1>
	</div>

	<div class="row">

		<div class="column span4">
			<p><a class="btn btn-primary" href="index.php?page=edit">New page</a></p>
		</div>
		<div class="column span4"></div>
		<div class="column span4">
			<p class="lead">Info</p>
			{if isset($pages)}
			<p><strong>Pages:</strong> {count($pages)}</p>
			{/if}
		</div>

	</div>

	<hr>

	{if isset($pages)}
	<table class="table table-striped table-bordered">
		<tr><th>ID</th><th>Title</th><th>Edit</th><th>Link</th><th>About</th></tr>
		{if isset($about)}
		<tr class="success">
			<td>{$about.id}</td>
			<td>{$about.title|truncate:50}</td>
			<td><a href="index.php?page=edit&id={$about.id}">Edit</a></td>
			<td><a href="../index.php?page=about">View</a></td>
			<td></td>
		</tr>
		{/if}
		{foreach $pages as $page}
		<tr>
			<td>{$page.id}</td>
			<td>{$page.title|truncate:50}</td>
			<td><a href="index.php?page=edit&id={$page.id}">Edit</a></td>
			<td><a href="../index.php?page=article&id={$page.id}">View</a></td>
			<td><a href="index.php?action=set_about&id={$page.id}">Set about</a></td>
		</tr>
		{/foreach}
	</table>
	{else}
	<p class="lead">No pages to display</p>
	{/if}

</div>
{/block}

{block name=javascript}
{/block}
