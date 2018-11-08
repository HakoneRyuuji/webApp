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