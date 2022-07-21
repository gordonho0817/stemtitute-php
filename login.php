 <?php 
 $con = mysqli_connect('testingforstemtitute.mysql.database.azure.com','stemtituteadmin','Password!','unityaccess');
//check that connection happend
 if(mysqli_connect_errno())
 {
 	echo "1: Connection Failed";//error code #1 = connection failed
 	exit();
 }

 $username = $_POST["name"];
 $password = $_POST["password"];

 $namecheckquery = "SELECT username, salt, hash, score FROM players WHERE username='" . $username . "';";
 $namecheck = mysqli_query($con,$namecheckquery) or die("2: Name check query failed"); //error code #2 =name check query failed

 if(mysqli_num_rows($namecheck) != 1)
 {
    echo "5: Either no user with name, or more than one\t"."5"; //error code #5 - number of names matching !=1
    exit();
 }

 //get login info from query
 $existinginfo = mysqli_fetch_assoc($namecheck);
 $salt = $existinginfo["salt"];
 $hash = $existinginfo["hash"];

 $loginhash = crypt($password,$salt);
 if($hash != $loginhash)
 {
    echo"6: Incorrect password\t"."6";//error code #6 - password does not hash to match table
    exit();
 }
 echo "0\t" . $existinginfo["score"];
?>