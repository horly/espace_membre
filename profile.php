<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<title>Espace membre</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/toastr/toastr.min.css">
</head>

<body>


	<?php
		if(isset($_GET['id']) AND $_GET['id'] > 0)
		{
			//connexion à la base de données 
			include('connexting_database.php');

			$get_id = $_GET['id']; 

			//on récupère les informations de l'utilisateurs 
			$get_user = $bdd->prepare("SELECT * FROM user WHERE id = ?");
			$get_user->execute(array($get_id));

			$infos_user = $get_user->fetch();

	?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">ESPACE MEMBRE</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
	      </li>
	      
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	     
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Déconnexion</button>
	    </form>
	  </div>
	</nav>
	
	<br>

	<div class='container'>
		<div class="row">
			<div class="col-md-4">
				<div class="p-3 mb-2 bg-light text-dark border"></div>
			</div>

			<div class="col-md-8">
				<div class="p-3 mb-2 bg-light text-dark border">

					Civilité : <?php echo $infos_user['civilite']; ?>
					<br><br>
					Nom : <?php echo $infos_user['name']; ?>
					<br><br>
					Prénom : <?php echo $infos_user['surname']; ?>
					<br><br>
					Date de naissance : <?php echo $infos_user['date_naissance']; ?>
					<br><br>
					Adresse : <?php echo $infos_user['adresse']; ?>
					<br><br>
					Adresse Email : <?php echo $infos_user['email']; ?>

				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript" src="js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/toastr/toastr.min.js"></script>
</body>

<?php
		}
		else
		{
			header('location:index.php');
		}
?>
</html>