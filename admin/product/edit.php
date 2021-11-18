<?php 
    session_start();
    include_once "../../php/config.php";
    $this_id = $_GET['this_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản</title>
    <link rel="shortcut icon" href="../../img/logo3.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/b1f83b8c89.js" crossorigin="anonymous"></script>
    <style>
        table{
            white-space: nowrap;
        }
        .content{
            background-color: whitesmoke;
            overflow-x: scroll;
            margin: 50px auto !important;
            border-radius: 15px;
            width: 90%;
        }
        .button-add button{
            cursor: pointer;
        }
        a{
            text-decoration: none;
        }
       
        .up{
            border: 1px solid;
            border-radius: 5px;
            padding: 10px 10px;
            margin: 10px;
            background-color: lightgreen !important;
            color: black !important;
            font-weight: 600;
        }
        .down{
            border: 1px solid;
            border-radius: 5px;
            padding: 10px 10px;
            margin: 10px;
            background-color: lightcoral !important;
            color: black !important;
            font-weight: 600;
        }
        #container td:last-child{
            height: 50px;
            max-height: auto;
        }
    </style>
</head>
<body>
    <div id="main">
        <div id="header">
            <div class="header-content">
                <h2>Fashion Admin</h2>
                <div class="header-tool">
                    <button><i class="fas fa-envelope"></i></button>
                    <button><i class="fas fa-bell"></i></button>
                </div>
            </div>
        </div>
        <div id="nav-bar">
            <div class="bar-content">
                <div class="avatar">
                    <!-- <img src="/img/logo.png" alt=""> -->
                    <i class="fas fa-user-tie"></i>
                    <?php
                        $session = $_SESSION['a_mail'];

                        $sql = "SELECT * FROM tb_users WHERE email = '$session' ";
                        $rs = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($rs);
                    ?>  
                    <p style="margin: 10px;">
                        <?=$row['fullname'];?>
                    </p>
                </div>
                <div class="list-edit">
                <li><a  href="../index.php">Thống Kê</a></li>
                    <li><a href="../category/index.php" href="">Danh Sách Danh Mục</a></li>
                    <li><a class="active" href="./index.php">Danh Sách Sản Phẩm</a></li>
                    <li><a href="../news/index.php">Danh Sách Bài Viết</a></li>
                    <li><a href="../order/index.php">Danh Sách Đơn Hàng</a></li>
                    <li><a href="../account/index.php">Danh Sách Tài Khoản</a></li>
                    <li><a href="../logout/logout.php">Đăng Xuất</a></li>
                </div>
            </div>
        </div>
        <div id="container">
            <div class="content" style="display: flex; flex-direction: column; justify-content: center; width: 80%; overflow: hidden">

               
               <form action="edit.php?this_id=<?=$this_id?>" method="post" style="min-height: 200px; width: 50%; margin: 0 auto ; display: flex; flex-direction: column; justify-content: center;" enctype="multipart/form-data">

                        <?php 

                        $sql = "SELECT * FROM `tb_product` WHERE `id` = '".$this_id."' ";
                        $row = mysqli_fetch_array(mysqli_query($conn, $sql));
                        if(isset($_POST['editbtn'])){
                            
                            $name = $_POST['add_name'];
                            $stock = $_POST['add_stock'];
                            $img = $_FILES['add_img']['name'];
                            $description = $_POST['add_description'];
                            $price = $_POST['add_price'];
                            $category = $_POST['add_category'];
                            $img_tmp_name = $_FILES['add_img']['tmp_name'];

                            $img_check = ($img == "") ? $row['img'] : $img ;

                                $sql_edit = "UPDATE `tb_product` SET `name`='$name',`stock`='$stock',`img`='$img_check',`description`='$description',`price`='$price',`category_id`='$category' WHERE `id` = '$this_id' ";
                                
                                mysqli_query($conn, $sql_edit);
                                move_uploaded_file($img_tmp_name, '../../img/'.$img);
                                header("location: index.php?success=Đã thay đổi thành công!");
                            }
                        ?>

                        <div style="width: 80%; margin: 0 auto; display: inline-flex; align-items: center">
                            <label for="add_name" style="width: 120px; margin: 10px 0">Tên Sản Phẩm</label>
                            <input type="text" name="add_name" style="width: 65%; margin: 10px 0; padding: 5px 0 5px 10px;border: 1px solid; border-radius: 5px; height: 30px;" required value="<?=$row['name'];?>">
                        </div>

                        <div style="width: 80%; margin: 0 auto; display: inline-flex; align-items: center">
                            <label for="add_stock" style="width: 120px; margin: 10px 0">Kho</label>
                            <input type="number" name="add_stock" style="width: 65%; margin: 10px 0; padding: 5px 0 5px 10px;border: 1px solid; border-radius: 5px; height: 30px;"
                            value="<?=$row['stock'];?>">
                        </div>

                        <div style="width: 80%; margin: 0 auto; display: inline-flex; align-items: center">
                            <label for="add_img" style="width: 120px; margin: 10px 0">Hình Ảnh</label>
                            <input type="file" name="add_img" style="width: 40%; margin: 10px 0; padding: 5px 0 5px 10px;border: 1px solid; border-radius: 5px; height: 30px;">
                            <img src="../../img/<?=$row['img']?>" style="width: 70px; height: 90px; margin: 0 10px;">
                        </div>

                        <div style="width: 80%; margin: 0 auto; display: inline-flex; align-items: center">
                            <label for="add_description" style="width: 120px; margin: 10px 0;">Mô Tả</label>
                            <textarea type="date" name="add_description" style="width: 65%; margin: 10px 0; padding: 5px 0 5px 10px;border: 1px solid; border-radius: 5px; height: 30px;resize: none; height: 100px;"><?= $row['description'] ?></textarea>
                        </div>

                        <div style="width: 80%; margin: 0 auto; display: inline-flex; align-items: center">
                            <label for="add_price" style="width: 120px; margin: 10px 0;">Giá</label>
                            <input type="number" name="add_price" style="width: 30%; margin: 10px 0; padding: 5px 0 5px 10px ;border: 1px solid; border-radius: 5px; height: 30px;" value="<?=$row['price']?>">
                        </div>

                        <div style="width: 80%; margin: 0 auto; display: inline-flex; align-items: center;">
                            <label for="add_category" style="width: 120px; margin: 10px 0;">Danh Mục</label>
                            <select name="add_category" id="" style="margin: 10px 0; padding: 10px 0 10px 10px;  border: 1px solid; border-radius: 5px ">
                            <?php
                                $sql_category = "SELECT * FROM `tb_category`";
                                $rs = mysqli_query($conn, $sql_category);
                                while ($row = mysqli_fetch_array($rs)) {
                            ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                         
                        <div class="button-add" style="text-align: center;" >
                            <button type="submit" name="editbtn">Sửa</button>
                        </div>
                </form>
            </div>
           
        </div>
    </div>
</body>
</html>