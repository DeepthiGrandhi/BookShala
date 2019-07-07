<?php 
include 'php/needs/db.php'; 
include 'php/needs/sess.php';
include 'php/includes/header.php';

$my_id = $_SESSION['user']['id'];

$q = $db->query("SELECT * FROM my_books WHERE owned_by = '". $my_id ."' ORDER BY id DESC");
?>

<div class="container">
	<h1>My Books</h1>
	<div class="book-list" style="width: 300px;">
		<?php
		if (mysqli_num_rows($q)>0) {
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
			<div class="alert alert-dismissible alert-warning">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Oh snap!</strong> <a href="#" class="alert-link">Add Books</a><br> you have'nt added any books yet.
			</div>
			<?php
		}
		?>
	</div>
</div>

</body>
</html>