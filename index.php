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
    <title>Document</title>
</head>
<body>
    <?php
      require 'req/navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row">
          <div class="col-12 text-center mt-3">
            <h3>การจัดการข้อมูลการยืม-คืนหนังสือ</h3>
          </div>
      </div>
    </div>
</body>
</html>