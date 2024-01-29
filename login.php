<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user
            WHERE email = '%s'",
            $mysqli->real_escape_string($_POST["email"]));


    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

       if (password_verify($_POST["password"], $user["password_hash"])) {

        session_start();

        session_regenerate_id();

        $_SESSION["user_id"] = $user["id"];

        header("Location: index.php");
        exit;

        }
    }

    $is_invalid = true;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <div class="form-container-login">
        <h1>Login</h1>
        <form method="post">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>    

            <button>Log in</button>

            <p>Don't have an account?<a href="signup.html"> Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>