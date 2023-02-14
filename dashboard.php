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
    $book_n = '';
    $lend_n = '';
    $member_n = '';
    $book_lend_n = 0;

    // book conut
    $sql_book_n = 'select * from tb_book';
    $result = mysqli_query($GLOBALS['conn'], $sql_book_n);
    $book_n = mysqli_num_rows($result);
    // member count
    $sql_member_n = 'select * from tb_member';
    $result_1 = mysqli_query($GLOBALS['conn'], $sql_member_n);
    $member_n = mysqli_num_rows($result_1);
    // lend count
    $sql_lend_n = 'select * from tb_borrow_book';
    $result_2 = mysqli_query($GLOBALS['conn'], $sql_lend_n);
    $lend_n = mysqli_num_rows($result_2);
    foreach ($result_2 as $row) {
        if ($row['br_date_rt'] == '0001-01-01') {
            $book_lend_n += 1;
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-3">
                <h3>ข้อมูลสถิติของห้องสมุด</h3>
            </div>
        </div>
        <div class="screen-center">
            <div class="row">
                <div class="col-md-6 col-sm-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            หนังสือทั้งหมด (เล่ม)
                        </div>
                        <div class="card-body text-center">
                            <h1><?= $book_n ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            การใช้บริการยืม - คืนหนังสือ (ครั้ง)
                        </div>
                        <div class="card-body text-center">
                            <h1><?= $lend_n ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            สมาชิกทั้งหมด (คน)
                        </div>
                        <div class="card-body text-center">
                            <h1><?= $member_n ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            หนังสือค้างส่ง (เล่ม)
                        </div>
                        <div class="card-body text-center">
                            <h1><?= $book_lend_n ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>