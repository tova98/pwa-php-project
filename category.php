<!DOCTYPE  html>
<html lang="en">
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
            define('IMGFOLDER', 'images/');

            $category = $_GET['category'];
        ?>
        <hr class="margin">
        <h2 class="padding"><?php echo $category;?></h2>
        <div class="container padding">
            <?php
                $query = "SELECT id, title, picture FROM news WHERE category=? AND archive=0";
                $stmt=mysqli_stmt_init($dbc);
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $category);
                    mysqli_stmt_execute($stmt) or die('Error querying databese.');
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $id, $title, $picture);
                    while(mysqli_stmt_fetch($stmt)) {
                        echo '<article class="article padding">';
                        echo '<img class="image" src="' . IMGFOLDER . $picture . '">';
                        echo '<a href="article.php?id=' . $id . '">';
                        echo '<h3 class="padding">' . $title . '</h3>';
                        echo '</a></article>';
                    }
                }
                mysqli_close($dbc);
            ?>
        </div>
    </section>
    <footer>
        <p class="margin padding">© <?php echo date('Y')?> NEWSWEEK</p>
        <hr class="margin">
    </footer>
</body>
</html>