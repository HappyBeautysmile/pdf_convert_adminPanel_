@extends('layouts.app')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
<style>
#app{visibility:hidden!important;display:none!important}body{font-family:Raleway,sans-serif}.modal-roni{width:90%!important;padding:2rem!important}.modal-roni-button{width:100px!important}:root{--input-padding-x:1.5rem;--input-padding-y:0.75rem}.image,.login{min-height:100vh}.bg-image{background-image:url(/public/img/nature.jpg);background-size:cover;background-position:center}.login-heading{font-weight:300}.btn-login{font-size:.9rem;letter-spacing:.05rem;padding:.75rem 1rem;border-radius:.5rem}.form-label-group{position:relative;margin-bottom:1rem}.form-label-group>input,.form-label-group>label{padding:var(--input-padding-y) var(--input-padding-x);height:auto;border-radius:.5rem}.form-label-group>label{position:absolute;top:0;left:0;display:block;width:100%;margin-bottom:0;line-height:1.5;color:#495057;cursor:text;border:1px solid transparent;border-radius:.25rem;transition:all .1s ease-in-out}.form-label-group input::-webkit-input-placeholder{color:transparent}.form-label-group input:-ms-input-placeholder{color:transparent}.form-label-group input::-ms-input-placeholder{color:transparent}.form-label-group input::-moz-placeholder{color:transparent}.form-label-group input::placeholder{color:transparent}.form-label-group input:not(:placeholder-shown){padding-top:calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));padding-bottom:calc(var(--input-padding-y)/ 3)}.form-label-group input:not(:placeholder-shown)~label{padding-top:calc(var(--input-padding-y)/ 3);padding-bottom:calc(var(--input-padding-y)/ 3);font-size:12px;color:#777}@supports (-ms-ime-align:auto){.form-label-group>label{display:none}.form-label-group input::-ms-input-placeholder{color:#777}}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.form-label-group>label{display:none}.form-label-group input:-ms-input-placeholder{color:#777}}
</style>
<div class="container-fluid">
	<div class="row no-gutter">
		<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
		<div class="col-md-8 col-lg-6">
			<div class="login d-flex align-items-center py-5">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-lg-8 mx-auto">
							<h2 class="display-4">Bonjour :)</h2>
							<br>
							<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="form-label-group">
									<input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Entrer votre adresse email">
									<label for="email">Adresse email</label>
									@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
									@enderror
								</div>
								<div class="form-label-group">
									<input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe">
									<label for="password">Mot de passe</label>
									@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
									@enderror
								</div>
								<div class="custom-control custom-checkbox mb-3">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<label class="form-check-label" for="remember">Restez connecté</label>
								</div>
								<button class="btn btn-lg btn-warning btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Valider</button>
								<div class="text-center">
								<!--
								<a href="#" class="card-link"  data-toggle="modal" data-target="#staticBackdrop">Problème de connexion ?</a>
									<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg modal-dialog-centered">
											<div class="modal-content modal-roni text-center">
												<p class="h2 text-center" id="staticBackdropLabel">
													La page est en cours de construction
												</p>
												<p class="lead text-center">
													En attendant, vous pouvez contacter Roni Alain SONMEZ (hello@inorweb.com) :)
												</p>
												<div>
													<button type="button" class="btn btn-danger modal-roni-button" data-dismiss="modal">Fermer</button>
												</div>
											</div>
										</div>
									</div>
									-->
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>