<?php

  require 'layouts/head.php';

  if (isset($_SESSION['user']) && $_SESSION['user']->isValid()) header('Location: ../index.php');

?>
<div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
  <span id="errorAlertMessage"></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="container h-100 mt-4">
  <div class="row justify-content-md-center h-100">
    <div class="card-wrapper">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=$lang[$displayLang]['register'];?></h4>
          <form method="POST" class="my-login-validation" id="register" name="registration" action="#">
            <div class="form-group">
              <label for="dni"><?=$lang[$displayLang]['dni'];?></label>
              <input id="dni" type="text" class="form-control" name="dni" required autofocus>
            </div>
            <div class="form-group">
              <label for="name"><?=$lang[$displayLang]['name'];?></label>
              <input id="name" type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
              <label for="surname"><?=$lang[$displayLang]['surname'];?></label>
              <input id="surname" type="text" class="form-control" name="surname" required>
            </div>
            <div class="form-group">
              <label for="surname_2"><?=$lang[$displayLang]['surname_2'];?></label>
              <input id="surname_2" type="text" class="form-control" name="surname_2">
            </div>
            <div class="form-group">
              <label for="email"><?=$lang[$displayLang]['email'];?></label>
              <input id="email" type="text" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label for="password"><?=$lang[$displayLang]['password'];?></label>
              <input id="password" type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
              <label for="c_password"><?=$lang[$displayLang]['repeatPassword'];?></label>
              <input id="c_password" type="password" class="form-control" name="c_password" required>
            </div>
            <div class="form-group">
              <label for="province"><?=$lang[$displayLang]['province'];?></label>
              <select name="province_id" id="province"></select>
            </div>
            <div class="form-group">
              <label for="city"><?=$lang[$displayLang]['city'];?></label>
              <select name="city_cp" id="city"></select>
            </div>
            <div class="form-group">
              <input id="dni_photo" type="hidden" name="dni_photo_id" value="1">
            </div>
            <!-- <div class="form-group">
              <input type="file" class="form-control" name="avatar" id="avatar" accept="image/png, image/jpg, image/jpeg, .jpg, .png">
            </div> -->
            <div class="form-group">
              <div class="custom-checkbox custom-control">
                <input id="private" type="checkbox" name="private" class="custom-control-input">
                <label for="private" class="custom-control-label"><?=$lang[$displayLang]['private'];?></label>
              </div>
            </div>
            <div class="form-group m-0">
              <input id="btnSubmit" type="submit" class="btn btn-primary btn-block text-uppercase" value="<?=$lang[$displayLang]['register'];?>" name="user" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/assets/plugin/bootstrap/bootstrap-validate.js"></script>

<script>

  $(document).ready(function(){
    $('#errorAlert').hide();

    // Load select fields
    function renderProvinces() {
      const url = '/api/provinces';
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function(response) {
          if (response) {
            response.forEach(province => {
              $('#province').append(`<option value="${province.id}">${province.name}</option>`);
            });
            renderCities(response[0].id);
          }
        }
      });
    }
    function renderCities(province) {
      const url = '/api/cities/province';
      $.ajax({
        type: 'GET',
        url: url,
        data: { 'province_id' : province },
        dataType: 'json',
        success: function(response) {
          $('#city').empty();
          if (response) {
            response.forEach(city => {
              $('#city').append(`<option value="${city.cp}">${city.name}</option>`);
            });
          }
        }
      });
    }
    renderProvinces();
    $('#province').on('change', function() {
      renderCities($(this).find(":selected").val());
    });

    //Validate
    let dni, name, surname, email, password, c_password, private;
    bootstrapValidate('#dni', 'min:9:<?=$lang[$displayLang]['min9characters'];?>|required', function (isValid){
      dni = isValid;
    });
    bootstrapValidate('#name', 'min:4:<?=$lang[$displayLang]['min4characters'];?>|required', function (isValid){
      name = isValid;
    });
    bootstrapValidate('#surname', 'min:4:<?=$lang[$displayLang]['min4characters'];?>|required', function (isValid){
      surname = isValid;
    });
    bootstrapValidate('#email','email:<?=$lang[$displayLang]['validEmail'];?>|required', function (isValid) {
      email = isValid;
    });
    bootstrapValidate('#password', 'min:5:<?=$lang[$displayLang]['min5characters'];?>|required', function (isValid) {
      password = isValid;
    });
    bootstrapValidate('#c_password','matches:#password:<?=$lang[$displayLang]['passError'];?>|required', function (isValid){
      c_password = isValid;
    });

    function isValid() {
      return (dni && name && surname && email && password && c_password);
    }

    // Submit Action
    $('form[name="registration"]').submit((e) => {
      e.preventDefault();
      if (!isValid()) return;
      const form = document.forms.namedItem("registration");
      const formData = new FormData(form);
      formData.set( 'password', $.md5(formData.get('password')) );
      formData.delete('c_password');
      register(Object.fromEntries(formData));
    });

    // Send form via ajax request to Register
    function register(data) {
      const url = '/api/register';
      $.ajax({
        type: 'POST',
        url: url,
        data: { 'user': data},
        dataType: 'json',
        // enctype: 'multipart/form-data',
        // contentType: false,
        // processData: false,
        // cache: false,
        success: function(response) {
          // return console.log(response);
          if (response.status == 'success') {
            login(response.profile.email, response.profile.password);
          } else if (response.status == 'error') {
            $("#errorAlertMessage").html( response.message );
            $("#errorAlert").show();
          };
        },
        error: function(xhr, textStatus, thrownError, data) {
          alert("Error: " + thrownError);
          console.log(data);
        }
      });
    }

    // Send form via ajax request to Login
    function login(name, password) {
      $.ajax({
        type: 'POST',
        url: '/api/login',
        dataType: 'json',
        data: { 'user' : email, password },
        success: (data) => {
          if (data.status == 'success') window.location.href = '/<?= $displayLang; ?>/market';
        },
        error: (data) => {
          console.log(data);
        }
      });
    }
  });

</script>

<?php

require 'layouts/footer.php';

?>
