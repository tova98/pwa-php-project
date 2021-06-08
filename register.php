<!DOCTYPE  html>
<html>
<head>
    <title>Newsweek</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Suez+One&display=swap" rel="stylesheet"> 
</head>
<body>
    <?php
        session_start();
    ?>
    <header>
        <h1>Newsweek</h1>
        <p class="bold" id="date"><?php echo date('D, M d, Y')?></p> 
    </header>
    <nav class="container bold">
        <a class="padding" href="index.php">Home</a>
        <span class="vdivider"></span>
        <a class="padding" href="category.php?category=U.S.">U.S.</a>
        <span class="vdivider"></span>
        <a class="padding" href="category.php?category=World">World</a>
        <span class="vdivider"></span>
        <a class="padding" href="administration.php">Administration</a>
        <?php
            if(isset($_SESSION['username'])) {
                echo '
                <span class="vdivider"></span>
                <a class="padding" href="input.php">Input</a>
                <span class="vdivider"></span>
                <a class="padding" href="logout.php">Log out</a>
                ';
            }
            else {
                echo '
                <span class="vdivider"></span>
                <a class="padding" href="register.php">Register</a>
                ';
            }
        ?>
    </nav>
    <section id="main">
        <?php
            include 'connect.php';
            
            if(isset($_POST['register'])) {
                $query = "SELECT username FROM users WHERE username=?";
                $stmt=mysqli_stmt_init($dbc);
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
                    mysqli_stmt_execute($stmt) or die('Error');
                    mysqli_stmt_store_result($stmt);
                }
                if(mysqli_stmt_num_rows($stmt) > 0) {
                    echo "<script>alert('Error! Username already in use!')</script>";
                }
                else {
                    $hashedPassword = password_hash($_POST['password'], CRYPT_BLOWFISH);
                    $query = "INSERT INTO users (firstName, lastName, username, password, level) VALUES (?, ?, ?, ?, '0')";
                    $stmt=mysqli_stmt_init($dbc);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'ssss', $_POST['firstname'], $_POST['lastname'], $_POST['username'], $hashedPassword);
                        $result = mysqli_stmt_execute($stmt);
                    }
                    if($result) {
                        echo "<script>alert('Your registration was successful! Proceed to Administration to login.')</script>";
                    } 
                }
                mysqli_close($dbc);
            }
        ?>
        <h2 class="padding">Use the form to register</h2>
        <form class="padding" method="POST">
            <label for="firstname">First name:</label><br>
            <input class="" type="text" name="firstname" id="fname"><br>
            <span id="fnMessage" class="error"></span><br>
            <label for="lastname">Last name:</label><br>
            <input class="" type="text" name="lastname" id="lname"><br>
            <span id="lnMessage" class="error"></span><br>
            <label for="username">Username:</label><br>
            <input class="" type="text" name="username" id="username"><br>
            <span id="usernameMessage" class="error"></span><br>
            <label for="password">Password:</label><br>
            <input class="" type="password" name="password" id="password"><br>
            <span id="pwMessage" class="error"></span><br>
            <label for="reppassword">Repeat password:</label><br>
            <input class="" type="password" name="reppassword" id="reppassword"><br>
            <span id="rpwMessage" class="error"></span><br>
            <button type="submit" name="register" value="Register" id="register">Register</button><br><br>
        </form>
        <script type="text/javascript" src="js/registration.js"></script>
    </section>
    <footer>
        <p class="margin padding">© <?php echo date('Y')?> NEWSWEEK</p>
        <hr class="margin">
    </footer>
</body>
</html>