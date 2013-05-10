{extends "master.tpl"}

{*
	blank.tpl
*}

{block name=body}
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span9">
		{* main page content *}
			<div class="page-header">
				<h1>Home</h1>
			</div>

			<p class="lead">{lorem_ipsum count=50 style=single}</p>

			{lorem_ipsum}

		</div>
		<div class="span3">
		{* sidebar *}

		</div>
	</div>
</div>
{/block}

{block name=navbar}
{/block}

{block name=sidebar}
{/block}

{block name=footer}
{/block}

{block name=style}
{/block}

{block name=headscript}
{/block}

{block name=footerscript}
{/block}
