{extends "master.tpl"}

{*
	users.tpl
*}

{block name=centerpanel}
<table class="table table-striped table-bordered">
{foreach $users as $u}

{if $u->is_admin()}
<tr class="success">
<td>{$u->get_id()}</td>
<td>{$u->get_username()}</td>
<td>{if $user->get_id() != $u->get_id()}
<a href="index.php?action=demote_user&id={$u->get_id()}">Remove admin</a>
{else}
N/A
{/if}</td>
</tr>
{else}
<tr>
<td>{$u->get_id()}</td>
<td>{$u->get_username()}</td>
<td><a href="index.php?action=promote_user&id={$u->get_id()}">Promote</a></td>
</tr>
{/if}

{/foreach}
</table>
{/block}
