<?php
include 'php/needs/db.php';
include 'php/needs/sess.php';
include 'php/includes/header.php';
if (isset($_GET['u'])) {
	$u_id = $_GET['u'];
	$q = $db->query("SELECT name FROM users WHERE id = '". $u_id ."'");
	$user_info = $q->fetch_assoc();
?>
<div class="container">
	<h1 class="title">More Books from <?php echo $user_info['name']; ?></h1>
	<div class="books-list" style="width: 300px;">
<?php

	$q = $db->query("SELECT * FROM my_books WHERE owned_by = '". $u_id ."' ORDER BY id DESC") or die(mysqli_error($db));
	if (mysqli_num_rows($q) > 0) {
		while ($row = $q->fetch_assoc()) {
			?>
			<hr>
			<br>
			<div class="card mb-3">
				<h3 class="card-header"><?php echo $row['book_name']; ?></h3>

				<img style="height: 200px; width: 100%; display: block;" src="<?php echo $row['cover'] ?>">
				<div class="card-body">
					<p class="card-text">Book Description Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Author: </strong><?php echo $row['author']; ?></li>
					<li class="list-group-item"><strong>Subject: </strong><?php echo $row['subject']; ?></li>
				</ul>
				<div class="card-body">
					<ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="#" class="card-link">More books From same Owner</a></li>
					<li class="list-group-item"><a href="#" class="card-link">Request this Book</a></li>
				</ul>
				</div>
				<div class="card-footer text-muted">
					<?php echo $row['time'] ?>
				</div>
			</div>
			<?php
		}
	}else{
		?>
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Oops!</strong>There are no books to show<a href="#" class="alert-link"></a>.
		</div>
		<?php
	}

}else{
	header("Location: index.php");
}

?>
</div>

</div>
</body>
</html>