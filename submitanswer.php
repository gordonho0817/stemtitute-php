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
  $answer = $_POST["answer"];
  $question_no = $_POST["questionno"];

//check if name exists
 $idcheckquery = "SELECT ID FROM players WHERE username='" . $username . "';";

 $idcheck = mysqli_query($con,$idcheckquery) or die("2: ID check query failed"); //error code #2 =name check query failed

 if(mysqli_num_rows($idcheck)==1)
 {
 	$existinginfo = mysqli_fetch_assoc($idcheck);
 	$userID = $existinginfo["ID"];
 	$questionscheckquery = "SELECT questions,answer FROM questions WHERE QID='".$question_no."'";
 	$questionscheck = mysqli_query($con,$questionscheckquery) or die("2: ID check query failed");
 	$existinginfo = mysqli_fetch_assoc($questionscheck);
  $answeryetquery="SELECT AID FROM answer_record WHERE QID='".$question_no."' AND  Correctness='1' AND UID='".$userID."'";
  $answeryetcheck=mysqli_query($con,$answeryetquery) or die("2: Answeryet check query failed");
  if(mysqli_num_rows($answeryetcheck)==0){
  if($answer==$existinginfo["answer"]){
$insertanswerquery="INSERT INTO answer_record(UID,QID,ans,Correctness) VALUES('".$userID."','".$question_no."','".$answer."','1');";
  mysqli_query($con, $insertanswerquery) or die("20: Insert player query failed"); //error code #4 -inser query failed
  echo "0\ttrue";
  exit();
  }
  else{
$insertanswerquery="INSERT INTO answer_record(UID,QID,ans,Correctness) VALUES('".$userID."','".$question_no."','".$answer."','0');";
  mysqli_query($con, $insertanswerquery) or die("21: Insert player query failed"); //error code #4 -inser query failed
  echo "0\tfalse";
  exit();
  }
 	}else{
    echo"0\tanswer already. Please press next question";
  }
 }

 else{
 	echo "10: Connection failed";
 	exit();
}

?>