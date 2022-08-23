<html>

<head>
    <title>CommentsPDO2</title>
    <h1 style=margin-left:100px> Comments</h1>
</head>

<body>

<?php

session_start();

include('commentList.php');
if ($_SESSION['result'] == 'A new comment has been added.') {
    echo '<span style=color:green;margin-left:100px>' . $_SESSION['result'] . '</span></br>';
} else {
    echo '<span style=color:red;margin-left:100px>' . $_SESSION['result'] . '</span></br>';
}

session_destroy();

?>

</br>
<form style=margin-left:100px method="post" action="/addComment.php" id="form1">
    <label for="author">Author</label></br>
    <input type="varchar" name="author" id="author"> </br>

    <label for="comment">Comment</label></br>
    <input type="text" name="comment" id="comment"> </br>

    <button type="submit" style=margin-top:10px>Accept</button>
</form>
</body>

</html>