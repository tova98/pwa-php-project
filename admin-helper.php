<?php
    if(isset($_POST['delete'])) {
        $did = $_POST['id'];
        $query = "DELETE FROM news WHERE id=?";
        $stmt=mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $did);
            mysqli_stmt_execute($stmt) or die('Error querying databese.');
        }
    }

    if(isset($_POST['update'])) {
        if(empty($_FILES['picture']['name'])) {
            $upicture = $_POST['picture-helper'];
        }
        else {
            $target = IMGFOLDER . $_FILES['picture']['name'];
            move_uploaded_file($_FILES['picture']['tmp_name'], $target);
            $upicture = $_FILES['picture']['name'];
        }
        if(isset($_POST['archive'])) {
            $uarchive = 1;
        }
        else {
            $uarchive = 0;
        }
        $query = "UPDATE news SET title=?, about=?, content=?, picture=?,category=?, archive=? WHERE id=?";
        $stmt=mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'sssssii', $_POST['title'], $_POST['about'], $_POST['content'], $upicture, $_POST['category'], $uarchive, $_POST['id']);
            mysqli_stmt_execute($stmt) or die('Error querying databese.');
        }
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM news WHERE id=?";
        $stmt=mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt) or die('Error querying databese.');
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $id, $date, $title, $about, $content, $picture, $category, $archive);
            mysqli_stmt_fetch($stmt);
        }
    }
    else {
        $query = "SELECT * FROM news LIMIT 1";
        $stmt=mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_execute($stmt) or die('Error querying databese.');
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $id, $date, $title, $about, $content, $picture, $category, $archive);
            mysqli_stmt_fetch($stmt);
        }
    }
?>