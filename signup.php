<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $epass = password_hash($pass, PASSWORD_DEFAULT);
    $cpass = $_POST["cpass"];

    if (empty($name) || empty($email) || empty($username) || empty($pass) || empty($cpass))
        echo '<script>alert("Please fill out all details !!!");</script>';
    if (!filter_var($email,FILTER_VALIDATE_EMAIL))
        echo '<script>alert("Email should be of proper format !!!");</script>';
    if ($cpass!=$pass)
        echo '<script>alert("Password does not match !!!");</script>';
    else if (!empty($name) && !empty($email) && !empty($username) && !empty($pass) && !empty($cpass) && filter_var($email, FILTER_VALIDATE_EMAIL) && $cpass==$pass) {
        $sql = $conn->prepare("insert into signup(name,email,username,password) values(?,?,?,?)");
        $sql->bind_param("ssss", $name, $email, $username, $epass);
        $sql->execute();
        header("Location:login.php");
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
            <div class="container p-5" style="max-width: 50%;">
                <div class="card text-start">
                    <div class="card-body bg-black text-white">
                        <h4 class="card-title">SIGNUP FORM</h4>
                        <form action="" method="post">
                            <div class="form-floating mb-3 text-secondary">
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="formId1"
                                placeholder=""
                            />
                            <label for="formId1">Name</label>
                        </div>
                        <div class="form-floating mb-3 text-secondary">
                            <input
                                type="text"
                                class="form-control "
                                name="email"
                                id="formId1"
                                placeholder=""
                            />
                            <label for="formId1">Email</label>
                        </div>
                        <div class="form-floating mb-3 text-secondary">
                            <input
                                type="text"
                                class="form-control"
                                name="username"
                                id="formId1"
                                placeholder=""
                            />
                            <label for="formId1">Username</label>
                        </div>
                        <div class="form-floating mb-3 text-secondary">
                            <input
                                type="password"
                                class="form-control"
                                name="pass"
                                id="formId1"
                                placeholder=""
                            />
                            <label for="formId1">Password</label>
                        </div>
                        <div class="form-floating mb-3 text-secondary">
                            <input
                                type="password"
                                class="form-control"
                                name="cpass"
                                id="formId1"
                                placeholder=""
                            />
                            <label for="formId1">Confirm Password</label>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-success"
                        >
                            SIgnup
                        </button>
                        <a
                            name=""
                            id=""
                            class="btn btn-warning"
                            href="login.php"
                            role="button"
                            >Already signed up ? LOGIN HERE</a
                        >
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
