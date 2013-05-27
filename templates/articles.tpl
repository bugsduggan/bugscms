{extends "master.tpl"}

{*
	articles.tpl
*}

{block name=centerpanel}
<table class="table table-bordered table-striped">
<tr>
<th>ID</th>
<th>Title</th>
<th>Edit</th>
<th>(Pre)view</th>
<th>(Un)publish</th>
<th>Set about</th>
<th>Delete</th>
</tr>
{foreach $articles as $article}
{if $article->get_status() == $smarty.const.ARTICLE_ABOUT}
<tr class="success">
<td>{$article->get_id()}</td>
<td>{$article->get_title()}</td>
<td><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></td>
<td><a href="index.php?page=about">View</a></td>
<td></td>
<td></td>
<td></td>
</tr>
{else if $article->get_status() == $smarty.const.ARTICLE_ACTIVE}
<tr>
<td>{$article->get_id()}</td>
<td>{$article->get_title()}</td>
<td><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></td>
<td><a href="index.php?page=article&id={$article->get_id()}">View</a></td>
<td><a href="index.php?action=unpublish&id={$article->get_id()}">Unpublish</a></td>
<td></td>
<td></td>
</tr>
{else if $article->get_status() == $smarty.const.ARTICLE_INACTIVE}
<tr class="error">
<td>{$article->get_id()}</td>
<td>{$article->get_title()}</td>
<td><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></td>
<td><a href="index.php?page=article&id={$article->get_id()}">Preview</a></td>
<td><a href="index.php?action=publish&id={$article->get_id()}">Publish</a></td>
<td><a href="index.php?action=set_about&id={$article->get_id()}">Set about</a></td>
<td><a href="index.php?action=delete&id={$article->get_id()}">Delete</a></td>
</tr>
{/if}
{/foreach}
</table>
<a class="btn btn-primary" href="index.php?page=edit_article">New article</a>
{/block}
