<?php
require_once 'functions.php';
if (isset($_POST['Name']))
{
$Name = sanitizeString($_POST['Name']);
$result = queryMysql("SELECT * FROM student WHERE Name='Name'");
if ($result->num_rows)
echo "<span class='taken'>&nbsp;&#x2718; " .
"This username is taken</span>";
else
echo "<span class='available'>&nbsp;&#x2714; " .
"This username is available</span>";
}
?>