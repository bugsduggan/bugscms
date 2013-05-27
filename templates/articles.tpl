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
<th>(Un)publish</th>
<th>Set about</th>
</tr>
{foreach $articles as $article}
{if $article->get_status() == 2}
{* About article *}
<tr class="success">
<td>{$article->get_id()}</td>
<td>{$article->get_title()}</td>
<td><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></td>
<td></td>
<td></td>
</tr>
{else if $article->get_status() == 1}
{* Active article *}
<tr>
<td>{$article->get_id()}</td>
<td>{$article->get_title()}</td>
<td><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></td>
<td><a href="index.php?action=unpublish&id={$article->get_id()}">Unpublish</a></td>
<td></td>
</tr>
{else}
{* Inactive article *}
<tr class="error">
<td>{$article->get_id()}</td>
<td>{$article->get_title()}</td>
<td><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></td>
<td><a href="index.php?action=publish&id={$article->get_id()}">Publish</a></td>
<td><a href="index.php?action=set_about&id={$article->get_id()}">Set about</a></td>
</tr>
{/if}
{/foreach}
</table>
<a class="btn btn-primary" href="index.php?page=edit_article">New article</a>
{/block}
