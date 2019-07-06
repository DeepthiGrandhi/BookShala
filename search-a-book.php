<?php

include 'php/needs/sess.php';
include 'php/needs/db.php';
include 'php/includes/header.php';

$search = "";
$book_name = "";
$author = "";
$subject = "";

if(isset($_GET['search_by']) && isset($_GET['q'])){
		$search_by = $_GET['search_by'];
		$search = $_GET['q'];
		if($search_by == "book_name"){
			$book_name = "selected";
			$author = "";
			$subject = "";
		}elseif ($search_by == "author") {
			$book_name = "";
			$author = "selected";
			$subject = "";
		}else{
			$book_name = "";
			$author = "";
			$subject = "selected";
		}
		$q = $db->query("SELECT * FROM my_books WHERE ". $search_by . " LIKE '". $search ."' ORDER BY id DESC");
		
	}

?>
<div class="container">
	<br>
	<h1>Search a Book</h1>
	<hr>
	<form method="post" class="form-inline my-2 my-lg-0">
		<div class="form-group" style="width: 200px;">
			<label for="search_by">Search by</label>
			<select name="search_by" id="search_by" class="form-control">
				<option value="book_name" <?php echo $book_name; ?>>Book Name</option>
				<option value="author" <?php echo $author; ?>>Author</option>
				<option value="subject"<?php echo $subject; ?>>Subject</option>
			</select>
		</div>
		<div class="form-group" style="width: 80%">
			<input type="text" name="search" class="form-control mr-sm-2" placeholder="Enter your Keywords and click 'Search'" style="width: 300px" value="<?php echo $search; ?>">
			<input type="submit" name="submit" value="Search" class="btn btn-secondary my-2 my-sm-0"><!-- 
			<input class="form-control mr-sm-2" type="text" placeholder="Search">
      		<input class="btn btn-secondary my-2 my-sm-0" type="submit"> -->
		</div>
	</form>

	<?php

	if (isset($_POST['submit'])) {
		$search_by = $_POST['search_by'];
		$search = $_POST['search'];
		// if($search_by == "book_name")
		header("Location:search-a-book.php?search_by=".$search_by."&q=".$search);
	}
?>

<div class="results" style="width: 300px;">

	<?php
	if(isset($q)){

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
}
	?>
	
</div>
</div>
</body>
</html>