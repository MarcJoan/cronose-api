<?php require 'layouts/head.php';?>

<div class="container ">
  <div id="work">
  </div>
</div>

<script>
  $(document).ready(function(){
    const lang = window.location.pathname.split('/')[1]
    const initials = window.location.pathname.split('/')[3];
    const tag = window.location.pathname.split('/')[4];
    const specialization_id = window.location.pathname.split('/')[5];
    console.log('/'+lang+'/chat/'+initials+'/'+tag);

    showWorks();
		function showWorks() {
      const url = '/api/work/'+initials+'/'+tag+'/'+specialization_id;
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        data: {},
        success: (data) => {
          console.log(data);
          if (data.status == 'success') {
          	console.log(data.offers);
            let body =  "";
            body+='<div class="row mt-4 pb-4">';
            body+=' <div class="col-8 mt-4 pt-4">';
            body+='   <h1>'+data.offers.title+'</h1>';
            body+='   <img class=" pt-4 w-100" src="https://www.lavanguardia.com/r/GODO/LV/p5/WebSite/2018/03/01/Recortada/img_mrubal_20180301-181502_imagenes_lv_otras_fuentes_facebook-k5BD-U441174454334qtH-992x558@LaVanguardia-Web.jpg" alt="">';
            body+='   <div class="row mt-4">';
            body+='     <div class="col-6">';
            body+='       <div class="float-left">';
            body+='         <h5>PV : <strong>'+data.offers.personal_valoration+'</strong></h5>';
            body+='       </div>';
            body+='     </div>';
            body+='     <div class="col-6">';
            body+='       <div class="float-right">';
            body+='         <h5>AVG : <strong>'+data.offers.valoration_avg+'</strong></h5>';
            body+='       </div>';
            body+='     </div>';
            body+='   </div>';
            body+='   <div class="py-3 ">';
            body+='     <div class="media d-flex align-items-center"><img src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_960_720.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">';
            body+='       <div class="media-body">';
            body+='         <h4 class="m-0">'+data.offers.name+'</h4>';
            body+='       </div>';
            body+='     </div>';
            body+='   </div>';
            body+='   <br>';
            body+='   <h4 class="pl-4" >WORK INFO</h4>';
            body+='   <hr>';
            body+='   <p>'+data.offers.description+'</p>';
            // body+='   <br>';
            // body+='   <h4 class="pl-4" >USER INFO</h4>';
            // body+='   <hr>';
            // body+='   <div class="py-3 pl-4">';
            // body+='     <div class="media d-flex align-items-center"><img src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_960_720.png" alt="..." width="45" class="mr-3 rounded-circle img-thumbnail shadow-sm">';
            // body+='       <div class="media-body">';
            // body+='         <h5 class="m-0">'+data.offers.name+'</h5>';
            // body+='       </div>';
            // body+='     </div>';
            // body+='   </div>';
            // body+='   <h5 class="pl-4 pt-4" >DESCRIPTION</h5>';
            // body+='   <hr class="w-50 float-left">';
            // body+='   <br>';
            // body+='   <br>';
            // body+='   <p>Example paragraphExample paragrapExample paragrapExample paragrapExample paragrapExample paragrapExample paragrapExample paragrap</p>';
            body+=' </div>';
            body+=' <div class="col-4 mt-4 pt-4 ">';
            body+='   <h4>Shedule</h4>';
            body+='   <hr>';
            body+='   <p>Example paragraph</p>';
            body+='   <br>';
            body+='   <h4>Zone Info</h4>';
            body+='   <hr>';
            body+='   <p>Example paragraph</p>';
            body+='   <br>';
            body+='   <div class="mb-4 mt-4 "id="MyMap" style="width:350px;height:250px;"></div>';
            body+='   <br>';
            body+='   <a href="/'+lang+'/chat/'+initials+'/'+tag+'"><button type="button" class="btn btn-primary btn-lg btn-block" id="chat_btn">CONTACTAR</button>';
            body+=' </div>';
            body+='</div>';
            document.getElementById("work").innerHTML = body;
          };
          map();
        },
        error: ((data) => {
          console.log(data)
        })
      });
    };
  });

  function map(){
    var map = L.map('MyMap').setView([39.5994550, 2.9726290],8);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox.light',
        accessToken: 'pk.eyJ1IjoibWVuYTciLCJhIjoiY2szeThhZHUyMGlwNDNscDZoYmc1ZnMweiJ9.lTy9NAE_I_tyg7Xt04pihw'
    }).addTo(map);
  }

</script>

<?php require '../views/layouts/footer.php';?>
