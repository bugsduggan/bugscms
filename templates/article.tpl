{extends "master.tpl"}

{block name=content}
<div class="page-header">
	<h1>{$page.article.title}</h1>
</div>

<div class="row">
	<div class="column span9">
		{if $page.article.subtitle != 'NULL'}
		<p class="lead">{$page.article.subtitle}</p>
		{/if}
	</div>
	
	<div class="column span1">
	{if $admin}<p class="muted pull-right"><a href="{$page.article.edit_link}">Edit</a></p>{/if}
	</div>

	<div class="column span1">
	<p class="muted pull-right"><a href="{$page.article.permalink}">Permalink</a></p>
	</div>

	<div class="column span1">
	</div>
</div>

{$page.article.body}

{/block}

{block name=content_debug}
<p class="muted">$aid = '{$page.article.aid}'</p>
{/block}
