{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Install BugsCMS</h1>
	</div>

	<form class="form-horizontal" method="post" action="index.php?page=install&action=doinstall">

		<div class="control-group">
			<label class="control-label" for="username">Admin user</label>
			<div class="controls">
				<input type="text" id="username" name="username" value="admin">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="password">Admin password</label>
			<div class="controls">
				<input type="password" id="password" name="password" placeholder="Password">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="email">Admin email</label>
			<div class="controls">
				<input type="text" id="email" name="email" placeholder="user@domain.com">
			</div>
		</div>

		<div class="form-controls">
			<button type="submit" class="btn btn-primary">Install</button>
			<button type"reset" class="btn">Clear</button>
		</div>

	</form>

</div>
{/block}

{block name=javascript}
{/block}
