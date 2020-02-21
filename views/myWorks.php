<?php require '../views/layouts/head.php'; ?>

<div class="container wrap row justify-content-center mt-4">
	<h1><?= $lang[$displayLang]['myOffers'];?></h1>
	<div class="container">
		<div class="row p-2">
			<div class="card-deck w-100" id="myWorks">
			</div>
		</div>
	</div>
	<a class="btn btn-primary mr-4 mb-4" href="/new-work"><?= $lang[$displayLang]['newPublication'];?></a>
	<a class="btn btn-primary mb-4"href="/work"><?= $lang[$displayLang]['editPublication'];?></a>
</div>

<script>
  $(document).ready(function(){

    showWorks();
		function showWorks() {
      const url = (window.location.pathname.split('/')[3]) ? '/api/myWorks/'+window.location.pathname.split('/')[3] : '/api/myWorks' ;
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        data: {},
        success: (data) => {
          if (data.status == 'success') {
          	console.log(data.offers)
          	let body =  "";
						$.each (data.offers, function(key, value) {
							console.log(value);
							body+='<div class="row w-100"><div class="container wrap row justify-content-center mt-4"><div class="container py-3"><div class="card"><div class="row"><div class="col-md-4">';
							body+='<img src="https://thumbs.dreamstime.com/b/uso-en-l%C3%ADnea-de-trabajo-de-la-red-de-internet-del-negocio-de-la-gente-46666160.jpg" class="img-fluid" style="height: 222.8px;"> ';
							body+='</div><div class="col-md-8 px-3"><div class="card-block px-3"><div class="d-flex justify-content-end px-4 pt-2">';
							body+='<p class="pr-4">PV : <strong>'+value.personal_valoration+'</strong><p>';
							body+='<p>GV : <strong>'+value.valoration_avg+'</strong><p></div>';
							body+='<h4 class="card-title "><strong>'+value.title+'</strong> (<em>'+value.name+'</em>)</h4>';
							body+='<p class="card-text">'+value.description+'</p>';
							body+='<p><?= $lang[$displayLang]['price'];?> : <strong>'+value.coin_price+'</strong></p><div class="d-flex justify-content-end  pb-3 pr-3">';
							body+='<a href="/<?=$displayLang;?>/work/'+value.initials+'/'+value.tag+'/'+value.specialization_id+'/'+value.title+'" class="btn btn-primary"><?= $lang[$displayLang]['seeWork'];?></a></div></div></div></div></div></div></div></div>';
							document.getElementById("myWorks").innerHTML = body;
            });
          };
        },
        error: ((data) => {
          console.log(data)
        })
      });
    };
  });
</script>


<?php require '../views/layouts/footer.php';?>
