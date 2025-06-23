<?php
include 'db.php';
$id = isset($_GET["id"]) ? $_GET["id"] : null;
if(isset($_GET["id"])){
    $sql = $conn->prepare("select * from arts where id=?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $data = $sql->get_result()->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $img_name = $_FILES['image']['name'];
    $user_id=$_SESSION["id"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "images/$img_name");
    if (empty($title))
        echo '<script>alert("Title is required !!!");</script>';
    if (empty($content))
        echo '<script>alert("Content is required !!!");</script>';
    else if (!empty($title) && !empty($content)){
        if (empty($img_name)) {
            $img_name = $data['img_name'];
        } 
        else {
            $filePath = "images/" . $data['img_name'];
            if (file_exists($filePath)) {
                unlink($filePath); 
            }
        }
        $sql=$conn->prepare("call updateArt(?,?,?,?,?)");
        $sql->bind_param("ssisi", $title, $content,$user_id,$img_name,$id);
        $sql->execute();
        header("Location:dashboard.php");
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <body class="bg-secondary">
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container my-5 " style="max-width: 50%;">
                <div class="card bg-black text-white">
                    <div class="card-body">
                        <h4 class="card-title">Edit Art</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="title"
                                    id=""
                                    value="<?php echo $data["title"]; ?>"
                                    aria-describedby="helpId"
                                    placeholder=""
                                />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Content</label>
                                <textarea class="form-control" name="content"  id="" rows="3"><?php echo $data["content"]; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Current file</label>
                                <input class="form-control" type="text" name="i" id="" value="<?php echo $data["img_name"]; ?>"></input> <br>
                                <img src="images/<?php echo $data['img_name']; ?>" width="100" height="100">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Replace file</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id=""
                                    placeholder=""
                                    aria-describedby="fileHelpId"
                                />
                            </div>
                            <input
                                name=""
                                id=""
                                class="btn btn-success d-block mx-auto "
                                type="submit"
                                value="Edit"
                            />      
                        </form>
                    </div>
                </div>   
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>