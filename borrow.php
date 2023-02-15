<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require 'db/connect.php';
  connect();
  $b_id = '';
  $m_user = '';
  $SQL1 = 'SELECT m_user FROM tb_member ';
  $users = mysqli_query($GLOBALS['conn'], $SQL1);
  $SQL2 = 'SELECT b_id FROM tb_book ';
  $books = mysqli_query($GLOBALS['conn'], $SQL2);

  if (!empty($_GET['b_id'])) {
    $b_id = $_GET['b_id'];
    $SQL3 = 'SELECT * FROM tb_book where b_id = "' . $b_id . '"';
    $book = getData($SQL3);
  }
  if (!empty($_GET['m_user'])) {
    $m_user = $_GET['m_user'];
    $SQL4 = 'SELECT * FROM tb_member where m_user = "' . $m_user . '"';
    // echo $SQL4;
    $user = getData($SQL4);
  }

  if (!empty($_POST['borrow'])) {
    if (!empty($_GET['b_id']) || !empty($_GET['m_user'])) {
      $SQL4 = 'INSERT INTO tb_borrow_book (br_date_br,b_id,m_user) VALUES (NOW(),"' . $b_id . '","' . $m_user . '") ';
      // echo $SQL4;
      $res = mysqli_query($GLOBALS['conn'], $SQL4);
      if ($res) {
        echo "<script>alert('บันทึกข้อมูลแล้ว')</script>";
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
      } else {
        echo "<script>alert('ไม่สามารถยืมหนังสือได้')</script>";
      }
    }
  }
  ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  </link>
  <title>Library</title>
</head>

<body>
  <?php
  require 'req/navbar.php';
  ?>

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
        <form method="get">
          <div class="row g-3 mt-5 align-items-center form-inline">
            <div class="col-lg-4">
              <label for="inputPassword6" class="col-form-label">ผู้ที่ต้องการยืม:</label>
            </div>
            <div class="col-lg-6">
              <select class="form-select" id="m_user" name="m_user" aria-placeholder="">
                <option selected>ผู้ที่ต้องการยืม</option>
                <?php while ($item = mysqli_fetch_assoc($users)) { ?>
                  <option value="<?php echo $item['m_user'] ?>" <?php
                                                                if (@$_GET["m_user"] == $item['m_user']) {
                                                                  echo "selected";
                                                                }
                                                                ?>><?php echo $item['m_user'] ?></option>
                <?php } ?>
              </select>
            </div>
            <!-- <div class="col-lg-2">
              <button type="submit" class="btn btn-primary">ตกลง</button>
            </div> -->
          </div>
          <div class="row g-3 align-items-center form-inline mt-2">
            <div class="col-lg-4">
              <label for="inputPassword6" class="col-form-label">รหัสหนังสือ:</label>
            </div>
            <div class="col-lg-6">
              <select class="form-select" id="b_id" name="b_id" aria-placeholder="">
                <option selected>รหัสหนังสือ</option>
                <?php while ($item = mysqli_fetch_assoc($books)) {

                ?>
                  <option value="<?php echo $item['b_id'] ?>" <?php
                                                              if (@$_GET["b_id"] == $item['b_id']) {
                                                                echo "selected";
                                                              }
                                                              ?>><?php echo $item['b_id'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mt-3">
              <button type="submit" class="btn btn-primary">ตกลง</button>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <table class="table ">
        <tbody>
          <tr>
            <td>ชื่อ-สกุลผู้ยืม</td>
            <td>
              <?= @$user['m_name'] ?>
            </td>
          </tr>
          <tr>
            <td>รหัสหนังสือ</td>
            <td>
              <?= @$book['b_id'] ?>
            </td>
          </tr>
          <tr>
            <td>ชื่อหนังสือ</td>
            <td><?= @$book['b_name'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-lg-4"></div>
  </div>
  <form action="" method="post">

    <div class="row text-center">
      <div class="col-lg-4"> </div>
      <div class="col-lg-4">
        <input type="submit" id="borrow" name="borrow" value="ยืมหนังสือ" class="btn btn-primary">
        <a href="index.php" class="btn btn-danger">ยกเลิก</a>
      </div>
      <div class="col-lg-4">
      </div>
    </div>
  </form>
  </div>
</body>

</html>