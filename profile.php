<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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
</head>

<body>
	<style type="text/css">
		.photo-profile
		{
			width: 200px;
		}

		#image
		{
			height: 400px;
		}

		.informations-form, .change-password-form
		{
			display: none;
		}

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
		<div class="row">
			<div class="col-md-4">
				<div class="bs-callout bs-callout-primary text-center">
					<img class="rounded-circle photo-profile" src="profil/<?php echo $infos_user['profile']; ?>.png">
					<br><br>
					<button role="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-profile">Modifier</button>
				</div>
			</div>

			<div class="col-md-8">
				<div class="bs-callout bs-callout-success">
					<div class="informations">

						<div class="row">
							<div class="col-md-8">
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
							<div class="col-md-4">
								<button class="btn btn-success btn-block" id="edit-profile">Modifier</button>
								<button class="btn btn-secondary btn-block" id="edit-password">Modifier le mot de passe</button>
							</div>
						</div>

					</div>

					<div class="informations-form">
							
						<div class="form-group row">
						    <label for="inputPassword" class="col-sm-4 col-form-label">Civilité</label>
						    <div class="col-sm-8">
						      <select class="custom-select" id="civilite">
						      	<option value="<?php echo $infos_user['civilite']; ?>" selected=""><?php echo $infos_user['civilite']; ?></option>
						      	<option value="Monsieur">Monsieur</option>
						      	<option value="Madame">Madame</option>
						      </select>
						    </div>
						</div>

						<div class="form-group row">
						    <label for="inputPassword" class="col-sm-4 col-form-label">Nom</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="nom" value="<?php echo $infos_user['name']; ?>">
						    </div>
						</div>

						<div class="form-group row">
						    <label for="inputPassword" class="col-sm-4 col-form-label">Prénom</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="surname" value="<?php echo $infos_user['surname']; ?>">
						    </div>
						</div>

						<div class="form-group row">
						    <label for="inputPassword" class="col-sm-4 col-form-label">Date de naissance</label>
						    <div class="col-sm-8">
						      <input type="date" class="form-control" id="date_naissance" value="<?php echo $infos_user['date_naissance']; ?>">
						    </div>
						</div>

						<div class="form-group row">
						    <label for="inputPassword" class="col-sm-4 col-form-label">Adresse</label>
						    <div class="col-sm-8">
						      <textarea class="form-control" rows="3" id="adresse"><?php echo $infos_user['adresse']; ?></textarea>
						    </div>
						</div>

						<div class="form-group row">
						    <label for="inputPassword" class="col-sm-4 col-form-label">Adresse émail</label>
						    <div class="col-sm-8">
						      <input type="email" class="form-control" id="emailadresse" value="<?php echo $infos_user['email']; ?>">
						    </div>
						</div>

						<div class="btn-group" role="group" aria-label="Basic example">
						  <button type="button" class="btn btn-success" id="save-info">Enregistrer</button>
						  <button type="button" class="btn btn-danger cancel-info" >Annuler</button>
						</div>
						

					</div>

					<div class="change-password-form">

						<div class="form-group row">
							<label for="current-password" class="col-sm-4 col-form-label">Mot de passe actuel</label>
						    <div class="col-sm-8">
						      	<input type="password" class="form-control" id="current-password" value="">
						    </div>
						</div>

						<div class="form-group row">
							<label for="new-password" class="col-sm-4 col-form-label">Nouveau mot de passe</label>
						    <div class="col-sm-8">
						      	<input type="password" class="form-control" id="new-password" value="">
						    </div>
						</div>

						<div class="form-group row">
							<label for="new-password-confirm" class="col-sm-4 col-form-label">Confirrmation mot de passe</label>
						    <div class="col-sm-8">
						      	<input type="password" class="form-control" id="new-password-confirm" value="">
						    </div>
						</div>

						<div class="btn-group" role="group" aria-label="Basic example">
						  <button type="button" class="btn btn-success" id="save-password">Enregistrer le mot de passe</button>
						  <button type="button" class="btn btn-danger cancel-info">Annuler</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modifier la photo de profile</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        
	      	<div class="img-container1">
		        <img id="image" src="profil/<?php echo $infos_user['profile']; ?>.png" alt="Picture">
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

	<script type="text/javascript">


		$('#edit-profile').click(function()
			{
				$('.informations').css('display', 'none');
				$('.informations-form').css('display', 'block');
			});

		$('.cancel-info').click(function()
			{
				$('.informations').css('display', 'block');
				$('.informations-form').css('display', 'none');
				$('.change-password-form').css('display', 'none');
			});
		
		$('#edit-password').click(function()
			{
				$('.informations').css('display', 'none');
				$('.change-password-form').css('display', 'block');
			});
		

		$('#save-password').click(function(){
			
			var current_pwd = $('#current-password').val();
			var new_pwd = $('#new-password').val();
			var new_pwd_confirm = $('#new-password-confirm').val();
			var taille_pwd = new_pwd.length;
			var user_id = "<?php echo $get_id; ?>";

			if(taille_pwd > 8)
			{
				$('#new-password').removeClass('is-invalid');
				
				if(new_pwd == new_pwd_confirm)
				{
					$('#new-password-confirm').removeClass('is-invalid');

					$.ajax({
						type:'POST', 
						url:'update_password.php',
						data:'user_id=' + user_id + '&new_pwd='+ new_pwd + '&current_pwd=' + current_pwd,
						success:function(data)
						{
							if(data == "success")
							{
								valide("Mot de passe enregistré avec succès!");

								setTimeout(function(){
									location.reload();
								}, 5000);
							}
							else
							{
								error("Le mot de saisie ne correspond pas au mot de passe actuel!");
								$('#current-password').addClass('is-invalid');
							}
						}
					});
				}
				else
				{
					error("Les 2 mot de passes doivent correspondre!");
					$('#new-password-confirm').addClass('is-invalid');
				}
			}
			else
			{
				error("Le nouveau mot de passe doit contenir au moins 8 caractères!");
				$('#new-password').addClass('is-invalid');
			}
		});

		//Enregistrement des informations de profil
		$('#save-info').click(function(){

			var civilite = $('#civilite').val();
			var nom = $('#nom').val();
			var surname = $('#surname').val();
			var date_naissance = $('#date_naissance').val();
			var adresse = $('#adresse').val();
			var emailadresse = $('#emailadresse').val();
			var user_id = "<?php echo $get_id; ?>";

			if(nom != "")
			{
				$("#nom").removeClass("is-invalid");

				if(surname != "")
				{
					$("#surname").removeClass("is-invalid");

					if(adresse != "")
					{
						$("#removeClass").addClass("is-invalid");

						if(emailadresse != "")
						{
							$("#emailadresse").removeClass("is-invalid");
							
							$.ajax({
								type : 'POST', 
								url: 'update_user.php', 
								data: 	'user_id=' + user_id + '&civilite=' + civilite + 
										'&nom=' + nom + '&surname=' + surname + 
										'&date_naissance=' + date_naissance + 
										'&adresse=' + adresse + '&emailadresse=' + emailadresse,
								success:function(data)
								{
									valide("Informations enregistrées avec succès!");

									setTimeout(function(){
										location.reload();
									}, 5000);
								}
							});
						}
						else
						{
							$("#emailadresse").addClass("is-invalid");
							error("L'adresse émail ne doit être vide!");
						}
					}	
					else
					{
						$("#adresse").addClass("is-invalid");
						error("L'adresse ne doit être vide!");
					}
				}
				else
				{
					$("#surname").addClass("is-invalid");
					error("Le prénom ne doit être vide!");
				}
			}
			else
			{
				$("#nom").addClass("is-invalid");
				error("Le nom ne doit être vide!");
			}
		});



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
		              var getid = "<?php echo $get_id; ?>"

		              //rognage de l'image
		              $.ajax(
		                {
		                  type  : 'POST', 
		                  url   : 'save_profile.php',
		                  data  : {
		                    base64 : image, getid : getid
		                  },
		                  success:function(donnee)
		                  {
		                  	//alert(donnee);
		                  	valide("Photo de profile enregistrée avec succès.");
		                  	
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