<?php require 'layouts/head.php'; ?>

<h1 id="title"></h1>


<div class="input-group" id="search">
  <span class="input-group-btn">
    <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
  </span>
  <input id="in-serch" type="text" class="form-control">
</div>

<div id="profile"></div>
<!-- <div class="mt-4"id="progress"></div> -->

<script>

  $(document).ready(function(){

    showProfile();

    function showProfile() {
      const url = (window.location.pathname.split('/')[3] || window.location.pathname.split('/')[2] != 'profile') ? '/api/user/'+window.location.pathname.split('/')[3] + '/' + +window.location.pathname.split('/')[4] : '/api/user' ;

      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        data: {},
        success: (data) => {
          if (data.status == 'success') {
            $('#search').hide();


            let veterany;
            $.ajax({
              type: 'get',
              url: "/api/veterany",
              dataType: 'json',
              data: {},
              async: false,
              success: function (data) {
                veterany = data;
              }
            });

            let profile = data.profile;
            let achievements = data.achievement;

            let rowDIV = $("<div/>",{class:"row",});

            let name = profile.name + " " + profile.surname + " " + profile.surname_2;


            let cardBody = $("<div/>",{class:"card-body"});
            let cardName = $("<h4/>",{class:"card-title", text:name});
            let cardP = $("<p/>",{class:"card-text"});
            let cardEmailTitle = $("<b/>",{class:"card-text", text:"Email: "});
            let cardEmail = $("<span/>",{class:"card-text", text:profile.email});
            let cardLevelTitle = $("<b/>",{class:"card-text", text:"<?= $lang[$displayLang]['level']; ?>: "});
            let cardLevel = $("<span/>",{text:veterany.veteranity_level});
            let cardCoinsTitle = $("<b/>",{class:"card-text", text:"Coins: "});
            let cardCoins = $("<span/>",{class:"card-text", text:profile.coins});
            let cardPointsTitle = $("<b/>",{class:"card-text", text:"Points: "});
            let cardPoints = $("<span/>",{class:"card-text", text:profile.points});
            let progres = $("<div/>",{class:"mt-4", id:"progress"});

            setTimeout(function progressBar() {

              let veteranyRange;
              $.ajax({
                type: 'get',
                url: "/api/veteranyRange",
                dataType: 'json',
                data: {},
                async: false,
                success: function (data) {
                  veteranyRange = data;
                  maxPoints = data.points;
                }
              });

              var svg = d3.select('#progress')
                .append('svg')
                .attr('height', 30)
                .attr('width', 700);


              if (maxPoints == 100) {
                minPoint = 0;
                dif=100;
              } else if (maxPoints == 250) {
                minPoint = 100;
                dif=150;
              } else if (maxPoints == 450) {
                minPoint = 250;
                dif=200;
              } else if (maxPoints == 700) {
                minPoint = 450;
                dif=250;
              } else if (maxPoints == 1000) {
                minPoint = 700;
                dif=300;
              }
              //100% = 500
              pointsLevel = profile.points-minPoint;
              segmentWidth = ((pointsLevel*100)/dif)*5,

              svg.append('rect')
                .attr('class', 'bg-rect')
                .attr('fill', 'white')
                .attr('height', 30)
                .attr('width',600)
                .attr('x', 0);

              var progress = svg.append('rect')
                      .attr('class', 'progress-rect')
                      .attr('fill',"green")
                      .attr('height', 20)
                      .attr('width', 0)
                      .attr('x', 0);

              var lado;
              if (((pointsLevel*100)/dif)<20) {
                lado = segmentWidth+5;
              }else{
                lado = segmentWidth-40;
              }

              //Añadimos el porcentage
              svg.append("text")
                     .attr("x",lado )
                     .attr("y", 10)
                     .attr("dy", ".35em")
                     .text(((pointsLevel*100)/dif).toFixed(0)+"%");

             svg.append("text")
                    .attr("x", 505)
                    .attr("y", 10)
                    .attr("dy", ".35em")
                    .text("Points for Next Lvl : "+maxPoints);

              //Efecto de transicion
              progress.transition()
                .duration(2000)
                .attr('width',segmentWidth);

              //Borde de la barra
              var borderPath = svg.append("rect")
               .attr("x", 0)
               .attr("y", 0)
               .attr("height", 20)
               .attr("width", 500)
               .style("stroke", "black")
               .style("fill", "none")
               .style("stroke-width", 1);
            }, 200);

            cardP.append(cardEmailTitle, cardEmail, $("<br/>"), cardCoinsTitle, cardCoins, $("<br/>"), cardPointsTitle, cardPoints, $("<br/>"), cardLevelTitle, cardLevel,progres);
            cardBody.append(cardName, cardP);

            let array = [];

            for (let x = 0; x < 5 ; x++){
              array[x] = ( achievements[x] != null ) ? achievements[x].achievement_id : null;
            }

            let description;
            $.ajax({
              type: 'get',
              url: "/api/achievements",
              dataType: 'json',
              data: {},
              async: false,
              success: function (data) {
                description = data;
              }
            });

            let i = 0;
            let newDIV2 = $("<div/>",{class:'row h-10 col-5'});

            for (let x = 1; x <= 5 ; x++){
              let newDIV3 = $("<div/>",{class: 'col p-0'});
              let photo = "/assets/img/a"+x;

              if ( x == 1 || x == 5)
                photo = photo + ".svg";
              else
                photo = photo + ".png";

              if( array[i] == x ){
                var newIMG = $("<img/>", {
                  src:photo,
                  alt:photo,
                  class: 'w-100',
                  'data-toggle':'tooltip',
                  'data-placement':'top',
                  title:description[x-1].description
                });

                i++;
              }else{
                var newIMG = $("<img/>",{
                  src:photo,
                  alt:photo,
                  class: 'w-100 opacity',
                  'data-toggle':'tooltip',
                  'data-placement':'top',
                  title:description[x-1].description
                });
              }

              newDIV3.append(newIMG);
              newDIV2.append(newDIV3);
            }
            cardBody.append(newDIV2);
            $("#profile").append(cardBody);
            $("#title").append('Profile');

            if (window.location.pathname.split('/')[3] && window.location.pathname.split('/')[3] != '<?=$user->name;?>') {
              cardP.append($("<br/><a href='/" + window.location.pathname.split('/')[1] + "/chat/"+ window.location.pathname.split('/')[3] + "/" + window.location.pathname.split('/')[4] +"'>Chat</a>"))
              cardBody.append(cardName, cardP/*, newDIV*/);

              $("#profile").append(cardBody);

            } else {
              $("#profile").html(data.msg);
            }

          } else {
            // $("#profile").html(data.msg);
            showUsers();
          }

          //llamada al método para mostrar los tooltip sobre los logros
          $('[data-toggle="tooltip"]').tooltip();
        }

      });
    };

    function showUsers() {

      $('#in-serch').val(window.location.pathname.split('/')[3]);
      $('#title').append('Users');

      ajaxShowUsers();

    }

    function ajaxShowUsers() {
      const url = (window.location.pathname.split('/')[2] != 'profile') ? '/api/user/'+$('#in-serch').val() : '/api/user' ;
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        data: {},
        success: (data) => {
          if (data.status == 'success') {

            htmlLi = '<ul class="list-unstyled">';
            $.each (data.users, function(key, value) {
              htmlLi += '<a href="/' + window.location.pathname.split('/')[1] + '/user/' + value.initials  + '/'+ value.tag + '" title=""><strong>' + value.initials + '</strong><small># ' + value.tag + ' ' + value.name + ' ' + value.surname +'</small></a></br>';
            });
            htmlLi += "</ul>"
            document.getElementById("profile").innerHTML = htmlLi;

          } else {
            document.getElementById("profile").innerHTML = '';
          }
        }
      });
    }

    $('#in-serch').on('input',function(e){
      ajaxShowUsers();
    });

  });

</script>

<?php require '../views/layouts/footer.php';?>
