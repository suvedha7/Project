<?php

include 'db.php';

$id = isset($_GET["id"]) ? $_GET["id"] : null;

if(isset($_GET["id"])){
    $d = $conn->prepare("select img_name from arts where id=?");
    $d->bind_param("i", $id);
    $d->execute();
    $data = $d->get_result()->fetch_assoc();
    $filePath = "images/" . $data['img_name'];
        if (file_exists($filePath)) {
            unlink($filePath); 
        }
    $sql=$conn->prepare("delete from arts where id=?");
    $sql->bind_param("i", $id);
    $sql->execute();
}
    header("Location:dashboard.php");



?>