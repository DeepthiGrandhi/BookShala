<?php

include 'php/needs/sess.php';
include 'php/needs/db.php';
include 'php/includes/header.php';

?>
<?php

if (isset($_POST['submit'])) {
	$my_id = $_SESSION['user']['id'];
	$target_dir = "covers/";
	$target_file = $target_dir . basename($_FILES["cover"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$book_name = $_POST['bookName'];
	$author = $_POST['author'];
	$subject = $_POST['subject'];
	$cover_check = getimagesize($_FILES['cover']["tmp_name"]);
	if($cover_check !== false){
		if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
        	$q = $db->query("INSERT INTO my_books(book_name, author, subject, cover, owned_by) VALUES('$book_name', '$author', '$subject', '$target_file','$my_id')");
        	if(!$q){
        		echo "ERROR";
        	}else{
        		?>
        		<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
				</div>
        		<?php
        	}
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}else{
		echo "Upload an Image";
	}
}

?>
<div class="container">
	<br>
	<h1>Search a Book</h1>
	<hr>
	<form method="get">
		
	</form>
</div>
</body>
</html>