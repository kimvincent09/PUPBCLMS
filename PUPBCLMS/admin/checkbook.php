<?php
require_once 'functions.php';
if (isset($_POST['ISBN']))
{
$ISBN = sanitizeString($_POST['ISBN']);
$result = queryMysql("SELECT * FROM books WHERE ISBN='$ISBN'");
if ($result->num_rows)
echo "<span class='taken'>&nbsp;&#x2718; " .
"This username is taken</span>";
else
echo "<span class='available'>&nbsp;&#x2714; " .
"This username is available</span>";
}
?>