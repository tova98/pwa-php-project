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
        <a class="padding"  href="category.php?category=World">World</a>
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
        ?>
        <hr class="margin">
        <h2 class="padding">U.S.</h2>
        <div class="container padding">
            <?php
                $query = "SELECT * FROM news WHERE archive=0 AND category='U.S.' LIMIT 3";
                $result = mysqli_query($dbc, $query);

                while($row = mysqli_fetch_array($result)) {
                    echo '<article class="article padding">';
                    echo '<img class="image" src="' . IMGFOLDER . $row["picture"] . '">';
                    echo '<a href="article.php?id=' . $row['id'] . '">';
                    echo '<h3 class="padding">' . $row['title'] . '</h3>';
                    echo '</a></article>';
                }
            ?>
        </div>
        <hr class="margin">
        <h2 class="padding">World</h2>
        <div class="container padding">
            <?php
                $query = "SELECT * FROM news WHERE archive=0 AND category='World' LIMIT 3";
                $result = mysqli_query($dbc, $query);

                while($row = mysqli_fetch_array($result)) {
                    echo '<article class="article padding">';
                    echo '<img class="image" src="' . IMGFOLDER . $row["picture"] . '">';
                    echo '<a href="article.php?id=' . $row['id'] . '">';
                    echo '<h3 class="padding">' . $row['title'] . '</h3>';
                    echo '</a></article>';
                }
            ?>
        </div>
    </section>
    <footer>
        <p class="margin padding">© <?php echo date('Y')?> NEWSWEEK</p>
        <hr class="margin">
    </footer>
</body>
</html>