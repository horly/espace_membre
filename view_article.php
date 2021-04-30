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
	#image
		{
			height: 400px;
		}

	</style>


	<?php
		if(isset($_GET['id']) AND $_GET['id'] > 0 AND isset($_GET['id_art']) AND $_GET['id_art'] > 0)
		{
			//connexion à la base de données 
			include('connexting_database.php');

			$get_id = $_GET['id']; 
            $id_art = $_GET['id_art'];

			//on récupère les informations de l'utilisateurs 
			$get_user = $bdd->prepare("SELECT * FROM user WHERE id = ?");
			$get_user->execute(array($get_id));

			$infos_user = $get_user->fetch();

            //on récupère les détails d'une catégorie d'article 
            $get_art = $bdd->prepare("SELECT * FROM article WHERE id = ?");
            $get_art->execute(array($id_art));

            $info_art = $get_art->fetch();

	?>
	
			<?php 
					//inclure la navbar
					include ("navbar.php");
			?>
	
	

	<div class='container'>

        <div class="card">
            <div class="card-header">
                <h5>Détails article : <?php echo $info_art['name']; ?></h3>
            </div>
            <div class="card-body">

                <button class="btn btn-primary" data-toggle="modal" data-target="#article-modal">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Modifier
                </button>
                <button class="btn btn-danger" id="delete-art">
                <i class="fa fa-trash" aria-hidden="true"></i>
                    Supprimer
                </button>

                <div class="row">
                    <div class="col-md-6">
                        <div class="bs-callout bs-callout-success">
                            <div class="row">
                                <div class="col-md-5">Nom</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo $info_art['name']; ?></div>   
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-5">Catégorie</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5" >
                                    <?php
                                        $get_name_cat = $bdd->prepare("SELECT * FROM cat_article WHERE id = ?");
                                        $get_name_cat->execute(array($info_art['id_cat_art']));
                                        $info_cat_art = $get_name_cat->fetch();

                                        echo $info_cat_art['name'];
                                    ?>
                                </div>   
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-5">Prix d'achat</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo $info_art['prix_achat']; ?> EUR</div>   
                            </div>
                            
                            <br>

                            <div class="row">
                                <div class="col-md-5">Prix de vente</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo $info_art['prix_vente']; ?> EUR</div>   
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bs-callout bs-callout-success">

                            <div class="row">
                                <div class="col-md-5">Nombre en stock</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo $info_art['stock']; ?></div>   
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-5">Crée le </div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo date('d/m/Y' . ' à ' . 'H:i:s' , strtotime($info_art['createdAt'])); ?></div>   
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-5">Modifié le</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5"><?php echo date('d/m/Y' . ' à ' . 'H:i:s' , strtotime($info_art['updatedAt']));  ?></div>   
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-5">Ajouté par</div>
                                <div class="col-md-2">:</div>
                                <div class="col-md-5" >
                                    <?php
                                        $get_name_user = $bdd->prepare("SELECT * FROM user WHERE id = ?");
                                        $get_name_user->execute(array($info_art['id_user']));
                                        $info_user = $get_name_user->fetch();

                                        echo $info_user['name'] . ' ' . $info_user['surname'];
                                    ?>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bs-callout bs-callout-success">
                    <img src="images/articles/<?php echo $info_art['photo']?>.png" alt="" class="rounded-circle" width="150">
                    &nbsp;&nbsp;
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-image-article">
                        Modifier l'image
                    </button>
                </div>
                

                
            </div>
        </div>

        
	</div>

    <!-- Modal -->
    <div class="modal fade" id="article-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier un article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="cat-article-form">
                    <div class="form-group row">
                        <label for="name-article" class="col-sm-4 col-form-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php echo $info_art['name']; ?>" id="name-article" name="name-article" placeholder="Nom de l'article">
						</div>
                    </div>

					<div class="form-group row">
                        <label for="cat-article" class="col-sm-4 col-form-label">Catégorie d'articles</label>
						<div class="col-sm-8">
							<select name="cat-article" id="cat-article" class="custom-select">

                                <?php
                                    $get_default_cat = $bdd->prepare("SELECT * FROM cat_article WHERE id = ?");
                                    $get_default_cat->execute(array($info_art['id_cat_art']));
                                    $cat_name_info = $get_default_cat->fetch();
                                ?>
								    <option value="<?php echo $cat_name_info['id']; ?>" selected><?php echo $cat_name_info['name']; ?></option>

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
								<input type="text" class="form-control" value="<?php echo $info_art['prix_achat']; ?>" id="prix-achat-article" name="prix-achat-article" placeholder="0.00">
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
								<input type="text" class="form-control" value="<?php echo $info_art['prix_vente']; ?>" id="prix-vente-article" name="prix-vente-article" placeholder="0.00">
								<div class="input-group-append">
									<span class="input-group-text" id="basic-addon2">EUR</span>
								</div>
							</div>
						</div>
                    </div>

					<div class="form-group row">
                        <label for="stock-article" class="col-sm-4 col-form-label">Nombre en Stock</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php echo $info_art['stock']; ?>" id="stock-article" name="stock-article" placeholder="0">
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


    <!-- Modal -->
	<div class="modal fade" id="modal-image-article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modifier l'image de l'article</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        
	      	<div class="img-container1">
		        <img id="image" src="images/articles/<?php echo $info_art['photo']; ?>.png" alt="Picture">
		    </div>

		    <label>&nbsp;</label>
		    <label class="btn btn-light border btn-upload" for="inputImage" title="Upload image file">
		        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
		        Importer...
		    </label>
		    <br>
		    &nbsp;
		    <div class="docs-buttons">

		        <!-- <div class="btn-group">
		           <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Bouger">
		             <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		               <span class="fa fa-arrows"></span>
		             </span>
		           </button>
		           <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Rogner">
		             <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		               <span class="fa fa-crop"></span>
		             </span>
		           </button>
		         </div>-->
		        &nbsp;&nbsp;
		        <div class="btn-group">
		            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom Avant">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" >
		        <span class="fa fa-search-plus"></span>
		      </span>
		            </button>
		            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Arrière">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-search-minus"></span>
		      </span>
		            </button>
		        </div>

		        <div class="btn-group">
		            <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Déplacer à gauche">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-arrow-left">&nbsp;</span>
		      </span>
		            </button>
		            <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Déplacer à droite">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-arrow-right"></span>
		      </span>
		            </button>
		        </div>

		        <div class="btn-group">
		            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Déplacer en haut">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-arrow-up"></span>
		      </span>
		            </button>
		            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Déplacer en bas">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-arrow-down"></span>
		      </span>
		            </button>
		        </div>

		        <div class="btn-group">
		            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Tourne à gauche">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-rotate-left">&nbsp;</span>
		      </span>
		            </button>
		            <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Tourne à droite">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-rotate-right"></span>
		      </span>
		            </button>
		        </div>

		        <div class="btn-group">
		            <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Retourner horizontalement">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-arrows-h"></span>
		      </span>
		            </button>
		            <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Retourner verticalement">
		      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
		        <span class="fa fa-arrows-v">&nbsp;&nbsp;</span>
		      </span>
		            </button>
		        </div>

		    </div>

	      </div>
	      <div class="modal-footer docs-buttons">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	        <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">Enregistrer</button>
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
        var id_art = "<?php echo $id_art; ?>";

        //mise à jour  d'un article
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
									url : 'update_article.php', 
									data: 	'name_article=' + name_article + '&cat_article=' + cat_article + '&prix_achat_article=' + prix_achat_article + 
											'&prix_vente_article=' + prix_vente_article + '&stock_article=' + stock_article + '&id_art=' + id_art +'&get_id=' + get_id,
									success:function(data)
									{
										if(data == "success")
										{
											$('#article-modal').modal('hide');

											valide("Article modifié avec succès!");

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


        //supprimer un aticle
        $('#delete-art').click(function(){

            swal({
                title: "Confirmation!", 
                text: "Voulez-vous vraiment supprimer cet article ?",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "YES",
                cancelButtonText: "NO",
                closeOnConfirm: false
            }, function(){
                
                deleteArt();

                swal({
                    title: "Succès !",
                    text: "Articles supprimé avec succès!",
                    type: "success",
                    confirmButtonColor: "#28a745",
                }, function(){

                    window.location = 'article.php?id=' + get_id;
                });
                
            });
        });

        //suppression d'une article
        function deleteArt()
        {
            $.ajax({
                type : 'POST',
                url: 'delete_art.php', 
                data: 'id_art=' + id_art,
                success:function(data)
                {
                    //rien à afficher
                }
            });
        }

        cropperpage();

		function cropperpage()
		{
		  // Methods cropper
		    'use strict';

		    var console = window.console || { log: function () {} };
		    var URL = window.URL || window.webkitURL;
		    var $image = $('#image');
		    var $download = $('#download');
		    var $dataX = $('#dataX');
		    var $dataY = $('#dataY');
		    var $dataHeight = $('#dataHeight');
		    var $dataWidth = $('#dataWidth');
		    var $dataRotate = $('#dataRotate');
		    var $dataScaleX = $('#dataScaleX');
		    var $dataScaleY = $('#dataScaleY');
		    var options = {
		      aspectRatio: 1 / 1,
		      preview: '.img-preview',
		      minContainerWidth: 465,
		      minContainerHeight: 400,
		      viewMode: 3,
		      crop: function (e) {
		        $dataX.val(Math.round(e.detail.x));
		        $dataY.val(Math.round(e.detail.y));
		        $dataHeight.val(Math.round(e.detail.height));
		        $dataWidth.val(Math.round(e.detail.width));
		        $dataRotate.val(e.detail.rotate);
		        $dataScaleX.val(e.detail.scaleX);
		        $dataScaleY.val(e.detail.scaleY);
		      }
		    };

		    
		    var originalImageURL = $image.attr('src');
		    var uploadedImageName = 'cropped.jpg';
		    var uploadedImageType = 'image/jpeg';
		    var uploadedImageURL;

		    // Tooltip
		    //$('[data-toggle="tooltip"]').tooltip();

		    // Cropper
		    $image.on({
		      ready: function (e) {
		        console.log(e.type);
		      },
		      cropstart: function (e) {
		        console.log(e.type, e.detail.action);
		      },
		      cropmove: function (e) {
		        console.log(e.type, e.detail.action);
		      },
		      cropend: function (e) {
		        console.log(e.type, e.detail.action);
		      },
		      crop: function (e) {
		        console.log(e.type);
		      },
		      zoom: function (e) {
		        console.log(e.type, e.detail.ratio);
		      }
		    }).cropper(options);

		    // Buttons
		    if (!$.isFunction(document.createElement('canvas').getContext)) {
		      $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
		    }

		    if (typeof document.createElement('cropper').style.transition === 'undefined') {
		      $('button[data-method="rotate"]').prop('disabled', true);
		      $('button[data-method="scale"]').prop('disabled', true);
		    }

		    // Download
		    /*if (typeof $download[0].download === 'undefined') {
		      $download.addClass('disabled');
		    }*/

		    // Options
		    $('.docs-toggles').on('change', 'input', function () {
		      var $this = $(this);
		      var name = $this.attr('name');
		      var type = $this.prop('type');
		      var cropBoxData;
		      var canvasData;

		      if (!$image.data('cropper')) {
		        return;
		      }

		      if (type === 'checkbox') {
		        options[name] = $this.prop('checked');
		        cropBoxData = $image.cropper('getCropBoxData');
		        canvasData = $image.cropper('getCanvasData');

		        options.ready = function () {
		          $image.cropper('setCropBoxData', cropBoxData);
		          $image.cropper('setCanvasData', canvasData);
		        };
		      } else if (type === 'radio') {
		        options[name] = $this.val();
		      }

		      $image.cropper('destroy').cropper(options);
		    });

		    // Methods
		    $('.docs-buttons').on('click', '[data-method]', function () {
		      var $this = $(this);
		      var data = $this.data();
		      var cropper = $image.data('cropper');
		      var cropped;
		      var $target;
		      var result; 

		      if ($this.prop('disabled') || $this.hasClass('disabled')) {
		        return;
		      }

		      if (cropper && data.method) {
		        data = $.extend({}, data); // Clone a new one

		        if (typeof data.target !== 'undefined') {
		          $target = $(data.target);

		          if (typeof data.option === 'undefined') {
		            try {
		              data.option = JSON.parse($target.val());
		            } catch (e) {
		              console.log(e.message);
		            }
		          }
		        }

		        cropped = cropper.cropped;

		        switch (data.method) {
		          case 'rotate':
		            if (cropped && options.viewMode > 0) {
		              $image.cropper('clear');
		            }

		            break;

		          case 'getCroppedCanvas':
		            if (uploadedImageType === 'image/jpeg') {
		              if (!data.option) {
		                data.option = {};
		              }

		              data.option.fillColor = '#fff';
		            }

		            break;
		        }

		        result = $image.cropper(data.method, data.option, data.secondOption);

		        switch (data.method) {
		          case 'rotate':
		            if (cropped && options.viewMode > 0) {
		              $image.cropper('crop');
		            }

		            break;

		          case 'scaleX':
		          case 'scaleY':
		            $(this).data('option', -data.option);
		            break;

		          case 'getCroppedCanvas':
		            if (result) {
		              // Bootstrap's Modal
		              //alert(result.toDataURL(uploadedImageType));
		              //$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

		              var image = result.toDataURL(uploadedImageType);


		              //rognage de l'image
		              $.ajax(
		                {
		                  type  : 'POST', 
		                  url   : 'save_photo_image.php',
		                  data  : {
		                    base64 : image, id_art : id_art
		                  },
		                  success:function(donnee)
		                  {
		                  	//alert(donnee);
                            $('#modal-image-article').modal('hide');
                            
		                  	valide("L'image de l'article a été enregistré avec succès.");
		                  	
		                    setTimeout(function()
		                      {
		                         window.location.reload(); 
		                      }, 5000);
		                  }
		                });

		              if (!$download.hasClass('disabled')) {
		                download.download = uploadedImageName;
		                $download.attr('href', result.toDataURL(uploadedImageType));
		              }
		            }

		            break;

		          case 'destroy':
		            if (uploadedImageURL) {
		              URL.revokeObjectURL(uploadedImageURL);
		              uploadedImageURL = '';
		              $image.attr('src', originalImageURL);
		            }

		            break;

		        }

		        if ($.isPlainObject(result) && $target) {
		          try {
		            $target.val(JSON.stringify(result));
		          } catch (e) {
		            console.log(e.message);
		          }
		        }
		      }
		    });

		    // Keyboard
		    $(document.body).on('keydown', function (e) {
		      if (e.target !== this || !$image.data('cropper') || this.scrollTop > 300) {
		        return;
		      }

		      switch (e.which) {
		        case 37:
		          e.preventDefault();
		          $image.cropper('move', -1, 0);
		          break;

		        case 38:
		          e.preventDefault();
		          $image.cropper('move', 0, -1);
		          break;

		        case 39:
		          e.preventDefault();
		          $image.cropper('move', 1, 0);
		          break;

		        case 40:
		          e.preventDefault();
		          $image.cropper('move', 0, 1);
		          break;
		      }
		    });

		    // Import image
		    var $inputImage = $('#inputImage');

		    if (URL) {
		      $inputImage.change(function () {
		        var files = this.files;
		        var file;

		        if (!$image.data('cropper')) {
		          return;
		        }

		        if (files && files.length) {
		          file = files[0];

		          if (/^image\/\w+$/.test(file.type)) {
		            uploadedImageName = file.name;
		            uploadedImageType = file.type;

		            if (uploadedImageURL) {
		              URL.revokeObjectURL(uploadedImageURL);
		            }

		            uploadedImageURL = URL.createObjectURL(file);
		            $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
		            $inputImage.val('');
		          } else {
		            window.alert("Votre fichier doit être au format jpg, jpeg, png ou gif.");
		          }
		        }
		      });
		    } else {
		      $inputImage.prop('disabled', true).parent().addClass('disabled');
		    }
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