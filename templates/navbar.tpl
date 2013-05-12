{config_load $smarty.const.CONFIG section=global scope=local}

{*
	navbar.tpl

	Creates the navbar along the top of the screen.
	Expects $page to be set.
*}

<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="index.php">{#site_name#}</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-left">
          {if $page == 'home'}<li class="active">{else}<li>{/if}
						<a href="index.php">Home</a></li>
        </ul>
				<ul class="nav pull-right">
					{if $logged_in}
					<li><a href="index.php?page=admin"><i class="icon-wrench icon-white"></i></a></li>
					<li><a href="index.php?action=logout">Logout</a></li>
					{else}
					<form class="navbar-search" method="post" action="index.php?action=login">
						<input class="search-query span2" type="text" id="username" name="username" placeholder="Username">
						<input class="search-query span2" type="password" id="password" name="password" placeholder="Password">
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
					{/if}
				</ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
