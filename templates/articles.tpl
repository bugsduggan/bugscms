{extends "master.tpl"}

{*
	articles.tpl
*}

{block name=centerpanel}
<table class="table table-bordered table-striped">
{foreach $articles as $article}
<tr>
<td>{$article->get_id()}</td>
<td>{$article->get_title()}</td>
<td><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></td>
</tr>
{/foreach}
</table>
<a class="btn btn-primary" href="index.php?page=edit_article">New article</a>
{/block}
