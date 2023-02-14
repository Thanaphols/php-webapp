<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
  require 'db/connect.php';
  connect();
  $b_id = '' ;
  $b_name = '';
  $m_user = '';
  $SQL1 = 'SELECT m_user FROM tb_member ';
  $user = mysqli_query($GLOBALS['conn'],$SQL1);
  $SQL2 = 'SELECT b_id FROM tb_book ';
  $book = mysqli_query($GLOBALS['conn'],$SQL2);
  if(isset($_POST["b_id"] ) || (isset( $_POST["m_user"] ))){
    if(($_POST["b_id"] =='รหัสหนังสือ') || ($_POST["m_user"] == 'ผู้ที่ต้องการยืม')){
      if($b_name !='' || $b_id !=''){
        
      }
      echo "<script>alert('ชื่อผู้ใช้ หรือ ไอดีหนังสือ ไม่ถูกต้อง')</script>";
    }
    $m_user = $_POST["m_user"];
    $b_id = $_POST["b_id"];
    $SQL3= 'SELECT b_name FROM tb_book WHERE b_id= "'.$b_id.'" ';
    $result = mysqli_query($GLOBALS['conn'], $SQL3);
    $data = mysqli_fetch_assoc($result);
    @$b_name =  $data['b_name'];
  }
  
  if(isset($_POST['borrow'])){
    if( $m_user == ' ' || $b_id == ''){
      echo "<script>alert('กรูณากรอกข้อมูลให้ครบก่อนยืม')</script>";
    }
    $SQL4 = 'INSERT INTO tb_borrow_book (br_date_br,b_id,m_user) VALUES ("NOW()","'.$b_id.'","'.$m_user.'") ';
    echo $SQL4;
  }
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
    <div class="container">
      <div class="row text-center ">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4   mt-3 ">
        <a href="borrow.php" class="btn btn-primary w-25 mr-2">ยืมหนังสือ</a>
        <a href="return.php" class="btn btn-primary  w-25">คืนหนังสือ</a>
          </div>
          <div class="col-lg-4"></div>
      </div>
      <div class="row ">
        <div class="col-lg-4"> </div>
        <div class="col-lg-4 form-inline text-center mt-3 ">
        <h2>ยืมหนังสือ</h2>
        <div class="row g-3 mt-5 align-items-center form-inline">
              <div class="col-lg-4">
                <label for="inputPassword6" class="col-form-label">ผู้ที่ต้องการยืม:</label>
              </div>
              <div class="col-lg-6">
              <select class="form-select" id="m_user" name="m_user" aria-placeholder="">
                  <option selected>ผู้ที่ต้องการยืม</option>
                  <?php while ($users = mysqli_fetch_assoc($user)){ ?>
                  <option value="<?php echo $users['m_user'] ?>"><?php echo $users['m_user'] ?></option>
                  <?php } ?>
              </select>
              </div>
              <div class="col-lg-2">
                <button class="btn btn-primary">ตกลง</button>
              </div>
        </div>
        <div class="row g-3 align-items-center form-inline">
              <div class="col-lg-4">
                <label for="inputPassword6" class="col-form-label">รหัสหนังสือ:</label>
              </div>
              <div class="col-lg-6">
                <select class="form-select" id="b_id" name="b_id" aria-placeholder="">
                  <option selected>รหัสหนังสือ</option>
                  <?php while ($books = mysqli_fetch_assoc($book)){ ?>
                  <option value="<?php echo $books['b_id'] ?>"><?php echo $books['b_id'] ?></option>
                  <?php } ?>
              </select>
              </div>
              <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">ตกลง</button>
              </div>
        </div>
          </div>
      </div>
      </form>
      <div class="row mt-2">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
        <table class="table ">
        <tbody>
          <tr>
            <td>ชื่อ-สกุลผู้ยืม</td>
            <td class="text-left"> 
            <p>
              <?php  if($m_user == 'ผู้ที่ต้องการยืม'){ $m_user = ''; } echo $m_user ?>
            </p>
            </td>
          </tr>
          <tr>
            <td>รหัสหนังสือ</td>
            <td>
              <?php if($b_id == 'รหัสหนังสือ'){ $b_id = ''; }  echo $b_id ?>
            </td>
          </tr>
          <tr>
            <td>ชื่อหนังสือ</td>
            <td><?php echo $b_name ?></td>
          </tr>
        </tbody>
      </table>
        </div>
      <div class="col-lg-2"></div>
      </div>
      
      <div class="row text-center">
        <div class="col-lg-4"> </div>
          <div class="col-lg-4">
          <input type="submit" id="borrow" name="borrow" value="ยืมหนังสือ" class="btn btn-primary">
          <a href="index.php" class="btn btn-danger">ยกเลิก</a>
          </div>
          
          <div class="col-lg-4">
        </div>
      </div>
    </div>
</body>
</html>