<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
  require 'db/connect.php';
  connect();
  
  ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" ></link> 
    <title>Library</title>
</head>
<body>
    <?php
      require 'req/navbar.php';
    ?>
    <form method="post">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-lg-4">
          
        </div>
        <div class="col-lg-4  mt-3 form-inline">
        <a href="borrow.php" class="btn btn-primary mr-2">ยืมหนังสือ</a>
        <a href="return.php" class="btn btn-primary">คืนหนังสือ</a>
          </div>
          <div class="col-lg-4">
          
        </div>
      </div>
      <div class="row ">
        <div class="col-lg-8">
          
        </div>
        <div class="col-lg-2  mt-3 form-inline">
          
          </div>
          
      </div>
      <div class="row mt-2">
        <div class="col-lg-2"></div>
            <table class="table col-lg-8">
        <thead>
          <tr>
            <th scope="col">รหัสหนังสือ</th>
            <th scope="col">ชื่อหนังสือ</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>ชื่อ-สกุล</td>
            <td>รหัสหนังสือ</td>
          </tr>
          <tr>
            <td>ชื่อ-สกุล</td>
            <td>รหัสหนังสือ</td>
          </tr>
          <tr>
            <td>ชื่อ-สกุล</td>
            <td>รหัสหนังสือ</td>
          </tr>
          <tr>
            <td>ชื่อ-สกุล</td>
            <td>รหัสหนังสือ</td>
          </tr>
        </tbody>
      </table>
      <div class="col-lg-2"></div>
      </div>
    </div>
    </form>
</body>
</html>