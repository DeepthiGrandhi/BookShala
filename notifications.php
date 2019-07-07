<?php
include 'php/needs/db.php';
include 'php/needs/sess.php';
include 'php/includes/header.php';
?>
<div class="container">
	<h1>Notifications</h1>
	<?php
	$q = $db->query("SELECT * FROM notifications WHERE to_user = '". $_SESSION['user']['id'] ."' ORDER BY id DESC");
	if (mysqli_num_rows($q) > 0) {
		while ($row = $q->fetch_assoc()) {
			$user_q = $db->query("SELECT * FROM users WHERE id = '". $row['from_user'] ."'");
			$user_info = $user_q->fetch_assoc();
			$book_q = $db->query("SELECT * FROM my_books WHERE id = '". $row['book_id'] ."'");
			$book_info = $book_q->fetch_assoc();
			if($row['status'] == "requested"){

			?>
				<div class="card">
				  <div class="card-body">
				    <h4 class="card-title"><?php echo $user_info['name']; ?></h4>
				    <h6 class="card-subtitle mb-2 text-muted"><?php echo $user_info['time']; ?></h6>
				    <p class="card-text"><?php echo $user_info['name']; ?> has requested you a book</p>
				    <h3>Book Info: </h3>
				    <div class="card mb-3" style="max-width: 300px;">
				<h3 class="card-header"><?php echo $book_info['book_name']; ?></h3>

				<img style="height: 200px; width: 100%; display: block;" src="<?php echo $book_info['cover'] ?>">
				<div class="card-body">
					<p class="card-text">Book Description Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Author: </strong><?php echo $book_info['author']; ?></li>
					<li class="list-group-item"><strong>Subject: </strong><?php echo $book_info['subject']; ?></li>
				</ul>
			
				<div class="card-footer text-muted">
					<?php echo $row['time'] ?>
				</div>
			</div>
			    <a href="php/action.php?action=accept&from_id=<?php echo $row['from_user']; ?>&book_id=<?php echo $book_info['id']; ?>" class="card-link">Accept</a>
			    <a href="php/action.php?action=decline&from_id=<?php echo $row['from_user']; ?>&book_id=<?php echo $book_info['id']; ?>"" class="card-link">Decline</a>
			  </div>
			</div>
			<?php
			}else{
				?>
				<div class="card">
					<div class="card-body">
					    <h4 class="card-title"><?php echo $user_info['name']; ?></h4>
					    <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['time']; ?></h6>
					    <p class="card-text"><?php echo $row['notif']; ?> has requested you a book</p>
					</div>
				</div>
				<?php
			}
		}	
	}else{
		?>
		<div class="alert alert-dismissible alert-primary">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Oh snap!</strong> <a href="#" class="alert-link">No Notifications to show.
		</div>
		<?php
	}

	?>
</div>
</body>
</html>