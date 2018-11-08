<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>TestImage</title>
	<style>
		.img{
			object-fit:cover;
			object-position:center;
			width:200px;
			height:200px;
		}
	</style>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<input type=file name="image">
		<br>
		<input type="submit" name= "submit" value="submit">
	</form>
	<?php
	if(isset($_POST['submit'])){
		if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
			echo 'failed';
		}
		else {
			$name= addslashes($_FILES['image']['tmp_name']);
			$image =base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));
			saveImage($name, $image);
		}
	}
	function saveImage($name, $image){
		$con= mysqli_connect("localhost","root","","datauser");
		$sql="insert into images(name,image) values('$name','$image')";
		$query= mysqli_query($con,$sql);
		if($query){
			echo "successed";
		}else {
			echo "not upload";
		}
	}
	display();
	function display(){
		$con= mysqli_connect("localhost","root","","datauser");
		$sql="select*from images";
		$query= mysqli_query($con,$sql);
		$num= mysqli_num_rows($query);
		for($i=0;$i< $num; $i++){
			$rerults= mysqli_fetch_array($query);
			$img=$rerults['image'];
			echo '<img class="img" src="data:image;base64,'.$img.'">';
		}

	}
	?>

	
</body>
</html>