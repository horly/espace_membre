<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>
	<title>Espace membre</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/toastr/toastr.min.css">

	<!--Cropper-->
	<link rel="stylesheet" type="text/css" href="cropper/css/cropper.css">
	<link rel="stylesheet" type="text/css" href="cropper/css/main.css">

	<!--Icons-->
	<link rel="stylesheet" type="text/css" href="font-awesome/icons/font-awesome.min.css">

	<!--Callout-->
	<link rel="stylesheet" type="text/css" href="css/callout/callout.css">

	
    <!--DataTable-->
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
</head>

<body>
	<style type="text/css">
	

	</style>


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
	
			<?php 
					//inclure la navbar
					include ("navbar.php");
			?>
	
	

	<div class='container'>
		<h1>Articles</h1>

        <div class="card">
            <div class="card-header">
                <h6>Liste d'articles</h6>
            </div>

            <div class="card-body">

                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#article-modal">Ajouter un article</button>

                <table class="table table-bordered boostrap-datatable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix d'achat</th>
                            <th>Prix de vente</th>
                            <th></th>
                        </tr>
                    </thead>
					<tbody>
						<?php

							//affichage des articles 
							$view = $bdd->prepare("SELECT * FROM article WHERE id_user = ?");
							$view->execute(array($get_id));
							$i = 1;


							while($rows = $view->fetch())
							{
						?>
							<tr>
								<td><?php echo $i++ ?></td>
                                <td>
									<img src="images/articles/<?php echo $rows['photo'] ?>.png" alt="" srcset="" class="rounded-circle" width="30">
									&nbsp;&nbsp;
									<?php echo $rows['name'] ?>
								</td>
								<td>
									<?php 
										//on récupère le nom de la catégorie d'articles
										//on récupère toutes les catégories d'articles de l'utilisateurs
										$get_cat_name = $bdd->prepare("SELECT * FROM cat_article WHERE id = ?");
										$get_cat_name->execute(array($rows['id_cat_art']));
										$info_cat = $get_cat_name->fetch();

										echo $info_cat['name'];

									?>
								</td>
								<td><?php echo $rows['prix_achat'] ?> EUR</td>
								<td><?php echo $rows['prix_vente'] ?> EUR</td>
								<td> <a href="view_article.php?id=<?php echo $get_id ?>&id_art=<?php echo $rows['id'] ?>">Afficher</a> </td>
							</tr>

						<?php
							}
						?>
					</tbody>
                </table>
            
            </div>
        </div>
	</div>

	<!-- Modal -->
    <div class="modal fade" id="article-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="cat-article-form">
                    <div class="form-group row">
                        <label for="name-article" class="col-sm-4 col-form-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="name-article" name="name-article" placeholder="Nom de l'article">
						</div>
                    </div>

					<div class="form-group row">
                        <label for="cat-article" class="col-sm-4 col-form-label">Catégorie d'articles</label>
						<div class="col-sm-8">
							<select name="cat-article" id="cat-article" class="custom-select">
								<option value="" selected>Séléctionnez une catégorie d'articles</option>

								<?php
									
									//on récupère toutes les catégories d'articles de l'utilisateurs
									$view_cat_art = $bdd->prepare("SELECT * FROM cat_article WHERE id_user = ?");
									$view_cat_art->execute(array($get_id));

									while($rows_cat = $view_cat_art->fetch())
                            		{
								?>	
										<option value="<?php echo $rows_cat['id']; ?>"><?php echo $rows_cat['name']; ?></option>
								<?php
									}
								?>

							</select>
						</div>
                    </div>

					<div class="form-group row">
                        <label for="prix-achat-article" class="col-sm-4 col-form-label">Prix d'achat</label>
						<div class="col-sm-8">
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="prix-achat-article" name="prix-achat-article" placeholder="0.00">
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon2">EUR</span>
								</div>
							</div>
						</div>
                    </div>

					<div class="form-group row">
                        <label for="prix-vente-article" class="col-sm-4 col-form-label">Prix de vente</label>
						<div class="col-sm-8">
							<div class="input-group mb-3">
								<input type="text" class="form-control" id="prix-vente-article" name="prix-vente-article" placeholder="0.00">
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon2">EUR</span>
								</div>
							</div>
						</div>
                    </div>

					<div class="form-group row">
                        <label for="stock-article" class="col-sm-4 col-form-label">Nombre en Stock</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="stock-article" name="stock-article" placeholder="0">
						</div>
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save-article">Enregistrer</button>
            </div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/toastr/toastr.min.js"></script>
	<!--Cropper-->
	<script type="text/javascript" src="cropper/js/cropper.js"></script>
	<!--<script type="text/javascript" src="cropper/js/custom.js"></script>-->

	<!--DataTables-->
	<script type="text/javascript" src="DataTables/datatables.js"></script>

	<script type="text/javascript">
        
        //l'id de l'utilisateur
        var get_id = "<?php echo $get_id ?>";

        //init datatable
        $('.boostrap-datatable').DataTable({
            lengthMenu:[ [5,10, 20, 50, -1], [5, 10, 20, 50, "Tout"] ], 
            "language": {
                "lengthMenu" : "Afficher les _MENU_ premiers enregistrements",
                "zeroRecords": "Désolé - Aucun enregistrement trouvé",
                "emptyTable": "Aucune donnée disponible", 
                "info": "Affichage de la page _PAGE_ sur _PAGES_",
                "infoEmpty": "Aucun enregistrement disponible",
                "infoFiltered" : "(filtré de _MAX_ enregistrements au total)",
                "search" : "Rechercher",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next" : "Suivant",
                    "previous": "Précédent",
                },
            }
        });


        //enregistrement des articles
        $('#save-article').click(function(){
            
            var name_article = $('#name-article').val();
			var cat_article = $('#cat-article').val();
			var prix_achat_article = $('#prix-achat-article').val();
			var prix_vente_article = $('#prix-vente-article').val();
			var stock_article = $('#stock-article').val();


            if(name_article != "")
            {
                $('#name-article').removeClass('is-invalid');

				if(cat_article != "")
				{
					$('#cat-article').removeClass('is-invalid');

					if(prix_achat_article != "" && (/^[0-9]*[.][0-9]+$/.test(prix_achat_article) || /^[0-9]+$/.test(prix_achat_article)))
					{
						$('#prix-achat-article').removeClass('is-invalid');

						if(prix_vente_article != "" && (/^[0-9]*[.][0-9]+$/.test(prix_vente_article) || /^[0-9]+$/.test(prix_vente_article)))
						{
							$('#prix-vente-article').removeClass('is-invalid');

							if(stock_article != "" && /^[0-9]+$/.test(stock_article))
							{
								$('#stock-article').removeClass('is-invalid');

								$.ajax({
									type : 'POST', 
									url : 'add_article.php', 
									data: 	'name_article=' + name_article + '&cat_article=' + cat_article + '&prix_achat_article=' + prix_achat_article + 
											'&prix_vente_article=' + prix_vente_article + '&stock_article=' + stock_article + '&get_id=' + get_id,
									success:function(data)
									{
										if(data == "success")
										{
											$('#article-modal').modal('hide');

											valide("Article ajoutée avec succès!");

											setTimeout(function(){
														location.reload();
													}, 5000);
										}
										else
										{
											error("Erreur lors de l'enregistrement l'article!")
										}
									}
								});


							}
							else
							{
								error("stock invalide!");
                				$('#stock-article').addClass('is-invalid');
							}
						}
						else
						{
							error("Prix de vente invalide!");
                			$('#prix-vente-article').addClass('is-invalid');
						}
					}
					else
					{
						error("Prix d'achat invalide!");
                		$('#prix-achat-article').addClass('is-invalid');
					}
				}
				else
				{
					error("Veuillez au moins séléctionner une catégorie!");
                	$('#cat-article').addClass('is-invalid');
				}
            }   
            else
            {
                error("Le nom de l'article ne doit pas être vide!");
                $('#name-article').addClass('is-invalid');
            }
        });


        //message toastr d'erreur
			function error(element)
			{
			    toastr.error(element,'Erreur',{
			        "positionClass": "toast-bottom-center",
			        timeOut: 5000,
			        "closeButton": true,
			        "debug": false,
			        "newestOnTop": true,
			        "progressBar": true,
			        "preventDuplicates": true,
			        "onclick": null,
			        "showDuration": "300",
			        "hideDuration": "1000",
			        "extendedTimeOut": "1000",
			        "showEasing": "swing",
			        "hideEasing": "linear",
			        "showMethod": "fadeIn",
			        "hideMethod": "fadeOut",
			        "tapToDismiss": false

			    });
			}

			//message toastr succès 
			function valide(element)
			{
					toastr.success(element,'Validé',{
			        "positionClass": "toast-bottom-center",
			        timeOut: 5000,
			        "closeButton": true,
			        "debug": false,
			        "newestOnTop": true,
			        "progressBar": true,
			        "preventDuplicates": true,
			        "onclick": null,
			        "showDuration": "300",
			        "hideDuration": "1000",
			        "extendedTimeOut": "1000",
			        "showEasing": "swing",
			        "hideEasing": "linear",
			        "showMethod": "fadeIn",
			        "hideMethod": "fadeOut",
			        "tapToDismiss": false

			    });
			}
	</script>
</body>

<?php
		}
		else
		{
			header('location:index.php');
		}
?>
</html>