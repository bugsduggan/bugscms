{extends "master.tpl"}

{*
	edit_profile.tpl
*}

{block name=centerpanel}
<img class="img-polaroid pull-right" src="{$user->get_avatar()}" alt="{$user->get_username()}'s avatar"></img>
<form class="form-horizontal" method="post" action="index.php?action=update_profile">
	
	<input type="hidden" id="id" name="id" value="{$user->get_id()}">

	<div class="control-group">
		<label class="control-label" for="avatar">Link to avatar image</label>
		<div class="controls">
			<input type="text" id="avatar" name="avatar" value="{$user->get_avatar()}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="email">E-mail</label>
		<div class="controls">
			<input type="text" id="email" name="email" value="{$user->get_email()}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="current">Current password</label>
		<div class="controls">
			<input type="password" id="current" name="current" placeholder="Password">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="new">New password</label>
		<div class="controls">
			<input type="password" id="new" name="new" placeholder="Password">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="check">Confirm password</label>
		<div class="controls">
			<input type="password" id="check" name="check" placeholder="Password">
		</div>
	</div>

	<div class="form-controls">
		<button type="submit" class="btn btn-primary">Update profile</button>
		<a href="index.php?page=admin" class="btn">Cancel</a>
	</div>
</form>
{/block}
