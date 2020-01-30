</main>

  <?php if (isset($_SESSION['user'])):?>
<!--
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
</div>
</div>
-->
  <?php endif; ?>
  <script>
    const selector = document.getElementById('language_selector');
    selector.value = "<?= isset($displayLang) ? $displayLang : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); ?>";

    $(document).ready(function(){

      $("#language_selector").change(function(){
        let lang = $("#language_selector").val();
        changeLang(lang);
      });

    });

    function changeLang(lang) {
      window.location.replace("/"+lang+"/<?= $auxUriString; ?>");
    }

  </script>
</body>
</html>
