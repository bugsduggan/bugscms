{extends "master.tpl"}

{block name=content}
<div class="page-header">
	<h1>{$page.article.title}</h1>
</div>

{if $page.article.subtitle != 'NULL'}
<p class="lead">{$page.article.subtitle}</p>
{/if}

{$page.article.body}

<hr>

<p class="muted"><a href="index.php?page=article&aid={$page.article.aid}">Permalink</a></p>

{/block}

{block name=content_debug}
<p class="muted">$aid = '{$page.article.aid}'</p>
{/block}
