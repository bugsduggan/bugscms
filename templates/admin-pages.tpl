{extends "admin-master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Pages</h1>
	</div>

	{if isset($pages)}
	<table class="table table-striped table-bordered">
		<tr><th>ID</th><th>Title</th><th>Edit</th><th>Link</th></tr>
		{if isset($about)}
		<tr class="success">
			<td>{$about.id}</td>
			<td>{$about.title}</td>
			<td><a href="#">Edit</a></td>
			<td><a href="../index.php?page=about">View</a></td>
		</tr>
		{/if}
		{foreach $pages as $page}
		<tr>
			<td>{$page.id}</td>
			<td>{$page.title}</td>
			<td><a href="#">Edit</a></td>
			<td><a href="../index.php?page=article&id={$page.id}">View</a></td>
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
