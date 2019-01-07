 <?php

$servername = "192.241.244.177";
$username = "root";
$password = "tecnics";


$conn = new mysqli($servername, $username, $password, "db_BP_Dmart", 3306);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
$userName = $_GET["userName"];

$sqlQuery = "select UserName from Users where UserName = '".$userName."'";

$result = $conn->query($sqlQuery);

if ($result->num_rows > 0) {
	echo("\nWelcome ".$userName."!\n");

	$msgQuery = "select Message, Sender from Messages where Receiver = '".$userName."' and Flag = 1";
    $result = $conn->query($msgQuery);
    while($row = $result->fetch_assoc()) {

        echo "Message: " . $row["Message"]."\n";
        echo "From: ".$row["Sender"]."\n";
    }
    $msgUpdateQuery = "update Messages set Flag = 0 where Receiver = '".$userName."'";
    $result =  $conn->query($msgUpdateQuery);

} 
else 
{
    echo "Please create an Account to chat!";
}
$conn->close();
?> 