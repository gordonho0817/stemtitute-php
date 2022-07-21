 <?php 

 	// $serverName = "stemtitute-testing.database.windows.net"; // update me
  //   $connectionOptions = array(
  //   "Database" => "stemtitute-testing", // update me
  //   "Uid" => "Stemtituteadmin", // update me
  //   "PWD" => "Stemtitute123" // update me
  //   );
 	//$con = mysqli_connect('localhost','root','root','unityaccess');
     $con = mysqli_connect('testingforstemtitute.mysql.database.azure.com','stemtituteadmin','Password!','unityaccess');


//check that connection happend
 if(mysqli_connect_errno())
 {
 	echo "1: Connection Failed";//error code #1 = connection failed
 	exit();
 }

 $username = $_POST["name"];
 $newscore = $_POST["score"];

 //check if name exists
 $namecheckquery = "SELECT username FROM players WHERE username='" . $username . "';";

 $namecheck = mysqli_query($con,$namecheckquery) or die("2: Name check query failed"); //error code #2 =name check query failed

 if(mysqli_num_rows($namecheck) != 1)
 {
 	echo "5: Either no user with name, or more than one"; //error code #3 - name exist cannot register
 	exit();
 }

 $updateuserquery = "UPDATE players SET score=".$newscore." WHERE username='".$username."';";
 mysqli_query($con, $updateuserquery) or die("4: Update player query failed"); //error code #4 -inser query failed

 echo "0";
?>