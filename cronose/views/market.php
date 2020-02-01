<?php
	require '../views/layouts/head.php';
?>

<div class="container wrap row justify-content-center mt-4">
	<h1><?= $lang[$displayLang]['market'];?></h1>
	<div class="container">
		<div class="row p-2">
			<div class="col-lg-11 pt-4 pb-4">
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
					</span>
					<input type="text" class="form-control" id="serch">
				</div>
			</div>
			<div class="col-12">
        <div class="form-group row">
        	<div class="col-2">
				    <label for="language">Language</label>
				    <select class="" id="lang">
				    </select>
				  </div>
			  	<div class="col-2">
				    <label for="myLangs">Selected Languages</label>
				    <select class="" id="myLangs">
				    	<option disabled selected="selected">My Langs</option>
				    </select>
				  </div>
				  <div class="col-2">
				    <label for="category">Category</label>
				    <select class="" id="category">
				    </select>
				  </div>
				  <div class="col-2">
				    <label for="specialization">Specialization</label>
				    <select class="" id="specialization">
				    	<option disabled selected="selected" value="null">Specializations</option>
				    </select>
				  </div>
				  <div class="col-2">
				    <button id="reset">Reset Filter</button>
				  </div>
				</div>
				<div class="card-deck w-100">
					<div class="row w-100"><div class="container wrap row justify-content-center mt-4"><div class="container py-3">
						<div class="card">
							<div class="row">
								<div class="col-md-4">
									<img src="https://thumbs.dreamstime.com/b/uso-en-l%C3%ADnea-de-trabajo-de-la-red-de-internet-del-negocio-de-la-gente-46666160.jpg" class="img-fluid" style="height: 222.8px;">
									</div>
										<div class="col-md-8 px-3">
											<div class="card-block px-3">
												<div class="d-flex justify-content-end px-4 pt-2">
													<p class="pr-4"><strong>ES</strong><p>
													<p class="pr-4">PV : <strong>70</strong><p>
													<p>GV : <strong>'80</strong><p></div>
													<h4 class="card-title "><strong>Fontanero</strong> (<em>Admin</em>)</h4>
													<p class="card-text">El mejor fontanero que puedes encontra en toda mallorca.</p>
													<p><?= $lang[$displayLang]['price'];?> : <strong>2</strong></p>
												<div class="d-flex justify-content-end  pb-3 pr-3">
													<a href="/<?=$displayLang;?>/work/'+value.initials+'/'+value.tag+'/'+value.specialization_id+'/'+value.title+'" class="btn btn-primary"><?= $lang[$displayLang]['seeWork'];?></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="card-deck w-100" id="works">
			</div>
		</div>
	</div>
