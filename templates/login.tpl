{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Login</h1>
	</div>

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
			<button type="reset" class="btn">Clear</button>
		</div>

	</form>

</div>
{/block}

{block name=javascript}
{/block}
