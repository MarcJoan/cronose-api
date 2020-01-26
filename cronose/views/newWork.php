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
  	</form>
  </div>

</div>

<a href="preview-work">Preview Work</a>

<script>

	$(document).ready(function(){

		let langs;
		loadLangs();

		//cogemos todos los idiomas disponibles
		function loadLangs(){
			
			$.ajax({
				type:'get',
				url: "/api/langs",
				dataType: 'json',
				async: false,
				success: function(data) {
					langs = data;
				}
			});

			sortLangs('translation', true);
			
			for (lang in langs){

				const newLang = langs[lang].translation;
				const val = langs[lang].language_translated;
				const item = $("<a/>",{
					class:'dropdown-item',
					text:newLang, 
					'data-value':val
				});

				//Si es uno de los idiomas oficiales de la página lo ponemos al inicio del dropdown
				if(langs[lang].language_translated != 'ca' && langs[lang].language_translated != 'es' && langs[lang].language_translated != 'en' ) {
					$("#langsAvaliable").append(item);
				}else{
					$("#langsAvaliable").prepend(item);
				}
			}
		}


		//Cambia el texto del botón al seleccionar idioma
    $("#langsAvaliable a").click(function(){
      $("#dropdownMenuButton").text($(this).text());
      $("#dropdownMenuButton").val($(this).text());
      let lang = $(".dropdown-item").val();
			
      loadFile();
      loadCategories();
    });

    $(".dropdown-item").click(function(){
  		let lang = $(this).data("value");
    })

		function loadFile(){
			$("#formBackground").addClass("opacity");
		}

		//Ordena el json por el valor indicado al llamarlo
		function sortLangs(prop, asc) {
	    langs.sort(function(a, b) {
	        if (asc) {
	            return (a[prop] > b[prop]) ? 1 : ((a[prop] < b[prop]) ? -1 : 0);
	        } else {
	            return (b[prop] > a[prop]) ? 1 : ((b[prop] < a[prop]) ? -1 : 0);
	        }
	    });
		}

		let categorie;
		function loadCategories(){
			$.ajax({
				type: 'get',
				url: '/api/categories',
				dataType: 'json',
				async: false,
				success: function(data){
					categorie = data;

					for (cat in categorie){
						let name = categorie[cat].name;
						let val = categorie[cat].id;
						let item2 = $("<option/>", {
							text:name,
							value:val});
						$("#dropdownCategory").append(item2);
					}
				}
			});
		}

		let cat;
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
				async: false,
				success: function(data){
					specialization = data;
					console.log(specialization);
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

	});



</script>

<?php require '../views/layouts/footer.php';?>
