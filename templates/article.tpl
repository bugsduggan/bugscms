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

<hr>
{if $logged_in}
<p class="pull-right"><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></p>
{/if}
<p><a href="index.php?page=article&id={$article->get_id()}">Permalink</a></p>
{/block}
