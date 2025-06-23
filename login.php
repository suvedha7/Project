<?php

include 'db.php';
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $username = $_POST["username"];
    $pass=$_POST["pass"];
    if (empty($username))
        echo '<script>alert("Username is required !!!");</script>';
    if (empty($pass))
        echo '<script>alert("Password is required !!!");</script>';
    if (!empty($username) && !empty($pass)) {
        $sql=$conn->prepare("select id,password from signup where username=?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $sql->store_result();
        $sql->bind_result($id,$password);
        if ($sql->fetch() && password_verify($pass, $password)) {
            $_SESSION["username"] = $username;
            $_SESSION["id"] = $id;
            header("Location:dashboard.php");
        }else {
            echo '<script>alert("Invalid credentials!");</script>';
        }
            
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
                        <h4 class="card-title">Login</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="username"
                                    id=""
                                    aria-describedby="helpId"
                                    placeholder=""
                                />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="pass"
                                    id=""
                                    aria-describedby="helpId"
                                    placeholder=""
                                />
                            </div>
                            <input
                                name=""
                                id=""
                                class="btn btn-success"
                                type="submit"
                                value="Login"
                            />
                            <button class="btn btn-warning" type="submit">
                           <a href="signup.php" class="text-black text-decoration-none">Not signed up ? SIGNUP HERE</a>
                        </button>
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
