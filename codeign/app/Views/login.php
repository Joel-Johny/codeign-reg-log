
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="vh-align">

    <form method="post" action="./login" class="flex-col-direction" id="login-form">
        <h3> LOGIN </h3>
        <input type="text" placeholder="Username" name="username" size=30 required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit">LOGIN</button>
        <span class="validate login_err"><?php echo (isset($login_err))?$login_err:"" ?></span>

        <a href="./register">New User?</a>

    </form>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> -->
<!-- <script src="./index.js"></script> -->
</body>
</html>