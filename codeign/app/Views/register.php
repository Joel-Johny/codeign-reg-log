
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="vh-align">

    <form method="post" action="./register" class="flex-col-direction" id="register-form">
        <h3> REGISTER </h3>

        <input type="email" placeholder="Email" name="email" size=35 required>
        <span class="validate email_err"><?php echo (isset($email_err))?$email_err:"" ?></span>

        <input type="text" placeholder="Username" name="username" required>
        <span  class="validate username_err"><?php echo (isset($username_err))?$username_err:"" ?></span>

        <input type="password" placeholder="Password" name="password" required>
        <span  class="validate password_err"><?php echo (isset($password_err))?$password_err:"" ?></span>

        <input type="password" placeholder="Confirm Password" name="c-password" required>
        <span  class="validate c_password-err"><?php echo (isset($c_password_err))?$c_password_err:"" ?></span>

        <button type="submit" id="form-submit">REGISTER</button>

        <span class="validate dbValidation"><?php echo (isset($dbValidation))?$dbValidation:"" ?></span>

        <a href="./login">Already a User?</a>

    </form>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> -->
    <!-- <script src="./index.js"></script> -->

</body>
</html>
