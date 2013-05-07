{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Contact</h1>
	</div>

	<form class="form-horizontal" method="post" action="index.php?page=contact&action=docontact">

		<div class="control-group">
			<label class="control-label" for="name">Name</label>
			<div class="controls">
				<input type="text" id="name" name="name" placeholder="Name">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input type="text" id="email" name="email" placeholder="Email">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="phone">Telephone</label>
			<div class="controls">
				<input type="text" id="phone" name="phone" placeholder="Telephone">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="message">Message</label>
			<div class="controls">
				<textarea rows="5"></textarea>
			</div>
		</div>

		<div class="form-controls">
			<button type="submit" class="btn btn-primary">Send</button>
			<button type="reset" class="btn">Clear</button>
		</div>

	</form>

</div>
{/block}

{block name=javascript}
{/block}
