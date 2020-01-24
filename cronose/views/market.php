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
			<div class="card-deck w-100" id="works">
			</div>
		</div>
	</div>
</div>

<script>
  $(document).ready(function(){

    showWorks();
			function showWorks() {
      const url =  '/api/works/'+window.location.pathname.split('/')[1];
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        data: {},
        success: (data) => {
          if (data.status == 'success') {
          	let body =  "";
						$.each (data.offers, function(key, value) {
							body+='<div class="row w-100"><div class="container wrap row justify-content-center mt-4"><div class="container py-3"><div class="card"><div class="row"><div class="col-md-4">';
							body+='<img src="https://thumbs.dreamstime.com/b/uso-en-l%C3%ADnea-de-trabajo-de-la-red-de-internet-del-negocio-de-la-gente-46666160.jpg" class="img-fluid" style="height: 222.8px;"> ';
							body+='</div><div class="col-md-8 px-3"><div class="card-block px-3"><div class="d-flex justify-content-end px-4 pt-2">';
							body+='<p class="pr-4">PV : <strong>'+value.offer[0].personal_valoration+'</strong><p>';
							body+='<p>GV : <strong>'+value.offer[0].valoration_avg+'</strong><p></div>';
							body+='<h4 class="card-title "><strong>'+value.offer[0].title+'</strong> (<em>'+value.offer[0].name+'</em>)</h4>';
							body+='<p class="card-text">'+value.offer[0].description+'</p>';
							body+='<p><?= $lang[$displayLang]['price'];?> : <strong>'+value.offer[0].coin_price+'</strong></p><div class="d-flex justify-content-end  pb-3 pr-3">';
							body+='<a href="/<?=$displayLang;?>/work/'+value.offer[0].initials+'/'+value.offer[0].tag+'/'+value.offer[0].specialization_id+'/'+value.title+'" class="btn btn-primary"><?= $lang[$displayLang]['seeWork'];?></a></div></div></div></div></div></div></div></div>';
							document.getElementById("works").innerHTML = body;
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
