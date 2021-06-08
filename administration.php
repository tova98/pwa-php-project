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

        include 'connect.php';
        define('IMGFOLDER', 'images/');

        $successfulLogin = false;
        $wrongPassword = false;

        if(isset($_POST['login'])) {
            $query = "SELECT username, password, level FROM users WHERE username=?";
            $stmt=mysqli_stmt_init($dbc);
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
                mysqli_stmt_execute($stmt) or die('Error querying databese.');
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $fusername, $fpassword, $flevel);
                mysqli_stmt_fetch($stmt);
            }

            if(password_verify($_POST['password'], $fpassword)) {
                $successfulLogin = true;
                if($flevel == 1) {
                    $admin = true;
                }
                else {
                    $admin = false;
                }
                $_SESSION['username'] = $fusername;
                $_SESSION['level'] = $flevel;
            }
            else {
                $successfulLogin = false;
                $wrongPassword = true;
            }
        }
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
            if($wrongPassword) {
                echo "<h3  class='padding'>Wrong username or password!</h3>";
            }
            if(($successfulLogin && $admin) || (isset($_SESSION['username']) && $_SESSION['level'] == 1)) {
                include 'admin-helper.php';

                echo '
                <label class="margin" for="choose-edit">Choose which news to modify:</label><br>
                <select name="choose-edit" class="input margin" onchange="changeFormValues(this.value)">
                    <option value="" selected disabled hidden>Choose here</option>
                ';
                        $query = "SELECT id, title FROM news";
                        $stmt=mysqli_stmt_init($dbc);
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_execute($stmt) or die('Error querying databese.');
                            mysqli_stmt_store_result($stmt);
                            mysqli_stmt_bind_result($stmt, $chid, $chtitle);
                        }
                        while(mysqli_stmt_fetch($stmt)) {
                            echo '<option value="'. $chid .'">'. $chtitle . '</option>';
                        }
                        mysqli_close($dbc);  
                echo '</select><br><br><br>';
        ?>
                <form action="" method="POST" enctype="multipart/form-data" class="padding">
                    <label for="title">Title:</label><br>
                    <input class="input" type="text" name="title" id="title" value="<?php echo $title?>"><br>
                    <span id="titleMessage" class="error"></span><br>
                    <label for="about">About:</label><br>
                    <textarea class="input" name="about" id="about" rows="10" ><?php echo $about?></textarea><br>
                    <span id="aboutMessage" class="error"></span><br>
                    <label for="content">Content:</label><br>
                    <textarea class="input" name="content" id="content" rows="10"><?php echo $content?></textarea><br>
                    <span id="contentMessage" class="error"></span><br>
                    <label for="picture">Picture: </label><br>
                    <input type="file" accept="image/jpg,image/gif" name="picture" id="picture"/><br><br>
                    <input type="hidden" name="picture-helper" value="<?php echo $picture?>">
                    <img src="<?php echo IMGFOLDER . $picture?>" class="admin-img"><br><br>
                    <label for="category">Category</label><br>
                    <select name="category" id="category"><br> 
                    <?php
                            if($category == "U.S.") {
                                echo '<option selected value="U.S.">U.S</option>';
                                echo '<option value="World">World</option>';
                            }
                            else {
                                echo '<option value="U.S.">U.S.</option>';
                                echo '<option selected value="World">World</option>';
                            }
                    ?>
                    </select><br><br>
                    <?php
                        if($archive == 0) {
                            echo '<label>Save in archive?: <input type="checkbox" name="archive"></label><br><br>';
                        }
                        else {
                            echo '<label>Save in archive?: <input type="checkbox" name="archive" checked></label><br><br>';
                        }
                    ?>
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <button type="reset" value="Reset">Reset</button>
                    <button type="submit" name="update" id="update" value="Submit">Update</button>
                    <button type="submit" name="delete" value="Delete">Delete</button>
                </form>
                <script type="text/javascript" src="js/validation-administration.js"></script>
            <?php
            }
            else if($successfulLogin && !$admin) {
                echo "<h3 class='padding'>Hi " . $fusername . "! You're logged in, but you need to be administrator to access this page.</h3>";
            }
            else if(isset($_SESSION['username']) && $_SESSION['level'] == 0) {
                echo "<h3 class='padding'>Hi " . $_SESSION['username'] . "! You're logged in, but you need to be administrator to access this page.</h3>";
            }
            else {
                echo '
                    <h3 class="padding">Please login to view this page</h3>
                    <form method="POST" class="padding">
                        <label for="username">Username:</label><br>
                        <input class="" type="text" name="username"><br>
                        <label for="password">Password:</label><br>
                        <input class="" type="password" name="password"><br><br>
                        <button type="submit" name="login" value="Login">Login</button>
                    </form>
                ';
            }
        ?>
        <script type="text/javascript">
            function changeFormValues(id) {
                window.location = "?id=" + id;
            }
        </script>
    </section>
    <footer>
        <p class="margin padding">© <?php echo date('Y')?> NEWSWEEK</p>
        <hr class="margin">
    </footer>
</body>
</html>