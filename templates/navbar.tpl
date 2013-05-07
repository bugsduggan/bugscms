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
        <ul class="nav">
					{if $page == 'home'}<li class="active">{else}<li>{/if}<a href="index.php">Home</a></li>
					{if $page == 'gigs'}<li class="active">{else}<li>{/if}<a href="index.php?page=gigs">Gigs</a></li>
          {if $page == 'about'}<li class="active">{else}<li>{/if}<a href="index.php?page=about">About</a></li>
          {if $page == 'contact'}<li class="active">{else}<li>{/if}<a href="index.php?page=contact">Contact</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
