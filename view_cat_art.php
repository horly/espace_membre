<!DOCTYPE html>
<html>
<head>
	<title>Détails Catégorie article</title>
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

    <!-- sweetalert-->
    <link rel="stylesheet" type="text/css" href="sweetalert/sweetalert.css">
    
</head>

<body>
	<style type="text/css">
	

	</style>


	<?php
		if(isset($_GET['id']) AND $_GET['id'] > 0 AND isset($_GET['id_cat_art']) AND $_GET['id_cat_art'] > 0)
		{
			//connexion à la base de données 
			include('connexting_database.php');

			$get_id = $_GET['id']; 
            $id_cat_art = $_GET['id_cat_art'];

			//on récupère les informations de l'utilisateurs 
			$get_user = $bdd->prepare("SELECT * FROM user WHERE id = ?");
			$get_user->execute(array($get_id));

			$infos_user = $get_user->fetch();

            //on récupère les détails d'une catégorie d'article 
            $get_car_art = $bdd->prepare("SELECT * FROM cat_article WHERE id = ?");
            $get_car_art->execute(array($id_cat_art));

            $info_cat_art = $get_car_art->fetch();

	?>
	
			<?php 
					//inclure la navbar
					include ("navbar.php");
			?>
	
	

	<div class='container'>

        <div class="card">
            <div class="card-header">
                <h5>Détails catégorie : <?php echo $info_cat_art['name']; ?></h3>
            </div>
            <div class="card-body">

                <button class="btn btn-primary" data-toggle="modal" data-target="#cat-article-modal">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Modifier
                </button>
                <button class="btn btn-danger" id="delete-cat-art">
                <i class="fa fa-trash" aria-hidden="true"></i>
                    Supprimer
                </button>

                <div class="row">
                    <div class="col-md-6">
                        <div class="bs-callout bs-callout-success">
                            <div class="row">
                                <div class="col-md-5">Nom</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo $info_cat_art['name']; ?></div>   
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5">Nombre d'article</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5">
                                    <?php

                                        //récupération des articles qui appartient à une catégorie
                                        $get_art = $bdd->prepare("SELECT * FROM article WHERE id_cat_art  = ?");
                                        $get_art->execute(array($id_cat_art));
                                        $count = $get_art->rowCount();

                                        echo $count;

                                    ?>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bs-callout bs-callout-success">
                            <div class="row">
                                <div class="col-md-5">Crée le </div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo date('d/m/Y' . ' à ' . 'H:i:s' , strtotime($info_cat_art['createdAt'])); ?></div>   
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5">Modifié le</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo date('d/m/Y' . ' à ' . 'H:i:s' , strtotime($info_cat_art['updatedAt']));  ?></div>   
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <h5>Liste des articles</h5>
                <br>

                <table class="table table-bordered boostrap-datatable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            //affichage des articles d'une catégorie
                            $view = $bdd->prepare("SELECT * FROM article WHERE id_cat_art = ?");
                            $view->execute(array($id_cat_art));
                            $i = 1;


                            while($rows = $view->fetch())
                            {
                            ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $rows['name'] ?></td>
                            <?php
                            }
                        ?>
                    </tbody>

                </table>
                
            </div>
        </div>

        
	</div>


    <!-- Modal -->
    <div class="modal fade" id="cat-article-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier une catégorie d'articles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="cat-article-form">
                    <div class="form-group row">
                        <label for="name-cat-article" class="col-sm-4 col-form-label">Nom</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?php echo $info_cat_art['name']; ?>" id="name-cat-article" name="name-cat-article" placeholder="Nom de la catégorie">
                            </div>
                    </div>

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="save-cat-article">Enregistrer</button>
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

    <!-- sweetalert-->
    <script type="text/javascript" src="sweetalert/sweetalert.min.js"></script>

	<script type="text/javascript">
        
        //l'id de l'utilisateur
        var get_id = "<?php echo $get_id ?>";
        var id_cat_art = "<?php echo $id_cat_art; ?>";
        var nb_article = "<?php echo $count; ?>"

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


        //enregistrement des catégories d'articles
        $('#save-cat-article').click(function(){
            
            var name_cat_article = $('#name-cat-article').val();

            if(name_cat_article != "")
            {
                $('#name-cat-article').removeClass('is-invalid');

                $.ajax({
                    type:'POST',
                    url: 'update_cat_article.php',
                    data :'name_cat_article=' + name_cat_article + '&id_cat_art=' + id_cat_art,
                    success:function(data)
                    {
                        if(data == "success")
                        {
                            $('#cat-article-modal').modal('hide');
                            
                            valide("Catégorie d'article mis à jour avec succès!");

                            setTimeout(function(){
										location.reload();
									}, 5000);
                        }
                        else
                        {
                            error("Erreur lors de l'enregistrement de la catégorie!")
                        }
                    }

                });

            }   
            else
            {
                error("Le nom de la catégorie ne doit pas être vide!");
                $('#name-cat-article').addClass('is-invalid');
            }
        });


        //supprimer une catégorie d'aticle
        $('#delete-cat-art').click(function(){

            swal({
                title: "Confirmation!", 
                text: "Voulez-vous vraiment supprimer cette catégorie d'articles ?",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "YES",
                cancelButtonText: "NO",
                closeOnConfirm: false
            }, function(){
                
                if(nb_article == 0)
                {
                    deleteCatArt();

                    swal({
                        title: "Succès !",
                        text: "Catégorie d'articles supprimée avec succès!",
                        type: "success",
                        confirmButtonColor: "#28a745",
                    }, function(){

                        window.location = 'cat_article.php?id=' + get_id;
                    });
                }
                else
                {
                    swal("Erreur", "Impossible de supprimer cette catégorie d'articles, car elle contient des articles", "error");
                }      
                
            });
        });


        //suppression d'une catégorie d'articles
        function deleteCatArt()
        {
            $.ajax({
                type : 'POST',
                url: 'delete_cat_art.php', 
                data: 'id_cat_art=' + id_cat_art,
                success:function(data)
                {
                    //rien à afficher
                }
            });
        }


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