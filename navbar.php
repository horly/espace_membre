<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">ESPACE MEMBRE</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">

	  	<?php

			if(isset( $_GET['id']))
			{
		
		 ?>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="profile.php?id=<?php echo $_GET['id'] ?>">Profile</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="cat_article.php?id=<?php echo $_GET['id'] ?>">Catégorie d'articles</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="article.php?id=<?php echo $_GET['id'] ?>">Articles</a>
					</li>

				
				</ul>
					<form class="form-inline my-2 my-lg-0">
				
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Déconnexion</button>
				</form>
		<?php
			  }
		?>
	  </div>

	</nav>

	<br>