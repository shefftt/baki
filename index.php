<!DOCTYPE html>
<html>
<head>
	<title>No</title>
</head>
<body>
<?php


include 'Migration.php';
$db     = new Migration();

// "select * from ahmed" " where id = 2"
// echo $db->select("nilvalley");
// $obj = $db->select("nilvalley");
// for ($i=0; $i <10 ; $i++) { 
// 	echo $obj->tel ."---";
// }
// $mysqli =  new mysqli("" ,  "root", "" , "ahmed");
		
// 		//$query = "select * from ".$TableName;
// 		$TableName = "nilvalley";
// 		$query = "SELECT * FROM ".$TableName." ORDER BY ".$TableName."_ID ASC";
//        if ($result = $mysqli->query($query)) {
//        //	$obj = $result->fetch_object();
// 	   //$variable = $result->fetch_array();
// 	    foreach ($result->fetch_array() as  $key => $value) {
// 	    	echo $key."---". $value."<br>";
// 	    }
// 	    //echo  $obj->username;
// 	   //   while ($obj = $result->fetch_object()) {
//     //     echo $obj->username." - ". "<br>";
//     // }
// 	}
//`username`, `city`, `tel`

// if ($db->insert("nilvalley" , ['username'=>'m3awia', 'city'=>'sudna', 'tel'=>'88888'])) {
// 	echo "<br>final ";
// }
// echo "<br><br><br><br>";
// if ($db->delete("nilvalley" , "3")) {
// 	echo "تم الحزف بنجاح";
// }
//UPDATE `ahmed`.`nilvalley` SET `username` = 'tomz2', `city` = 'jazeera2', `tel` = '8882' WHERE `nilvalley`.`nilvalley_ID` = 4 
echo$db->string("nilvalley","ahemmmmmm");

?>
</body>
</html>