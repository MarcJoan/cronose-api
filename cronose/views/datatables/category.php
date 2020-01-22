<html lang="en">
<head>
  <title>DataTablesJS.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- css -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"/>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>

  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.bootstrap4.min.css"/>

  <!-- js -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <script src="//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

  <!-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script> -->


</head>
<body>
  <div class="container">
  <h1>dataTable</h1>
  <br>
    <div class="row">
      <div class="col">
        <table id="table" class="table table-striped table-bordered"/>
      </div>
    </div>
  </div>
<button type="button" class="btn btn-primary m-b5" data-toggle="modal" data-target="#insert">
  Insert
</button>
<button id="btnedit" type="button" class="btn btn-primary m-b5" data-toggle="modal" data-target="#edit" >
  Edit
</button>
<button id="delete" type="button" class="btn btn-primary m-b5">
  Delete
</button>

<!-- Modal -->
<div class="modal fade" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Price</label>
          <div class="col-sm-10">
            <input class="form-control" name="price" id="price" type="text" placeholder="Enter the price">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="submit" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal EDIT -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Id</label>
          <div class="col-sm-10">
            <input class="form-control" name="id" id="id2" type="text" placeholder="ID">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Price</label>
          <div class="col-sm-10">
            <input class="form-control" name="nameEdit" id="nameEdit" type="text" placeholder="Enter the new price">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="update" type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready( function () {
    let table = $('#table').DataTable( {
      ajax: {
        url: 'http://cronose.test/cronose/views/datatables/categoryTable.php',
        dataSrc: '',
        type:"POST",
      },
      select: {
        style: 'os',
        items: 'row'  //row, column, cell
      },
      responsive: true,
      columns:  [
        {title: "ID", data:'id'},
        {title: "PRICE", data:'coin_price'}
      ]
    });

    $('#submit').click(function(){
      var coin_price = $('#price').val();

      $.ajax({
        type:'POST',
        data:{coin_price:coin_price},
        url:"http://cronose.test/cronose/views/datatables/insertCategory.php" //php page URL where we post this data to save in databse
      });
    });


    $('#btnedit').click(function(){

     var data = table.rows('.selected').data()[0];
      $('#id2').val(data['id']);
      $('#nameEdit').val(data['coin_price']);

      $('#update').click(function(){
        var id = $('#id2').val();
        var coin_price = $('#nameEdit').val();
        $.ajax({
         type:'POST',
         data:{id: id, coin_price:coin_price},
         url:"http://cronose.test/cronose/views/datatables/updateCategory.php" //php page URL where we post this data to save in databse
        });
      });
    });

    $('#delete').click(function(){
      var id = table.rows('.selected').data()[0]['id'];
      $.ajax({
       type:'POST',
        data:{id: id},
      url:"http://cronose.test/cronose/views/datatables/deleteCategory.php"
      });
    });

});
</script>
</body>
</html>
