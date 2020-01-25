<?php require 'layouts/head.php';?>

<h1>New Work</h1>

<div class="langSelector container shadow m-2 p-3 text-center">
	<h5>¿En qué idioma ofrecerás tu trabajo?</h5>
	<p>Después podrás añadir más idiomas complementarios</p>
	<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Idiomas
  </button>
  <div id="langsAvaliable" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  </div>
</div>

<a href="preview-work">Preview Work</a>

<script>

	$(document).ready(function(){

		loadLangs();

		//cogemos todos los idiomas disponibles
		function loadLangs(){
			let langs;
			$.ajax({
				type:'get',
				url: "/api/langs",
				dataType: 'json',
				async: false,
				success: function(data) {
					langs = data;
				}
			});

			for (lang in langs){
				const newLang = langs[lang].translation;
				const val = langs[lang].id;
				const item = $("<a/>",{
					class:'dropdown-item',
					text:newLang, 
					value:val,
					onClick:loadFile()
				});
				$("#langsAvaliable").append(item);
			}
		}

		function loadFile(){
			const lang = $(this).val;
			console.log(lang);
		}

	});



</script>

<?php require '../views/layouts/footer.php';?>
