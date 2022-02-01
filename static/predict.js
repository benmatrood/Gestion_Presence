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
	// console.log(predictions);
	predictions.forEach((mot,index) => {
		// console.log(mot);
		if (mot >= 0.65 && index==1) {
			console.log("ben"+ ":" + ""+mot)
			const resultat=document.getElementById("prediction-list")
			$("#prediction-list").append(`<li> Ben : ${mot.toFixed(2)*100} %</li>`);
			setTimeout(() => {  window.location.href = "uers/user_home.php";}, 2000);
			
		}
		else if(mot >= 0.65 && index==0) {
			console.log("Kevin"+ ":" + ""+mot)
			const resultat=document.getElementById("prediction-list")
			$("#prediction-list").append(`<li> Kevin : ${mot.toFixed(2)*100} %</li>`);
			setTimeout(() => {  window.location.href = "user/user_home.php";}, 2000);
		}
	  });
	
});
