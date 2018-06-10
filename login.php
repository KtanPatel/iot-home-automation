<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM user WHERE uname = '$myusername' and pass = '$mypassword'";
	//echo $sql; 
$result = mysqli_query($db,$sql);
//      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//	$active = $row['active'];

      $count = mysqli_num_rows($result);
//	print_r($result);
//	echo $count;
  
    // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
//         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
//	echo "<script type='text/javascript'> alert('');  </script>";
//	   echo $count;
         header('location: index.php');
      }else {
//	echo $myusername + "" + $mypassword;
//	print_r($result);
         $error = "Your User Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
	    <meta name="viewport" content="width=100%, initial-scale=1">
      <title>Login to System</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
	    color:#fffdfc;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#111213">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login to System</b></div>
				
            <div style = "margin:30px">
               
               <form action = "login.php" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Login "/><br />
               </form>

               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

         </div>
		<h4><a target="_blank" href="https://www.twitter.com/ktan_patel">@Ketan Patel</a></h4>
      </div>

   </body>
</html>
