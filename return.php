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
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    </link>
    <title>Document</title>
</head>
<style>
    .screen-center {
        display: flex;
        justify-content: center;
        align-self: start;
    }
</style>

<body>
    <?php
    require 'req/navbar.php';
    $lend = '';
    $meg = '';
    $meg1 = '';
    $sql = 'select * from tb_book';
    $result = mysqli_query($GLOBALS['conn'], $sql);

    if (!empty($_POST['b_id'])) {
        $b_id = $_POST['b_id'];
        $sql = "SELECT `tb_borrow_book`.*, `tb_book`.`b_name`, `tb_member`.`m_name`
        FROM `tb_borrow_book` 
            LEFT JOIN `tb_book` ON `tb_borrow_book`.`b_id` = `tb_book`.`b_id` 
            LEFT JOIN `tb_member` ON `tb_borrow_book`.`m_user` = `tb_member`.`m_user`
        WHERE `tb_borrow_book`.`b_id` = '" . $b_id . "' and tb_borrow_book.br_date_rt = '0001-01-01';";
        $result_1 = mysqli_query($GLOBALS['conn'], $sql);

        if (mysqli_num_rows($result_1) == 0) {
            $meg = '<div class="alert alert-warning alert-dismissible fade show col-md-10 mt-2" role="alert">
                        <strong>คำเตือน</strong> ไม่พบรหัสหนังสือที่มีการยืม
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else {
            $lend = mysqli_fetch_assoc($result_1);
        }
    }
    if (!empty($_POST['lend'])) {
        $b_id = $_POST['b_id'];
        $m_user = $_POST['m_user'];
        $br_date_br = $_POST['br_date_br'];
        $br_fine = $_POST['br_fine'] == '' ? 0 : $_POST['br_fine'];
        $sql = "update tb_borrow_book set br_date_rt = now(), br_fine = '" . $br_fine . "' where br_date_br = '" . $br_date_br . "' and b_id = '" . $b_id . "' and m_user = '" . $m_user . "'";
        $result_2 = mysqli_query($GLOBALS['conn'], $sql);
        if ($result_2) {
            $meg1 = '<div class="alert alert-success alert-dismissible fade show col-md-10 mt-2" role="alert">
                        <strong>แจ้งเตือน</strong> ทำรายการสำเร็จ
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            echo '<meta http-equiv="refresh" content="5; url=index.php">';
        }
    }





    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-3">
                <h3>คืนหนังสือ</h3>
            </div>
        </div>
        
        <div class="mb-3 row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="col-md-12">
                        <label for="staticEmail" class="col-form-label my-2">รหัสหนังสือที่ต้องการคืน</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-select" aria-label="Default select example" name="b_id">
                            <option selected>เลือกข้อมูล</option>
                            <?php
                            foreach ($result as $row) {
                            ?>
                                <option value="<?= $row['b_id'] ?>"><?= $row['b_id'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2 mt-2">
                        <input type="submit" name="save" class="btn btn-outline-primary" value="ค้นหา" />
                    </div>
                </form>
                <?= @$meg ?>
            </div>
            <div class="col-md-3"></div>

        </div>
        <div class="mb-3 row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="" method="post">
                    <div>
                        <label for="inputPassword" class="col-sm-2 col-form-label">รหัสหนังสือ</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" name="b_id" value="<?= @$lend['b_id']; ?>">
                            <input type="hidden" name="b_id" value="<?= @$lend['b_id']; ?>">
                        </div>
                    </div>
                    <div>
                        <label for="inputPassword" class="col-sm-2 col-form-label">ชื่อหนังสือ</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" name="b_name" value="<?= @$lend['b_name'] ?>">
                        </div>
                    </div>
                    <div>
                        <label for="inputPassword" class="col-sm-2 col-form-label">ผู้ยืม-คืนหนังสือ</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" name="m_name" value="<?= @$lend['m_name'] ?>">
                            <input type="hidden" name="m_user" value="<?= @$lend['m_user'] ?>">
                        </div>
                    </div>
                    <div>
                        <label for="inputPassword" class="col-sm-2 col-form-label">วันที่ยืมหนังสือ</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control" name="br_date_br" value="<?= @$lend['br_date_br'] ?>">
                            <input type="hidden" name="br_date_br" value="<?= @$lend['br_date_br'] ?>">
                        </div>
                    </div>
                    <div>
                        <label for="inputPassword" class="col-sm-2 col-form-label">ค่าปรับ</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="กรอกค่าปรับหนังสือ" class="form-control" name="br_fine">
                        </div>
                    </div>
                    <?= @$meg1 ?>
                    <div class="mt-3">
                        <input type="submit" name="lend" class="btn btn-outline-primary" value="คืนหนังสือ" />
                        <a href="index.php" class="btn btn-outline-danger">ยกเลิก</a>
                    </div>
                </form>
            </div>

            <div class="col-md-3"></div>

        </div>
        <div class="screen-center">
            <div class="row">

            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>