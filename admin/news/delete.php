<?php
    include_once "../../php/config.php";

    $this_id = $_GET['this_id'];
    
    $sql = "DELETE FROM `tb_post` WHERE `id` = '" . $this_id . "'  ";

    mysqli_query($conn, $sql);

    header("location: index.php?error=Đã xóa thành công!");