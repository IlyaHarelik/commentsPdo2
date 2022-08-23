<?php

session_start();

include('DataBaseComments.php');

$author = $_POST['author'];
$comment = $_POST['comment'];

if ($_POST['author'] && $_POST['comment']) {
    $_SESSION['result'] = 'A new comment has been added.';
} else {
    $_SESSION['result'] = 'A new comment WASN\'T added.';
    exit(header('Location:/index.php'));
}

$dataArray = ['author' => $author, 'comment' => $comment];
$db = DataBaseComments::getInstance();
$id = $db->insert('allcomments', $dataArray);

$_SESSION['id'] = $id;

$numPerPage = 5;
$countComments = $db->rowsCount('allcomments');
$numLinks = ceil($countComments / $numPerPage);

header('Location:/index.php?page=' . $numLinks);