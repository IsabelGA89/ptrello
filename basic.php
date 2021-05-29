<?php
/*DB url   mysql://b0a56ad1436acf:64c5235e@us-cdbr-east-03.cleardb.com/heroku_4edea3226fe2494?reconnect=true*/

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));


$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$arr_info = $conn->query("select * from users;");
foreach($arr_info as $row){
    var_dump($row);
}
