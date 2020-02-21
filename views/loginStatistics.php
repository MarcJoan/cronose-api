<?php
  require 'layouts/head.php';
?>


<div class="container">
  <div class="row">
    <div class=" col-4 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center"><?=$lang[$displayLang]['logIn'];?> Statistics</h5>
          <form id="login-form" method="post" target="_self" class="form-signin">
            <div class="form-label-group">
              <input id="username" type="text" name="username" class="form-control" placeholder="<?=$lang[$displayLang]['name'];?>" required autofocus>
              <br>
            </div>
            <div class="form-label-group">
              <input id="password" type="password" name="password" class="form-control" placeholder="<?=$lang[$displayLang]['password'];?>" required>
              <br>
            </div>
            <input id="login-btn" class="btn btn-lg btn-primary btn-block" type="button" value="<?=$lang[$displayLang]['submit'];?>">
            </form>
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
      const username = $("#username").val();
      const password = $.md5($("#password").val());
      $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: { username, password },
        success: (data) => {
          console.log(data);

          if (data.status == 'success') window.location.href = '/<?= $displayLang; ?>/statistics';
        },
        error: (data) => {
          console.log(data);
        }
      });
    }

</script>

<?php require '../views/layouts/footer.php';?>
