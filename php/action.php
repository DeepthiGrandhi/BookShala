<?php

include 'needs/db.php';
include 'needs/sess.php';

if ( isset( $_GET['action'] ) && isset( $_GET['from_id'] ) && isset( $_GET['book_id'] )){
	$action = $_GET['action'];
	$from_id = $_GET['from_id'];
	$book_id = $_GET['book_id'];
	$my_id = $_SESSION['user']['id'];
	$my_name = $_SESSION['user']['name'];
	$my_email = $_SESSION['user']['email'];
	$book_info = $db->query("SELECT * FROM my_books WHERE id = '". $book_id ."'")->fetch_assoc();
	$notif = $my_name . " has accepted to give you the book \"". $book_info['book_name'] ." \". you can contact the person at " . $my_email;
	if ($action = "accept") {
		$db->query("INSERT INTO accepted (from_id, to_id, book_id) VALUES('$from_id', '$my_id', '$book_id')");

		$db->query("DELETE FROM requests WHERE (from_user = '$from_id' AND  to_user = '$my_id' AND book_id = '$book_id')");


		$db->query("DELETE FROM notifications WHERE (from_user = '$from_id' AND  to_user = '$my_id' AND book_id = '$book_id')");

		$db->query("INSERT INTO notifications (from_user, to_user, book_id, notif, status) VALUES('$my_id', '$from_id', '$book_id', '$notif', 'accepted')") or die(mysqli_error($db));

		header("Location: ../notifications.php");
	}else{
		$db->query("DELETE FROM requests WHERE (from_user = '$from_id' AND  to_user = '$my_id' AND book_id = '$book_id')");

		$db->query("DELETE FROM notifications WHERE (from_user = '$from_id' AND  to_user = '$my_id' AND book_id = '$book_id')");
		header("Location: ../notifications.php");
	}
}