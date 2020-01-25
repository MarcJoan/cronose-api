<?php require 'layouts/head.php';?>

<h1>New Work</h1>

<div class="langSelector container shadow m-2 p-3 text-center" id="workForm">
	<h5>¿En qué idioma ofrecerás tu trabajo?</h5>
	<p>Después podrás añadir más idiomas complementarios</p>
	<button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Idiomas
	</button>
  <div id="langsAvaliable" class="dropdown-menu" aria-labelledby="dropdownMenuButton"></div>

  <div class="container" >

  	<form>
  		<div class="form-group">
  			<label for="workTitle">Título</label>
  			<input type="email" class="form-control" id="workTitle" aria-describedby="emailHelp" placeholder="Introduce tu título">
  		</div>
  		<small id="workSubtitle" class="form-text text-muted">Utiliza un título lo más descriptivo posible</small>
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

	});



</script>

<?php require '../views/layouts/footer.php';?>
