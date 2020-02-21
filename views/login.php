<?php

  require 'layouts/head.php';

  if (isset($_SESSION['user'])) header('Location: ../market');

?>


<div class="container">
  <div class="row">
    <div class=" col-4 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body ">
          <h5 class="card-title text-center"><?=$lang[$displayLang]['logIn'];?></h5>
          <form id="login-form" method="post" target="_self" class="form-signin">
            <div class="form-label-group">
              <input id="email" type="email" name="email" class="form-control" placeholder="<?=$lang[$displayLang]['email'];?>" required autofocus>
              <br>
            </div>
            <div class="form-label-group">
              <input id="password" type="password" name="password" class="form-control" placeholder="<?=$lang[$displayLang]['password'];?>" required>
              <br>
            </div>
            <input id="login-btn" class="btn btn-lg btn-primary btn-block" type="button" value="<?=$lang[$displayLang]['submit'];?>">
            </form>
            <div class="mt-4 text-center">
              <a  href="/loginStatistics">Ver Estadisticas</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

<script>

    // Validate form
    $('#login-btn').click(() => {
      // JS validator
      login();
    });

    // Send form via ajax request to Login
    function login() {
      const url = '/api/login';
      const email = $("#email").val();
      const password = $.md5($("#password").val());
      $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: { email, password },
        success: (data) => {
          if (data.status == 'success') window.location.href = '/<?= $displayLang; ?>/market';
        },
        error: (data) => {
          console.log(data);
        }
      });
    }

</script>

<?php require '../views/layouts/footer.php';?>