</div>

  <script>
  $(document).ready(function(){
		// const works;
		const defaultLang = window.location.pathname.split('/')[1];


		// GET LANGS, CATEGORY AND SPECIALIZATION

		let langs = [];
		let categories = [];
		let specializations = [];

		getLangs();
		getCategories();

    function getLangs() {
    	const url = '/api/lang/offers';
    	$.ajax({
	      type: 'get',
	      url: url,
	      dataType: 'json',
	      data: {},
	      success: (data) => {
	      	$.each(data.lang, function(key,value) {
	      		langs.push(value.language_id);
	      	})
	      	renderLangs();
					renderMyLangs();
	      },
	      error: ((data) => {
	        console.log(data)
	      })
	    });
    }

    function getCategories() {
    	const url = '/api/categories/'+defaultLang;
    	$.ajax({
	      type: 'get',
	      url: url,
	      dataType: 'json',
	      data: {},
	      success: (data) => {
	      	categories = data;
    			renderCategory();
	      },
	      error: ((data) => {
	        console.log(data)
	      })
	    });
    }

    function getSpecializations(category_id) {
    	const url = '/api/specialization/' + category_id + '/' + defaultLang;
    	$.ajax({
	      type: 'get',
	      url: url,
	      dataType: 'json',
	      data: {},
	      success: (data) => {
	      	specializations = data;
	      	renderSpecializations();
	      },
	      error: ((data) => {
	        console.log(data)
	      })
	    });
    }


    // RENDER LANGS, CATEGORY AND SPECIALIZATION


    function renderLangs() {
			$("#lang")
				.empty()
				.append('<option disabled selected="selected">Choose Langs</option>');
			$.each(langs, function(key,value) {
    		$("#lang").append(new Option(value, value));
    	})
		}

		function renderMyLangs() {
			filter['langs'].sort();
			$("#myLangs")
				.empty()
				.append('<option disabled selected="selected">My Langs</option>');
			$.each(filter['langs'], function(key,value) {
    		$("#myLangs").append(new Option(value, value));
    	})
		}

		function renderCategory() {
			$("#category")
				.empty()
				.append('<option disabled selected="selected" value="null">Categories</option>');
			$.each(categories, function(key,value) {
    		$("#category").append(new Option(value.name, value.id));
    	})
		}

		function renderSpecializations() {
			$("#specialization")
				.empty()
				.append('<option disabled selected="selected" value="null">Specializations</option>');
			$.each(specializations, function(key,value) {
    		$("#specialization").append(new Option(value.name, value.id));
    	})
		}



		// -------

		$("#lang").change(function() {
			filter['langs'].push($("#lang").val());
			for( var i = 0; i < langs.length; i++){
			  if ( langs[i] === $("#lang").val()) {
			  	langs.splice(i,1);
			  }
			}
			renderLangs();
			renderMyLangs();
			getFilteredWorks();
		})

		$("#myLangs").change(function() {
			langs.push($("#myLangs").val());
			for( var i = 0; i < filter['langs'].length; i++){
			  if ( filter['langs'][i] === $("#myLangs").val()) {
			  	filter['langs'].splice(i,1);
			  	filter['langs'].sort();
			  	langs.sort();
			  }
			}
			renderLangs();
			renderMyLangs();
			getFilteredWorks();
		})

		$("#category").change(function() {
			filter['specialization'] = null;
			filter['category'] = $("#category").val()
			getSpecializations($("#category").val());
			getFilteredWorks();
		})

		$("#specialization").change(function() {
			filter['specialization'] = $("#specialization").val()
			getFilteredWorks();
		})

		$('#serch').on('input',function(e){
			filter['string'] = $('#serch').val();
			getFilteredWorks();
    });

		$("#reset").click(function() {
			filter = {langs: [], defaultLang: defaultLang, category: null, specialization: null, string: null};
			renderCategory();
			$("#specialization")
				.empty()
				.append('<option disabled selected="selected" value="null">Specializations</option>');
			$('#serch').val('');
			getAllWorks();
		})





		//---------------Filter---------------

		let filter = {langs: [], defaultLang: defaultLang, category: null, specialization: null, string: null};


    //---------------FILTER---------------


    let offers;
    let limit = 10;
		let offset = 0;
    getAllWorks();

		function getAllWorks() {
	    const url =  '/api/offers/' + limit + '/' + offset + '/default/'+defaultLang;
	    $.ajax({
	      type: 'get',
	      url: url,
	      dataType: 'json',
	      data: {},
	      success: (data) => {
	        if (data.status == 'success') {
	        	offers = data.offers;
	        	renderOffers();
	        };
	      },
	      error: ((data) => {
	        console.log(data)
	      })
	    });
    };

    function getFilteredWorks() {
	    const url =  '/api/offers/'+limit+'/filter/';
	    $.ajax({
	      type: 'get',
	      url: url,
	      dataType: 'json',
	      data: {filter},
	      success: (response) => {
	        	offers = response.offers;
	        	renderOffers();
	      },
	      error: ((response) => {
	        console.log(response)
	      })
	    });
    };

    function renderOffers () {
    	let body =  "";
			document.getElementById("works").innerHTML = body;
			$.each (offers, function(key, value) {
				body+='<div class="row w-100"><div class="container wrap row justify-content-center mt-4"><div class="container py-3"><div class="card"><div class="row"><div class="col-md-4">';
				body+='<img src="https://thumbs.dreamstime.com/b/uso-en-l%C3%ADnea-de-trabajo-de-la-red-de-internet-del-negocio-de-la-gente-46666160.jpg" class="img-fluid" style="height: 222.8px;"> ';
				body+='</div><div class="col-md-8 px-3"><div class="card-block px-3"><div class="d-flex justify-content-end px-4 pt-2">';

				$.each(value.translation, function(key,val) {
					body+='<p class="pr-4"><strong>'+val.language_id+'</strong><p>';
				})

				body+='<p class="pr-4">PV : <strong>'+value.personal_valoration+'</strong><p>';
				body+='<p>GV : <strong>'+value.valoration_avg+'</strong><p></div>';
				body+='<h4 class="card-title "><strong>'+value.translation[0].title+'</strong> (<em>'+value.name+'</em>)</h4>';
				body+='<p class="card-text">'+value.translation[0].description+'</p>';
				body+='<p><?= $lang[$displayLang]['price'];?> : <strong>'+value.coin_price+'</strong></p><div class="d-flex justify-content-end  pb-3 pr-3">';
				body+='<a href="/<?=$displayLang;?>/work/'+value.initials+'/'+value.tag+'/'+value.specialization_id+'/'+value.title+'" class="btn btn-primary"><?= $lang[$displayLang]['seeWork'];?></a></div></div></div></div></div></div></div></div>';
				document.getElementById("works").innerHTML = body;
      });
    }

  });
</script>


<?php require '../views/layouts/footer.php';?>
