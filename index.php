<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
  require 'db/connect.php';
  connect();
  $search=" WHERE 1=1 ";
  if(isset($_POST['search'])){
    if($_POST['search']!=''){
      $search .= ' AND (( b_name LIKE "%'.$_POST['search'].'%" ) ';
      $search .= ' OR ( m_name LIKE "%'.$_POST['search'].'%" )) ';
    }
  }
  $SQL = "SELECT tb_borrow_book.*, tb_book.b_name, tb_member.m_name
      FROM tb_borrow_book 
      LEFT JOIN tb_book ON tb_borrow_book.b_id = tb_book.b_id 
      LEFT JOIN tb_member ON tb_borrow_book.m_user = tb_member.m_user".$search."  ORDER BY br_date_br DESC ";
  //echo $SQL;
  $data = mysqli_query($GLOBALS['conn'],$SQL);
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
      <div class="row">
          <div class="col-lg-12 text-center mt-3">
            <h3>การจัดการข้อมูลการยืม-คืนหนังสือ</h3>
          </div>
      </div>
      <div class="row ">
        <div class="col-lg-3">
          
        </div>
        <div class="col-lg-6  mt-3 form-inline">
            <input id="search" class="form-control w-75 mr-2" type="text" 
            name="search" placeholder="ค้นหาจากชื่อ">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
          </div>
          <div class="col-lg-3">
          
        </div>
      </div>
      <div class="row ">
        <div class="col-lg-8">
          
        </div>
        <div class="col-lg-2  mt-3 form-inline">
           <a href="borrow.php" class="btn btn-primary mr-2">ยืม-คืนหนังสือ</a>
            <a href="dashboard.php" class="btn btn-primary">ข้อมูลสถิติ</a>
          </div>
          
      </div>
      <div class="row mt-2">
        <div class="col-lg-2"></div>
            <table class="table col-lg-8">
        <thead>
          <tr>
            <th scope="col">รหัสหนังสือ</th>
            <th scope="col">ชื่อหนังสือ</th>
            <th scope="col">ผู้ยืม-คืน</th>
            <th scope="col">วันที่ยืม</th>
            <th scope="col">วันที่คืน</th>
            <th scope="col">ค่าปรับ</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($datas = mysqli_fetch_assoc($data)){ ?>
          <tr>
            <td><?php echo $datas['b_id'] ?></td>
            <td><?php echo $datas['b_name'] ?></td>
            <th ><?php echo $datas['m_name'] ?></th>
            <td><?php echo $datas['br_date_br'] ?></td>
            <td><?php echo $datas['br_date_rt'] ?></td>
            <td><?php echo $datas['br_fine'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="col-lg-2"></div>
      </div>
    </div>
    </form>
</body>
</html>