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
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-12">
        <div class="form-group row">
        	<div class="col-2">
				    <label for="province">Language</label>
				    <select class="" id="lang">
				    </select>
				    <ul class="list-group list-group-horizontal" id="selectLangs">
					  </ul>
				  </div> 
			  	<div class="col-2">
				    <label for="province">Selected Languages</label>
				    <select class="" id="myLangs">
				    </select>
				    <ul class="list-group list-group-horizontal" id="selectedLangs">
					  </ul>
				  </div>
				  <div class="col-2">
				    Start date<input class=""  id="startDate">
				  </div>
				  <div class="col-2">
				    End date<input class=""  id="endDate">
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

		//---------------Filter---------------
		
    $("#startDate").datepicker({
		  dateFormat: "dd-mm-yy",
		});

		$("#endDate").datepicker({
		  dateFormat: "dd-mm-yy",
		});

		let langs = [];
		let myLangs = [];

		showLangs();

		$("#lang").change(function() {
			myLangs.push($("#lang").val());
			for( var i = 0; i < langs.length; i++){ 
			  if ( langs[i] === $("#lang").val()) {
			  	langs.splice(i,1);
			  	langs.sort();
			  }
			}
			renderSelect();
			renderSelectedLangs();
		})

		$("#myLangs").change(function() {
			langs.push($("#myLangs").val());
			for( var i = 0; i < myLangs.length; i++){
			  if ( myLangs[i] === $("#myLangs").val()) {
			  	myLangs.splice(i,1);
			  	myLangs.sort();
			  }
			}
			renderSelect();
			renderSelectedLangs();
		})

		function renderSelect() {
			$("#lang")
				.empty()
				.append('<option disabled selected="selected">Choose Langs</option>');
			$.each(langs, function(key,value) {
    		$("#lang").append(new Option(value, value));
    	})
		}

		function renderSelectedLangs() {
			myLangs.sort();
			$("#myLangs")
				.empty()
				.append('<option disabled selected="selected">My Langs</option>');
			$.each(myLangs, function(key,value) {
    		$("#myLangs").append(new Option(value, value));
    	})
		}


    function showLangs() {
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
	      	renderSelect();
					renderSelectedLangs();
	      },
	      error: ((data) => {
	        console.log(data)
	      })
	    });
    }
    //---------------FILTER---------------


    showAllWorks();
    let offers;

		function showAllWorks() {
	    const url =  '/api/offers/10/default/'+window.location.pathname.split('/')[1];
	    console.log(url);
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

    function renderOffers () {
    	let body =  "";
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
