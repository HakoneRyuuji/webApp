<!DOCTYPE html>
    
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/profile.css" />
    <link rel="stylesheet" href="upload.php">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".msearch").click(function(){
                $(".nav .content li, .msearch, .menu_img, #pimage, .pdrop").hide();
                $(".minput, .cancel").show();
                $(".minput, .cancel").css("float","left");
            });
            $(".menu_img").click(function(){
                $(".msearch, .menu_img, #pimage, .pdrop").hide();
                $(".nav .content li, .menu_cancel").show();
                $(".menu_cancel").css("float","right");
            });
            $(".cancel").click(function(){
                $(".menu_img, .msearch, #pimage, .pdrop").show();
                $(".minput, .cancel").hide();
            });
            $(".menu_cancel").click(function(){
                $(".nav .content li, .menu_cancel").hide();
                $(".msearch, .menu_img, #pimage, .pdrop").show();
            });
            $(window).resize(function(){
                if ($(window).width() > 700){
                    $(".nav .content li").show();
                }
                if ($(window).width() <= 700){
                    $(".nav .content li").hide();
                }
            });
        });
    </script>
    <style>
        .img{
            object-fit:cover;
            object-position:center;
            width:200px;
            height:200px;}

    </style>
</head>
<body>
    <div class="nav">
        <ul class="content">
            <li><a class="clink" style="color: rgb(255, 255, 255)" href="#">SaveAS</a></li>
            <li><a class="clink active" href="#">You</a></li>
            <li><a class="clink" href="#">Explore</a></li>
            <li><a class="clink" href="#">Create</a></li>
            <img class="menu_img" src="css/img/menu_icon.png" alt="menu">
            <div class="pdrop">
                <img id="pimage" src="css/img/profile.jpg" alt="profile big">
                
                <div class="log_out">
                    <a href="you.php">Profile</a>
                    <a href="#">Setting</a>
                    <a href="image_manage.html">home</a>
                    <a href="index.html">Log Out</a>
                </div>
            </div>
            <input class="cinput" type="text" name="search" autocomplete="off" placeholder="Search Galery..">
            <img class="msearch" src="css/img/search_icon.png" alt="search">
            <img class="menu_cancel" src="css/img/cancel_icon.png" alt="cancel">
        </ul>
        <img class="cancel" src="css/img/cancel_icon.png" alt="cancel">
        <input class = "minput" type="text" name="msearch" autocomplete="off" placeholder="Search Galery..">
    </div>
    <div class = "banner">
    
        <div style="width: 100%; height: 200px;"></div>
        <div class="main_banner">
            <table>
                <tr>
                    <td rowspan="2"><img id="mpimage" src="css/img/profile.jpg" alt="profile image"></td>
                    <td colspan="2" class="name1">Real Name</td>
                </tr>
                <tr>
                    <td class="name2">user name</td>
                    <td class="name2">0 followers - 0 following</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="nav2">
        <ul class="content">
            <li><a class="clink" href="#">About</a></li>
            <li><a class="clink active" href="#">Photostream</a></li>
            <li><a class="clink" href="#">Albums</a></li>
            <li><a class="clink" href="#">Faves</a></li>
            <li><a class="clink" href="#">Galleries</a></li>
            <li><a class="clink" href="#">Groups</a></li>
        </ul>
    </div>
    <div class="page">
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
                $con= mysqli_connect("localhost","root","","datausers");
                $sql="insert into imagess(name_image,image) values('$name','$image')";
                $query= mysqli_query($con,$sql);
                // if($query){
                // 	echo "successed";
                // }else {
                // 	echo "not upload";
                // }
            }
            display();
            function display(){
                $con= mysqli_connect("localhost","root","","datausers");
                $sql="select*from imagess";
                $query= mysqli_query($con,$sql);
                $num= mysqli_num_rows($query);
                for($i=0;$i< $num; $i++){
                    $rerults= mysqli_fetch_array($query);
                    $img=$rerults['image'];
                    echo '<img class="img" src="data:image;base64,'.$img.'">';
                }
            }
    ?>
    
        <!-- <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge">
        <img src="css/img/profile.jpg" alt="iamge"> -->
    </div>
    <div class="footer">
        <ul class="fcontent">
            <li><a class="clink" href="about.html">About</a></li>
            <li><a class="clink" href="job">Job</a></li>
            <li><a class="clink" href="Blog">Blog</a></li>
            <li><a class="clink" href="Developers">Developers</a></li>
            <li><a class="clink" href="Guidelines">Guidelines</a></li>
            <li><a class="clink" href="Privacy">Privacy</a></li>
            <li><a class="clink" href="Terms">Terms</a> </li>
            <li><a class="clink" href="Help">Help</a></li>
            <li> <a class="clink" href="forum">Forum</a></li>
            <li><a class="clink" href="English">English</a></li>
        </ul>
    </div>
    
</body>
</html>