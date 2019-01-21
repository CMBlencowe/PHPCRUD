<?php
//Variables
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "testdatabase";

//Create Conn
$mysqli = new mysqli($host, $user, $pass, $dbname);

//Check existance of database and table
$sql = "CREATE DATABASE IF NOT EXISTS $dbname;";
$sql = "CREATE TABLE IF NOT EXISTS tblUser;";

//Test
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// createRecord('Peter3', 'Parker3', 16);
// readRecord();
// updateRecord('Peter3', 24);
// deleteRecord('Peter3');

function createRecord($name, $surname, $age) {
    global $mysqli;
    $sql = "INSERT INTO tblUser (userName, userSurname, userAge) VALUES ('$name', '$surname', $age)";
    // checkComplete($sql);
    checkResponse($mysqli, $sql, 'created');
}

function readRecord() {
    global $mysqli;
    $sql = "SELECT * FROM tblUser";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            //Headings
            while($row = mysqli_fetch_array($result)){
                echo $row['userId'] . "\t";
                echo $row['userName'] . "\t";
                echo $row['userSurname'] . "\t";
                echo $row['userAge'] ;
                echo "<br>";
                echo "</tr>";
            }
        }
    } else{
        checkResponse($mysqli, $sql, 'read');
    }
} 

function updateRecord($name, $age) {
    global $mysqli;
    $sql = "UPDATE tblUser SET userAge=$age WHERE userName = '$name'";
    checkResponse($mysqli, $sql, 'update');
} 

function deleteRecord($name) {
    global $mysqli;
    $sql = "DELETE FROM tblUser WHERE userName='$name'";
    checkResponse($mysqli, $sql, 'delete');
}

function checkResponse($a, $b, $c) {
    if($a->query($b) === true){
        echo "Records were $c successfully.";
    } else{
        echo "ERROR: Could not $c $b. " . $a->error;
    }
}
?>