{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
			{include "admin-sidebar.tpl"}<!--/.well -->
    </div><!--/span-->

    <div class="span9">
      <div class="hero-unit">
				{block name=admin-hero}{/block}
      </div>
			<div class="row-fluid">
				{block name=admin-body}{/block}
			</div>
    </div><!--/span-->
  </div><!--/row-->
</div>
{/block}

{block name=javascript}
{/block}
