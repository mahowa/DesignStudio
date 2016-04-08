<?php
/**
 * Created by PhpStorm.
 * User: mahowa
 * Date: 4/5/2016
 * Time: 11:33 PM
 */


session_start();

$server_name  = 'localhost';
$db_user_name = 'root'; //howa
$db_password  = 'root';
//$db_password  = '013645325';
$db_name      = 'dh_svg';
try {

    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

//Get by session id
if(isset($_REQUEST['get'])) {
    try {

//        $DBH = $this->db;
//        $query = "select id as RoleId
//                  from student
//                  where UserId=$id";
//        $stmt = $DBH->prepare($query);
//        $stmt->execute();
//        $row = $stmt->fetch();
        $DBH = $db;
        $stmt = $DBH->prepare("select svg from svg where sessionid='". session_id()."'");
        $stmt->execute();
        $result = $stmt->fetchAll();



        $array = array();
        foreach($result as $r) {
           echo $r["svg"];
        }
//
//        echo json_encode($array);
    } catch (PDOException $e) {
        reportDBError($e);
    }
}

//insert
else {
    if (isset($_REQUEST["svg"])) {
        $DBH = $db;
        $stmt = $DBH->prepare("insert into svg (sessionId,svg,created) values(?,?,?)");
        $stmt->bindValue(1, session_id());
        $stmt->bindValue(2, $_REQUEST["svg"]);
        $stmt->bindValue(3, getdate());
        $stmt->execute();
    }
}

?>