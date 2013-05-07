{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Install BugsCMS</h1>
	</div>

	<form class="form-horizontal" method="post" action="index.php?page=install&action=doinstall">

		<div class="form-controls">
			<button type="submit" class="btn btn-primary">Install</button>
			<button type"reset" class="btn">Clear</button>
		</div>

	</form>

</div>
{/block}

{block name=javascript}
{/block}
