<?php require 'layouts/head.php';?>

<h1>New Work</h1>

<div class="langSelector container shadow m-2 p-3 text-center" id="workForm">
	<h5>¿En qué idioma ofrecerás tu trabajo?</h5>
	<p>Después podrás añadir más idiomas complementarios</p>
	<button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Idiomas
	</button>
  <div id="langsAvaliable" class="dropdown-menu" aria-labelledby="dropdownMenuButton"></div>

  <div id="workForm2" class="container text-left">
  	<hr/>

  	<form>
  		<div class="row">
	  		<div class="form-group col">
	  			<select class="form-control" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <option disabled selected>Categoría</option>
					</select>
					<small class="form-text text-muted">Elige la categoría que mejor se ajuste al trabajo que deseas publicar</small>
	  		</div>

	  		<div class="form-group col">
	  			<select class="form-control" id="dropdownSpecialization" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <option>Especialización</option>
					</select>
					<small class="form-text text-muted">Elige la categoría que mejor se ajuste al trabajo que deseas publicar</small>
	  		</div>

			</div>
			<div class="form-group bg-secondary text-white p-2">
				<label for="rating">¿Cuál es tu nivel de profesionalidad en este sector?</label>
  			<div class="rating" id="rating"></div>
  		</div>
  		<div class="form-group">
  			<label for="workTitle">Título</label>
  			<input type="text" class="form-control" id="workTitle" aria-describedby="emailHelp" placeholder="Introduce tu título...">
  			<small id="workSubtitle" class="form-text text-muted">Utiliza un título lo más descriptivo posible</small>
  		</div>
			<div class="form-group">
  			<label for="workTitle">Descripción</label>
  			<textarea type="text" class="form-control" id="workDescription" aria-describedby="emailHelp" placeholder="Describe tu actividad..." rows="5"></textarea>
  			<small id="workSubtitle" class="form-text text-muted">Indica lo que puedes ofrecer y otra información que quieres que sepan los demás usuarios.</small>
  		</div>  
  		<input type="button" class="btn btn-primary" id="generateData" value="Enviar">		
  	</form>
  </div>

</div>

<!--Carga el script de estrellas para autoevaluarse-->
<script src="/assets/plugin/js/rater.min.js"></script>

<script>

	$(document).ready(async function(){

		$(".rating").rate();

		let data = new Array();
		let array = {lang: null, category: null, specialization: null, title: null, description: null, valoration: null };
		let langs;
		let newOffer; //Array con toda la información
		langs = await getLangs();
		let defaultLangs;
		defaultLangs = await getDefaultLangs();
		renderLangs(langs);
		let langSelected;
		let cat;
		let category;

		async function getLangs(){
			if(!langs) return await loadLangs();
			else return langs;
		}

		function renderLangs(langs){
			langs.forEach(function(lang){
				const item = $("<a/>",{
					class:'dropdown-item',
					text:lang.translation,
					'data-value':lang.language_translated
				});

				//Si es uno de los idiomas oficiales de la página lo ponemos al inicio del dropdown
				if(defaultLangs.includes(lang.language_translated))
					$('#langsAvaliable').prepend(item);
				else
					$('#langsAvaliable').append(item);

			});
		}

		//cogemos todos los idiomas disponibles
		async function loadLangs(){
			return $.ajax({
				type:'get',
				url: "/api/langs",
				dataType: 'json',
				success: function(data) {
					sortArray(data, 'translation');
					return data;
				}
			});
		}

		async function getDefaultLangs(){
			if(!defaultLangs) return await loadDefaultLangs();
			else return defaultLangs;
		}

		async function loadDefaultLangs(){
			return $.ajax({
				type:'get',
				url: "/api/langs/default",
				dataType: 'json',
				success: function(data) {
					return data;
				}
			});
		}

		//Cambia el texto del botón al seleccionar idioma
    $("#langsAvaliable a").click(function(){
      $("#dropdownMenuButton").text($(this).text());
      $("#dropdownMenuButton").val($(this).text());
			
      loadCategories();
		});


    $(".dropdown-item").click(function(){
			langSelected = $(this).data("value");
    });

		function loadFile(){
			$("#formBackground").addClass("opacity");
		}

		//Ordena el json por el valor indicado al llamarlo
		function sortArray(array, prop, asc = true) {
	    return array.sort(function(a, b) {
	        if (asc) {
	            return (a[prop] > b[prop]) ? 1 : ((a[prop] < b[prop]) ? -1 : 0);
	        } else {
	            return (b[prop] > a[prop]) ? 1 : ((b[prop] < a[prop]) ? -1 : 0);
	        }
	    });
		}

		
		function loadCategories(){
			$.ajax({
				type: 'get',
				url: '/api/categories',
				dataType: 'json',
				success: function(data){
					category = data;

					$("#dropdownCategory").empty();
					for (cat in category){
						let name = category[cat].name;
						let val = category[cat].id;
						let item2 = $("<option/>", {
							text:name,
							value:val});
						$("#dropdownCategory").append(item2);
					}
				}
			});
		}

    $("#dropdownCategory").change(function(){
    	cat = $("#dropdownCategory").val();
			
      loadSpecialization(cat);
    }); 


    let specialization;
    function loadSpecialization($cat){
    	$.ajax({
				type: 'get',
				url: '/api/specializations/'+$cat,
				dataType: 'json',
				success: function(data){
					specialization = data;
					$("#dropdownSpecialization").empty();
					for (spe in specialization){
						let name = specialization[spe].name;
						let val = specialization[spe].id;
						let item3 = $("<option/>", {
							text:name,
							value:val});
						$("#dropdownSpecialization").append(item3);
					}
				}
			});
		}
		
		function checkLang(){
			$.each(data, function(key,value){
				if(langSelected == value){
					return false;
				}
				return true;
			});
		}
    
    //Aquí recopilamos la información del formulario
		$("#generateData").click(function(){
			if(checkLang()){
				array.lang = langSelected;
				data.push(array);
			}
			array = {lang: null, category: null, specialization: null, title: null, description: null, valoration: null };
			console.log(data);
    });

    /*function submit(data){
    	$.ajax({
				type: 'post',
				url: '/api/offer',
				dataType: 'json',
				data: { 'offer' : data }
    	});
		}*/
	});


</script>

<?php require '../views/layouts/footer.php';?>
