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
            if(isset($_POST['submit'])) {
                $category = $_POST['category'];
                $title = $_POST['title'];
                $about = $_POST['about'];
                $picture = $_FILES['picture']['name'];
                $content = $_POST['content'];
                $date = date('n/j/y');
                if(isset($_POST['archive'])) {
                    $archive = 1;
                }
                else {
                    $archive = 0;
                }

                $target = 'images/' . $picture;
                move_uploaded_file($_FILES['picture']['tmp_name'], $target);
 
                $query = "INSERT INTO news (date, title, about, content, picture, category, archive) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt=mysqli_stmt_init($dbc);
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ssssssi', $date, $title, $about, $content, $picture, $category, $archive);
                    mysqli_stmt_execute($stmt) or die('Error querying databese.');
                }
                mysqli_close($dbc);
            }
        ?>
        <h2 class="padding"><?php echo strtoupper($category)?></h2>
        <section>
            <article class="open-article">
                <h3 class="padding"><?php echo strtoupper($title)?></h3>
                <p class="padding"><?php echo $date?></p>
                <?php echo"<img class='article-image' src='images/$picture'>"?>
                <a class="bold" id="category-button" href="category.php?category=<?php echo $category?>"><?php echo strtoupper($category)?></a>
                <p class="article-content padding"><?php echo nl2br($content)?></p>
            </article>
        </section>
    </section>
    <footer>
        <p class="margin padding">© <?php echo date('Y')?> NEWSWEEK</p>
        <hr class="margin">
    </footer>
</body>
</html>