{extends "admin.tpl"}

{block name=admin_content}
<table class="table table-striped table-bordered">
	{foreach $page.articles as $article}
	<tr><td>{$article.aid}</td><td>{$article.title}</td><td><a href="{$article.edit_link}">Edit</a></td><td><a href="{$article.del_link}">Delete</a></td><td><a href="{$article.perm_link}">Permalink</a></td></tr>
	{/foreach}
</table>
{/block}
