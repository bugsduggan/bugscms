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
					{if $page == 'home'}<li class="active">{else}<li>{/if}<a href="index.php">Home</a></li>
					{if $page == 'events'}<li class="active">{else}<li>{/if}<a href="index.php?page=events">Events</a></li>
          {if $page == 'about'}<li class="active">{else}<li>{/if}<a href="index.php?page=about">About</a></li>
          {if $page == 'contact'}<li class="active">{else}<li>{/if}<a href="index.php?page=contact">Contact</a></li>
        </ul>
				<ul class="nav pull-right">
				{if $logged_in}
					<li><a href="admin/index.php"><i class="icon-wrench icon-white"></i></a></li>
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
