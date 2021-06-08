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
        <form action="input-show.php" method="POST" enctype="multipart/form-data" class="padding">
            <label for="title">Title:</label><br>
            <input class="input" type="text" name="title" id="title"><br>
            <span id="titleMessage" class="error"></span><br>
            <label for="about">About:</label><br>
            <textarea class="input" name="about" id="about" cols="50" rows="10"></textarea><br>
            <span id="aboutMessage" class="error"></span><br>
            <label for="content">Content:</label><br>
            <textarea class="input" name="content" id="content" cols="50" rows="10"></textarea><br>
            <span id="contentMessage" class="error"></span><br>
            <label for="picture">Picture: </label><br>
            <input type="file" accept="image/*" name="picture" id="picture"/><br>
            <span id="pictureMessage" class="error"></span><br>
            <label for="category">Category</label><br>
            <select name="category" id="category"><br>
                <option value="" selected disabled hidden>Choose here</option>
                <option value="U.S.">U.S</option>
                <option value="World">World</option>
            </select><br>
            <span id="categoryMessage" class="error"></span><br>
            <label>Save in archive?: <input type="checkbox" name="archive"></label><br><br>
            <button type="reset" value="Reset">Reset</button>
            <button type="submit" name="submit" id="submit" value="Submit">Submit</button>
        </form>
        <script type="text/javascript" src="js/validation-input.js"></script>
    </section>
    <footer>
        <p class="margin padding">© <?php echo date('Y')?> NEWSWEEK</p>
        <hr class="margin">
    </footer>
</body>
</html>