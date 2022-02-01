
const user_id = document.getElementById('user_id').textContent;
const user_email = document.getElementById('user_email').textContent;
const id_user = parseInt(user_id); 
console.log(id_user);
console.log(user_email);

let imageLoaded = false;
$("#image-selector").change(function () {
	imageLoaded = false;
	let reader = new FileReader();
	reader.onload = function () {
		let dataURL = reader.result;
		$("#selected-image").attr("src", dataURL);
		$("#prediction-list").empty();
		imageLoaded = true;
	}
	
	let file = $("#image-selector").prop('files')[0];
	reader.readAsDataURL(file);
});

let model;
let modelLoaded = false;
$( document ).ready(async function () {
	modelLoaded = false;
	$('.progress-bar').show();
    console.log( "Loading model..." );
    model = await tf.loadGraphModel('model/model.json');
    console.log( "Model loaded." );
	$('.progress-bar').hide();
	modelLoaded = true;
});

$("#predict-button").click(async function () {
	if (!modelLoaded) { alert("The model must be loaded first"); return; }
	// if (!imageLoaded) { alert("Please select "); return; }
	
	let image = $('#toto').get(0);
	
	// Pre-process the image
	console.log( "Loading image..." );
	let tensor = tf.browser.fromPixels(image, 3)
		.resizeNearestNeighbor([224, 224]) // change the image size
		.expandDims()
		.toFloat()
		.reverse(-1); // RGB -> BGR
	let predictions = await model.predict(tensor).data();
	
	let top5 = Array.from(predictions)
		.map(function (p, i) { // this is Array.map
			return {
				probability: p,
				className: TARGET_CLASSES[i] // we are selecting the value from the obj
			};
		}).sort(function (a, b) {
			return b.probability - a.probability;
		}).slice(0, 2);
	
		let name ='';
		let prob ='';

		
		
	top5.forEach(function (p) {
		
		if (p.probability >0.6) {
			name = (p.className);
			prob = p.probability;
			console.log(name);
			console.log(prob);
			
			function return_id(name){
				let id = 0;
				if (name.toLowerCase() == "kevin") {
					id = 23;
				}
				else if (name.toLowerCase() == "ben") {
					id = 22;
				}
				return id;
			}
			let id_ut = return_id(name);
			console.log(id_ut);

			if (id_ut == id_user) {
						console.log("Authentification réussie. Je vous redirige");	
						const resultat=document.getElementById("prediction-list")
						var toto_session = document.getElementById("session")
						resultat.setAttribute("class", "alert alert-success");
						$("#session").append(`<?=session_start();?>`)
						$("#prediction-list").append(`<li> ${name} : ${prob.toFixed(2)*100} %</li>
						<p>Welcom ${name} Authentification réussie. Je vous redirige</p>
						`); 
						setTimeout(() => {  window.location.href = "user/index.php"}, 3000);	
						// setTimeout(() => {  window.location.href = "user/user_home.php?id="+id_user*123456789987654321;}, 3000);	
			}else
			{
				const resultat=document.getElementById("prediction-list")
				resultat.setAttribute("class", "alert alert-danger");
				$("#prediction-list").append(`<p>${name} Tu veux me dupé !! c'est pas tes identifiants ça !!!</p>`);
				setTimeout(() => {  window.location.href = "logout.php";}, 2000);	
				console.log("Tu veux me dupé !! c'est pas tes identifiants ça !!!");
				
			}
		}
		});
		
});
