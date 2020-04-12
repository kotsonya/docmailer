<?php
session_start();
$lang_array = parse_ini_file("../language_ini/" . $_SESSION["lang"] . ".ini");
include_once '../dm_functions.php';

$user_id =$_POST['user_id'];
$conn = connect_db();
$namefile = $lang_array['gmail_filter_xml_file'];
$content = "<?xml version='1.0' encoding='UTF-8'?>
<feed xmlns='http://www.w3.org/2005/Atom' xmlns:apps='http://schemas.google.com/apps/2006'>";

$sql_categories = "SELECT category FROM categories WHERE user_id=" . $user_id . " ORDER BY category ";
$result_categories_list = $conn->query($sql_categories);

while ($row = mysqli_fetch_array($result_categories_list)) {
    $content = $content . "
                <entry>
		<category term='filter'></category>
		<title>Mail Filter</title>
		<content></content>
		<apps:property name='subject' value='" . $row["category"] . "'/>
		<apps:property name='label' value='" . $row["category"] . "'/>
		<apps:property name='shouldArchive' value='true'/>
		<apps:property name='sizeOperator' value='s_sl'/>
		<apps:property name='sizeUnit' value='s_smb'/>
                </entry>
                ";
}
$content = $content."</feed>";
printf($content);

?>


