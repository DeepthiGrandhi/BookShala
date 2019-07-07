<?php

include 'needs/db.php';
include 'needs/sess.php';

if (isset($_GET['to_user']) && isset($_GET['book_id'])) {
	$to_user = $_GET['to_user'];
	$book_id = $_GET['book_id'];
	$now_search = (isset($_GET['now_search']))? $_GET['now_search'] : "";
	$now_search_by = (isset($_GET['now_search_by']))? $_GET['now_search_by'] : "";
	$from_user = $_SESSION['user']['id'];
	$notif = $_SESSION['user']['name'] . " has requested a book.";
	$db->query("INSERT INTO requests (to_user, from_user, book_id) VALUES ('$to_user','$from_user', '$book_id')") or die(mysqli_error($db));
	$db->query("INSERT INTO notifications (to_user, from_user,book_id, notif, status) VALUES('$to_user','$from_user','$book_id', '$notif', 'requested')") or die(mysqli_error($db));
	echo $book_id;
	header("Location: ../search-a-book.php?search_by=".$now_search_by."&q=".$now_search);
}