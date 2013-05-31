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
{if $show_author}
	<img class="img-polaroid" style="margin:25px; width:100px; height:100px;"
	src="{$article->get_author()->get_avatar()}" alt="{$article->get_author()->get_username()}'s avatar"></img>
	<p class="muted">Created by: {$article->get_author()->get_username()}
	{if $article->get_edit_date() == $article->get_creation_date()}
	 on {$article->get_creation_date()|date_format:#date_format#}</p>
	{else}
	</p>
	<p class="muted">Last edited by: {$article->get_editor()->get_username()} on {$article->get_edit_date()|date_format:#date_format#}</p>
	{/if}
{/if}

{if $show_permalink && #permalinks#}
<p><a href="index.php?page=article&id={$article->get_id()}">Permalink</a></p>
{/if}
{if $logged_in && $user->is_admin()}
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
