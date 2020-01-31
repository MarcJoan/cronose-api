<?php require '../views/layouts/head.php'; ?>
<body>
	<div class="container wrap row justify-content-center boder shadow" style="margin-top: 20px;">
		<h1 class="mb-4 mt-4">About us</h1>
		<p class="ml-4"><?= $lang[$displayLang]['aboutUsText'];?></p>
		<div id="Map2" style="width:950px;height:400px;"></div>
		<h2 class="pt-4">Localizaciones</h2>
		<div class="mb-4 mt-4"id="MyMap" style="width:950px;height:400px;"></div>
	</div>
	<script>

		$(document).ready(function(){

				var map = L.map('MyMap').setView([39.5994550, 2.9726290],9);

	      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	    	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    	    maxZoom: 20,
	    	    id: 'mapbox.light',
	          accessToken: 'pk.eyJ1IjoibWVuYTciLCJhIjoiY2szeThhZHUyMGlwNDNscDZoYmc1ZnMweiJ9.lTy9NAE_I_tyg7Xt04pihw'
	    	}).addTo(map);

				showDirections();
				function showDirections() {
					const url = (window.location.pathname.split('/')[3]) ? '/api/directions/'+window.location.pathname.split('/')[3] : '/api/directions' ;
					$.ajax({
						type: 'get',
						url: url,
						dataType: 'json',
						data: {},
						success: (data) => {
							if (data.status == 'success') {
								console.log(data.direction);
								$.each (data.direction, function(key, value) {
									console.log(value.latitude);
									 var point = L.marker([value.latitude,value.longitude]).addTo(map);
								});
							};
						},
						error: ((data) => {
							console.log(data);
						})
					});
				};

				//MAPA DE NUESTRA UBICACION

				var mapa = L.map('Map2',{
					fullscreenControl:{
						fullscreenCrontol: true,
					}
				}).setView([39.561627,3.199883],16);

				L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
						attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
						maxZoom: 20,
						id: 'mapbox.light',
						accessToken: 'pk.eyJ1IjoibWVuYTciLCJhIjoiY2szeThhZHUyMGlwNDNscDZoYmc1ZnMweiJ9.lTy9NAE_I_tyg7Xt04pihw'
				}).addTo(mapa);

				var instituto = L.marker([39.5616104,3.200250]).addTo(mapa);

				instituto.bindPopup("<b>Aqui Estamos!</b>").openPopup();

		});

	</script>
<?php require '../views/layouts/footer.php';?>
