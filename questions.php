 <?php 
 $con = mysqli_connect('testingforstemtitute.mysql.database.azure.com','stemtituteadmin','Password!','unityaccess');

//   $con = mysqli_init();
// mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL);
// mysqli_real_connect($conn, "testingforstemtitute.mysql.database.azure.com", "stemtituteadmin", "Password!", "unityaccess", 3306, MYSQLI_CLIENT_SSL);


// //check that connection happend
//  if(mysqli_connect_errno())
//  {
//  	echo "1: Connection Failed";//error code #1 = connection failed
//  	exit();
//  }

  $username = $_POST["name"];
  $add=1;
//  $answer = $_POST["answer"];


//  //check if name exists
 $idcheckquery = "SELECT ID FROM players WHERE username='".$username."';";

 $idcheck = mysqli_query($con,$idcheckquery) or die("2: ID check query failed"); //error code #2 =name check query failed

 if(mysqli_num_rows($idcheck)==1)
 {
 	$existinginfo2 = mysqli_fetch_assoc($idcheck);
 	$userID = $existinginfo2["ID"];
    $MaxQID = "SELECT MAX(QID) FROM answer_record WHERE UID='".$userID."' AND Correctness='1'";
  $MaxQ = mysqli_query($con,$MaxQID) or die("3: cant find MAX");
  if(mysqli_num_rows($MaxQ)==0){
    $Max=0;
  }else{
    $existinginfo1=mysqli_fetch_assoc($MaxQ);
    $Max=$existinginfo1["MAX(QID)"]+$add;
  }

 	$questionscheckquery = "SELECT questions FROM questions WHERE QID='".$Max."'";
 	//echo $Max;
 	$questionscheck = mysqli_query($con,$questionscheckquery) or die("2: ID check query failed");
 	$existinginfo = mysqli_fetch_assoc($questionscheck);
 	echo "0\t" . $existinginfo["questions"] ."\t". $Max;
 }
 else{
 	echo "10: Connection failed";
 	exit();
	}
?>