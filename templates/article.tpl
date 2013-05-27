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
{if $show_permalink}
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
