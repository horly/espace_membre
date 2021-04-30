<!DOCTYPE html>
<html>
<head>
	<title>Espace membre</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/toastr/toastr.min.css">
</head>
<body>
	
			<?php 
					//inclure la navbar
					include ("navbar.php");
			?>

	<div class="container">
		<div class="row">

			<div class="col-md-4">
				<div class="card">
					<div class="card-header"><b>Se connecter</b></div>
					<div class="card-body">
						  <div class="form-group">
						    <label for="email">Adresse émail</label>
						    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Entrer une adresse émail">
						  </div>
						  <div class="form-group">
						    <label for="password">Mot de passe</label>
						    <input type="password" class="form-control" id="password" placeholder="Entrer le mot de passe">
						  </div>
						  <button type="submit" class="btn btn-primary" id="connexion">Connexion</button>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="card">
					<div class="card-header"><b>Inscription</b></div>
					<div class="card-body">
						
							<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Nom</label>
										<input type="text" class="form-control" name="name" id="name" placeholder="Entrer votre nom">
										<small id="error-name" class="form-text text-danger"></small>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="surname">Prénom</label>
										<input type="text" class="form-control" name="surname" id="surname" placeholder="Entrer votre prénom">
										<small id="error-surname" class="form-text text-danger"></small>
									</div>
								</div>

								<?php
									setlocale(LC_TIME, 'fr_FR');
									$date = date('Y-m-d');
								?>

								<div class="col-md-6">
									<div class="form-group">
										<label for="birthday">Date de naissance</label>
										<input type="date" class="form-control" name="birthday" id="birthday" value="<?php echo $date; ?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="genre">Civilité</label>
										<select class="form-control" name="genre" id="genre">
											<option value="monsieur" selected="">Monsieur</option>
											<option value="madame">Madame</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="adresse">Adresse</label>
										<textarea class="form-control" id="adresse" name="adresse" rows="4" placeholder="Entrer votre adresse"></textarea>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="email-inscrip">Email</label>
										<input type="email" class="form-control" id="email-inscrip" aria-describedby="emailHelp" placeholder="Entrer une adresse émail">
										<small id="error-email" class="form-text text-danger"></small>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="password-inscrip">Mot de passe</label>
						    			<input type="password" class="form-control" id="password-inscrip" placeholder="Créer un mot de passe">
						    			<small id="error-password" class="form-text text-danger"></small>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary" id="inscription">Inscription</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/toastr/toastr.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function()
		{
			//connexion de l'utilisateur
			$('#connexion').click(function()
				{
					var email = $('#email').val();
					var password = $('#password').val();

					if(email != '')
					{
						if(password != '')
						{
							$.ajax(
								{
									type 	: 'POST',
									url 	: 'verif_email.php',
									data 	: 'email=' + email, 
									success:function(data)
									{
										if(data == 1)
										{
											//on vérifie si le mot de passe est correcte ou existe
											$.ajax(
												{
													type 	: 'POST',
													url 	: 'verif_passoword.php', 
													data 	: 'password=' + password + '&email=' + email,
													success:function(donnee)
													{
														if(donnee == 1)
														{
															window.location = 'login.php?email=' + email;
														}
														else
														{
															$('#password').addClass('is-invalid');
															error('Le mot de passe est incorrecte!');
														}
													}
												});
										}
										else
										{
											$('#email').addClass('is-invalid');
											error('L\'adresse émail est incorrecte!');
										}
									}
								});
						}
						else
						{
							$('#password').addClass('is-invalid');
							error('Le mot de passe ne doit pas être vide!');
						}
					}
					else
					{
						$('#email').addClass('is-invalid');
						error('L\'adresse émail ne doit pas être vide!');
					}

				});

			//vérification de la saisie du nom
			$('#name').keyup(function()
				{
					var name = $('#name').val();

					if(/^[a-zA-Z]+$/.test(name) || name == '')
					{
						$('#name').removeClass('is-invalid');
						$('#error-name').text('');
					}
					else
					{
						$('#name').addClass('is-invalid');
						$('#error-name').text('Le nom ne doit contenir des chiffres.');
					}
				});

			//vérification de la saisie du prénom
			$('#surname').keyup(function()
				{
					var surname = $('#surname').val();

					if(/^[a-zA-Z]+$/.test(surname) || surname == '')
					{
						$('#surname').removeClass('is-invalid');
						$('#error-surname').text('');
					}
					else
					{
						$('#surname').addClass('is-invalid');
						$('#error-surname').text('Le prénom ne doit contenir des chiffres.');
					}
				});

			//vérification de la saisie de l'émail
			$('#email-inscrip').keyup(function()
				{
					var email = $('#email-inscrip').val();

					if(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email) || email == '')
					{
						$('#email-inscrip').removeClass('is-invalid');
						$('#error-email').text('');
					}
					else
					{
						$('#email-inscrip').addClass('is-invalid');
						$('#error-email').text("L'adresse émail est incorrecte !");
					}
				});

			//vérification de la saisie du mot de passe 
			$('#password-inscrip').keyup(function()
				{
					var password = $('#password-inscrip').val();
					var taille = password.length;

					if(taille > 8 || password == '')
					{
						$('#password-inscrip').removeClass('is-invalid');
						$('#error-password').text('');
					}
					else
					{
						$('#password-inscrip').addClass('is-invalid');
						$('#error-password').text('Le mot de passe doit contenir au moins 8 cacractères.');
					}
				});

			//lorsque l'utilisateur s'inscrit
			$('#inscription').click(function()
				{
					var name = $('#name').val();
					var surname = $('#surname').val();
					var birthday = $('#birthday').val();
					var genre = $('#genre').val();
					var adresse = $('#adresse').val();
					var email = $('#email-inscrip').val();
					var password = $('#password-inscrip').val();
					var taille = password.length;
					var date = '<?php echo $date; ?>';

					if(name != '')
					{
						if(surname != '')
						{
							if(adresse != '')
							{
								if(email != '')
								{
									if(password != '')
									{
										if(/^[a-zA-Z]+$/.test(name))
										{
											if(/^[a-zA-Z]+$/.test(surname))
											{
												if(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email))
												{
													if(taille > 8)
													{
														$.ajax(
															{
																type 	: 'POST', 
																url 	: 'add_new_user.php',
																data 	: 'name=' + name + '&surname=' + surname +
																		  '&birthday=' + birthday + '&genre=' + genre + 
																		  '&email=' + email + '&password=' + password + '&adresse=' + adresse,
																success:function(data)
																{
																	if(data == 1)
																	{
																		$('#email-inscrip').addClass('is-invalid');
																		error("Cette adresse émail est déjà utilisée.");
																	}
																	else
																	{
																		$('#name').val('');
																		$('#surname').val('');
																		$('#adresse').val('');
																		$('#email-inscrip').val('');
																		$('#password-inscrip').val('');
																		$('#birthday').val(date);

																		$('#name').removeClass('is-invalid');
																		$('#surname').removeClass('is-invalid');
																		$('#adresse').removeClass('is-invalid');
																		$('#email-inscrip').removeClass('is-invalid');
																		$('#password-inscrip').removeClass('is-invalid');

																		valide('L\'inscription a été effectué avec succès');
																	}
																}
															});
													}
													else
													{
														$('#password-inscrip').addClass('is-invalid');
														error('Le mot de passe doit contenir au moins 8 cacractères.');
													}
												}
												else
												{
													$('#email-inscrip').addClass('is-invalid');
													error("L'adresse émail est incorrecte !");
												}
											}
											else
											{
												$('#surname').addClass('is-invalid');
												error('Le prénom ne doit contenir des chiffres.');
											}
										}
										else
										{
											$('#name').addClass('is-invalid');
											error('Le nom ne doit contenir des chiffres.');
										}
									}
									else
									{
										error('Le mot de passe ne doit pas être vide !');
										$('#password-inscrip').addClass('is-invalid');
									}
								}
								else
								{
									error('L\'adresse émail ne doit pas être vide !');
									$('#email-inscrip').addClass('is-invalid');
								}
							}
							else
							{
								error('L\'adresse ne doit pas être vide !');
								$('#adresse').addClass('is-invalid');
							}
						}
						else
						{
							error('Le prénom ne doit pas être vide !');
							$('#surname').addClass('is-invalid');
						}
					}
					else
					{
						error('Le nom de doit pas être vide !');
						$('#name').addClass('is-invalid');
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
		});
	</script>
</body>
</html>