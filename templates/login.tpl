{extends "master.tpl"}

{*
	blank.tpl
*}

{block name=centerpanel}
<form class="form-horizontal" method="post" action="index.php?action=login">
	<div class="control-group">
		<label class="control-label" for="username">Username</label>
		<div class="controls">
			<input type="text" id="username" name="username" placeholder="Username">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input type="password" id="password" name="password" placeholder="Password">
		</div>
	</div>

	<div class="form-controls">
		<button type="submit" class="btn btn-primary">Login</button>
		<a href="index.php" class="btn">Back</a>
	</div>
</form>
{/block}
