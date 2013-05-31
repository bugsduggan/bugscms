{extends "master.tpl"}

{*
	register.tpl
*}

{block name=centerpanel}
<form class="form-horizontal" method="post" action="index.php?action=register">
	<div class="control-group">
		<label class="control-label" for="username">Username</label>
		<div class="controls">
			<input type="text" id="username" name="username" placeholder="Username">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="email">E-mail</label>
		<div class="controls">
			<input type="text" id="email" name="email" placeholder="user@domain.com">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input type="password" id="password" name="password" placeholder="Password">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="password2">Confirm password</label>
		<div class="controls">
			<input type="password" id="password2" name="password2" placeholder="Password">
		</div>
	</div>

	<div class="form-controls">
		<button type="submit" class="btn btn-primary">Register</button>
		<a href="index.php" class="btn">Back</a>
	</div>
</form>
{/block}
