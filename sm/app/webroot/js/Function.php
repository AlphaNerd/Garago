<?php
$table_name = $_POST["table_name"];

$query = "SELECT * FROM ".$table_name;
$result = go_mysql($query);

$userinfo = array();
while ($row_user = mysql_fetch_assoc($result))
    $userinfo[] = $row_user;


echo json_encode($userinfo);



function go_mysql($query)
{
    global $mysql_link; 
    
    if (!$mysql_link)
    {
        $mysql_link = mysql_connect("localhost","root","") or die(mysql_error());
        mysql_select_db("blur_data") or die(mysql_error());
        mysql_query("SET NAMES 'utf8'");
        mysql_query("set character_set_client='utf8'");
        mysql_query("set character_set_results='utf8'");
        mysql_query("set collation_connection='utf8'");
        global $mysql_link;
    }
        
    $result=mysql_query($query);
    if ($result)
    {
        return $result;
    }
    else
    {
        echo "Database Error: " . mysql_error()."<br><b>$query</b>";
        die();
    }
}