<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>TensorFlow.js: Tuberculosis Detector</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Use the power of Machine Learning to diagnose TB from chest x-rays.">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
	<style>
		body {
			min-height: 75rem;
			padding-top: 4.5rem;
		}

		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="/index.html">Authentification facial</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
			aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="/index.html">Acceuil <span class="sr-only">(current)</span></a>
				</li>
		</div>
	</nav>

	<main role="main" class="container mt-5">
		<div class="row">
			<div class="col-12">
				<div class="progress progress-bar progress-bar-striped progress-bar-animated mb-2">chargement du model
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-6">
				<div id="my_camera"></div>
			</div>

			<div class="col-6">
				<div id="results"></div>
			</div>
		</div>
		<br><br><br>
		<div class="col-6 text-center">
			<input type=button class="btn btn-primary text-center" value="Prendre une photo" onClick="take_snapshot()">
			<button id="predict-button" class="btn btn-danger float-right">V??rifier mon identit??</button>
		</div>
		<hr>
		<div class="row">
			<div class="col-6">
				<h2 class="ml-3">Reconnaisance</h2>
				<ol id="prediction-list"></ol>
			</div>
		</div>
	</main>
	<style>
		#my_camera {
			width: 320px;
			height: 240px;
			border: 1px solid black;
		}
	</style>
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach('#my_camera');
		// <!-- Code to handle taking the snapshot and displaying it locally -->
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap(function (data_uri) {
				// display results in page
				document.getElementById('results').innerHTML =
					'<img id="toto"src="' + data_uri + '"/>';
			});
		}

	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js"></script>
	<script src="target_classes.js"></script>
	<script src="predict.js"> </script>
</body>

</html>