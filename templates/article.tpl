{extends "master.tpl"}

{*
	home.tpl
*}

{block name=title}
<div class="page-header">
	<h1>{$article->get_title()|capitalize}</h1>
</div>
{/block}

{block name=rightpanel}
{if $article->get_edit_date() == $article->get_creation_date()}
<p class="muted">Created by: {$article->get_author()->get_username()} on {$article->get_creation_date()|date_format:#date_format#}</p>
{else}
<p class="muted">Last edited by: {$article->get_editor()->get_username()} on {$article->get_edit_date()|date_format:#date_format#}</p>
{/if}

{if $show_permalink && #permalinks#}
<p><a href="index.php?page=article&id={$article->get_id()}">Permalink</a></p>
{/if}
{if $logged_in}
<p><a href="index.php?page=edit_article&id={$article->get_id()}">Edit</a></p>
{/if}
{/block}

{block name=centerpanel}
{$article->get_body()}

{if isset($prev) || isset($next)}
<hr>
<ul class="pager">
	{if isset($prev)}
	<li class="previous">
		<a href="index.php?page=article&id={$prev->get_id()}">&larr; Prev</a>
	</li>
	{/if}
	{if isset($next)}
	<li class="next">
		<a href="index.php?page=article&id={$next->get_id()}">Next &rarr;</a>
	</li>
	{/if}
</ul>
{/if}
{/block}
