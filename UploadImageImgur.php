<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>UPLOAD IMAGE | StudyIT VIET NAM</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="/favicon.jpg">
   </head>
   <body>
      <!-- Start Formoid form-->
      <form method="POST" action="" enctype="multipart/form-data">
      	<h3>UPLOAD IMAGE</h3>
      	<hr>
               <input type="file" name="fileToUpload"/>
         <input type="submit" value="Submit" name="submit"/>
         <?php 
	         if (isset($_POST['submit'])){
				$FileGet = basename($_FILES["fileToUpload"]["name"]);
				$File_Extension = strtolower(pathinfo($FileGet,PATHINFO_EXTENSION));
				if($File_Extension != "jpg" && $File_Extension != "png" && $File_Extension != "jpeg" && $File_Extension != "gif" ) {
					echo "<hr>File không hỗ trợ!";
				}
				else
				{
					if($_FILES["fileToUpload"]["size"] <= 2000000){
						$img = upload($_FILES["fileToUpload"]["tmp_name"]);
						echo "<hr><p>".$img."</p>[IMG]".$img."[/IMG]<hr><img src='".$img."'>";
					}else echo "<hr>File dung lượng quá lớn. (file <= 2mb)";
				}
			}
         ?>
          <hr><center>Code by Sokoda Haraki</center>
      </form>
   </body>
<style>
h3{
	text-align: center;
	margin-top: 20px;
}
form{
	border: 3px solid gray;
	max-width: 750px;
	padding: 20px;
	margin-right: auto;
	margin-left: auto;
	left: 0; right: 0; top:10px;
	position: absolute;
	border-radius: 10px;
}
img{width: 80%;}
input[type="submit"]{
	float: right;
	border: none;
	text-decoration: none;
	display: inline-table;
	color: #fff;
	padding: 10px 20px;
	background-color: gray;
	border-radius: 10px;
	transition: all ease-in-out 250ms;
}
input[type="submit"]:hover{
	background-color: #aaa;
}
input[type="submit"]:active{
	background-color: #000;
}
input[type="file"]{
	border: none;
	text-decoration: none;
	display: inline-table;
	padding: 10px 20px;
	border-radius: 10px;
	border: 2px solid gray;
}
</style>
</html>
<?php
function upload($img)
{
$client_id = ''; // Nhập client_id của bạn
$file = file_get_contents($img);
$url = 'https://api.imgur.com/3/image.json';
$headers = array("Authorization: Client-ID $client_id");
$pvars  = array('image' => base64_encode($file));
$curl = curl_init();
curl_setopt_array($curl, array(
   CURLOPT_URL=> $url,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_POST => 1,
   CURLOPT_RETURNTRANSFER => 1,
   CURLOPT_HTTPHEADER => $headers,
   CURLOPT_POSTFIELDS => $pvars
));
$json_returned = curl_exec($curl); // blank response
$img = json_decode($json_returned,true);
return $img['data']['link'];
curl_close ($curl); 
}
?>