{extends "master.tpl"}

{block name=page_header}
<h1>Install BugsCMS</h1>
{/block}

{block name=sub_header}{/block}

{block name=content}
<div class="row">
<div class="column span3"></div>
<div class="column span4">
<form class="form-horizontal" method="post" action="index.php?action={$page.form_action}">

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
			<input type="email" id="email" name="email" placeholder="foo@bar.com">
		</div>
	</div>

	<div class="form-controls pull-right">
		<button type="reset" class="btn">Clear</button>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>

</form>
</div>
<div class="column span5"></div>
</div>
{/block}
