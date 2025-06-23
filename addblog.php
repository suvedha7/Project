<?php

include 'db.php';

if(!isset($_SESSION["id"])) {
    header("Location:login.php");
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
    if (empty($img_name))
        echo '<script>alert("Image file is required !!!");</script>';
    else if (!empty($title) && !empty($content)&& !empty($img_name)){
        $sql=$conn->prepare("call insertArt(?,?,?,?)");
        $sql->bind_param("ssis", $title, $content,$user_id,$img_name);
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
                        <h4 class="card-title">Add Art</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="title"
                                    id=""
                                    aria-describedby="helpId"
                                    placeholder=""
                                />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="" class="form-label">Choose file</label>
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
                                value="Add"
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
