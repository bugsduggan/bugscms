{extends "master.tpl"}

{block name=content}
	
	<div class="row">
	
		<div class="column span3">
		{if isset($page.sidebar)}
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
				{foreach $page.sidebar as $item}
					<li><a href="{$item.link}">{$item.text}</a></li>
				{/foreach}
				</ul>
			</div>
		{/if}
		</div>

		<div class="column span9">
			<div class="page-header">
				<h1>Admin dashboard</h1>
			</div>
		</div>

	</div>
{/block}
