<?php

include 'db.php';
$result = $conn->query("select a.*,s.name from arts a join signup s on s.id=a.user_id");

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

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <nav
                class="navbar navbar-expand-sm navbar-dark px-5 bg-black"
            >
                <a class="navbar-brand" href="#">SS Arts</a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                ></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php" aria-current="page"
                                >Home <span class="visually-hidden">(current)</span></a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addblog.php">Add Your Art</a>
                        </li>
                        
                    </ul>
                        <button class="btn btn-warning my-2 my-sm-0" type="submit">
                           <a href="logout.php" class="text-black text-decoration-none">Logout</a>
                        </button>
                    </form>
                </div>
            </nav>
            
            <div class="container my-4">
                <h3>Welcome <?php echo $_SESSION["username"];?></h3>
                <?php while($row=$result->fetch_assoc()) { ?>
                    
                    <div class="row justify-content-center bg-black p-4 m-4">
                        <div class="col-5 d-flex  align-items-center justify-content-center">
                            <img src="images/<?php echo $row['img_name']; ?>" width="300px" height="300px" alt="" srcset="">
                        </div>
                        <div class="col-7 text-white">
                            <div class="row " >
                                <div class="row justify-content-center align-items-center g-2" >
                                <div class="col">
                                    By : <?php echo $row["name"]; ?>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2" >
                                <div class="col">
                                    Title : <?php echo $row["title"]; ?>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2" >
                                <div class="col">
                                    Content : <?php echo $row["content"]; ?>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2" >
                                <div class="col">
                                    Created at : <?php echo $row["created_at"]; ?>
                                </div>
                            </div>
                            </div>
                            <?php if ($_SESSION["id"] == $row["user_id"]) { ?>
                            <div class="row m-5 g-5" >
                                <div class="col d-flex justify-content-end ">
                                    <button class="btn btn-success my-2 my-sm-0" type="submit">
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="text-black text-decoration-none">Edit</a>
                                </button> &emsp;
                                <button class="btn btn-danger my-2 my-sm-0" type="submit">
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Do you want to delete this art ?');" class="text-black text-decoration-none">Delete</a>
                                </button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                <?php } ?>
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
