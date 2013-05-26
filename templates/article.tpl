{extends "master.tpl"}

{*
	home.tpl
*}

{block name=title}
<div class="page-header">
	<h1>{$article->get_title()|capitalize}</h1>
</div>
{/block}

{block name=centerpanel}
{$article->get_body()}
{if $logged_in}
<hr>
<a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a>
{/if}
{/block}
