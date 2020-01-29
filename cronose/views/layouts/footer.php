</main>


  <!-- <?php if (isset($_SESSION['user'])):?>

  <footer class="py-4 text-white-50">
    <div class="container text-center text-md-left mt-3">
      <div class="container text-center">
        <div class="col-2"></div>
        <div class="row  ">
            <div class="col-xs-6 col-sm-3">
              <h6 class="text-uppercase mb-4 font-weight-bold" ><?= $lang[$displayLang]['aboutUs'];?></h6>
              <p>
                <a href="/home">History</a>
              </p>
              <p>
                <a href="/about-us">Project Info</a>
              </p>
              <p>
                <a href="/home">Team</a>
              </p>
            </div>
            <div class="col-xs-6 col-sm-3">
              <h6 class="text-uppercase mb-4 font-weight-bold"><?= $lang[$displayLang]['howWorks'];?></h6>
              <p>
                <a href="/home">What is a time bank</a>
              </p>
              <p>
                <a href="/home">How it work</a>
              </p>
              <p>
                <a href="/home">Diference</a>
              </p>
            </div>
            <div class="col-xs-6 col-sm-3">
              <h6 class="text-uppercase mb-4 font-weight-bold"><?= $lang[$displayLang]['contact'];?></h6>
              <p>
                <a href="/home">How to</a>
              </p>
              <p>
                <a href="/home">Form</a>
              </p>
            </div>
            <div class="col-xs-6 col-sm-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">FAQ</h6>
              <p>
                <a href="/home">FAQ</a>
              </p>
            </div>
          </div>
        <div class="col-2"></div>
      </div>
    </div>
  </footer>
  <?php endif; ?> -->
  <script>

    $(document).ready(function(){
      const selector = document.getElementById('language_selector');
      // selector.value = "<?= isset($displayLang) ? $displayLang : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); ?>";

      loadNav();

      $(document).ready(function(){

        $("#language_selector").change(function(){
          let lang = $("#language_selector").val();
          changeLang(lang);
        });

      });

      function changeLang(lang) {
        window.location.replace("/"+lang+"/<?= $auxUriString; ?>");
      }


      function loadNav() {
        if (!getCookie('nav-expanded'))setCookie('nav-expanded', '250px', 15);
        document.documentElement.style.setProperty('--nav-width', getCookie('nav-expanded'));
      }

      

      

    });

    function toogleNav() {
      let width = (getCookie('nav-expanded') == '250px') ? '100px' : '250px'; 
      setCookie('nav-expanded', width, 15)
      document.documentElement.style.setProperty('--nav-width', getCookie('nav-expanded'));
    }

    // COOKIES

  function setCookie(cname,cvalue,exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires=" + d.toGMTString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }


  </script>
</body>
</html>
