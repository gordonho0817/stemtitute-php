 <?php 

// $host = 'testingforstemtitute.mysql.database.azure.com';
// $username = 'stemtituteadmin';
// $password = 'Password!';
// $db_name = 'unityaccess';
// $SSL='/Users/gordon/Downloads/DigiCertGlobalRootCA.crt.pem';

// //Establishes the connection
//  try {
//         $dbh = new PDO('mysql:host='. $host .';dbname='. $db_name, $username, $password,$SSL);
//     } catch(PDOException $e) {
//         echo 'Failed to connect to MySQL: '.mysqli_connect_error();
//     }

    $con = mysqli_connect('testingforstemtitute.mysql.database.azure.com','stemtituteadmin','Password!','unityaccess');

    if (mysqli_connect_errno($con)) {
die('Failed to connect to MySQL:'.mysqli_connect_error());
}

// $conn = mysqli_init();
// mysqli_ssl_set($conn,NULL,NULL, "/Users/gordon/Downloads/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
// mysqli_real_connect($conn, 'testingforstemtitute.mysql.database.azure.com', 'stemtituteadmin', 'Password!', 'unityaccess', 3306, MYSQLI_CLIENT_SSL);
// if (mysqli_connect_errno($conn)) {
// die('Failed to connect to MySQL: '.mysqli_connect_error());
// }

 //echo "fuck"."   ".$_POST;
 //echo $_POST["name"]."  LOL  ".$_POST["password"];
 //exit();

 $username = $_POST["name"];
 $password = $_POST["password"];


 //check if name exists
 $namecheckquery = "SELECT * FROM players WHERE username='" . $username . "';";

 $namecheck = mysqli_query($con,$namecheckquery) or die("2:\tName check query failed"); //error code #2 =name check query failed

 if(mysqli_num_rows($namecheck)>0)
 {
    echo "3:\tName already exists  "."username: ".$username."  Password: ".$password; //error code #3 - name exist cannot register
    exit();
 }

//add user to the table
 $salt = "\$5\$rounds=5000\$". "steamedhams". $username."\$";
 $hash = crypt($password,$salt);
 $insertuserquery = "INSERT INTO players (username,hash,salt) VALUES('" . $username .  "', '" .$hash."','" .$salt. "');";
 mysqli_query($con, $insertuserquery) or die("4: Insert player query failed"); //error code #4 -inser query failed

 echo "0\tsuccess";
?>














