<?php
require_once 'header.php';
echo <<<_END
<script>
function checkUser(Name)
{
if (Name.value == '')
{
O('info').innerHTML = ''
return
}
params = "Name=" + Name.value
request = new ajaxRequest()
request.open("POST", "checkuser.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
if (this.readyState == 4)
if (this.status == 200)
if (this.responseText != null)
O('info').innerHTML = this.responseText
}
request.send(params)
}
function ajaxRequest()
{
try { var request = new XMLHttpRequest() }
catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
catch(e3) {
request = false
} } }
return request
}
</script>
_END;
$error = $Name = $Sec = "";
if (isset($_SESSION['Name'])) destroySession();
if (isset($_POST['Name']))
{
$Name = sanitizeString($_POST['Name']);
$Sec = sanitizeString($_POST['Sec']);
$Number = sanitizeString($_POST['Number']);
if ($Name == "" || $Sec == "" || $Number == "")
$error = "Not all fields were entered<br><br>";


else
{
$result = queryMysql("SELECT * FROM student WHERE Number='$Number'");
if ($result->num_rows)
$error = "That student number already exists<br><br>";

else
{
queryMysql("INSERT INTO student VALUES('$Name', '$Sec', '$Number')");
die("<div class = 'header'>
<img src = '1200px-Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png' class='img-container'>
<h1>PUPBC Library Management System</h1>
<h3>Student Registration</h3></div>
<div class='form'>
<div class = 'row'>
<center>
<div class = 'col'>
<form method='post' action='signup.php'>$error
<label>Fullname:</label>
<input type='text' maxlength='40' name='Name' class='user' value='$Name'
onBlur='checkUser(this)'><br><br>
<label>Course/Sec:</label>
<input type='text' maxlength='16' name='Sec' class = 'pass'
value='$Sec'></span>
<br><br>
<label>Student no.:</label>
<input type='text' maxlength='16' name='Number' class = 'user'
value='$Sec'></div></center><br>


<input type='submit' value='Register' class = 'button login'>
</form></div></div></div>
</body>
</html>
_END;");
}
}
}
echo <<<_END
            
<div class = "header">
    <img src = "1200px-Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png" class="img-container">
  <h1>PUPBC Library Management System</h1>
  <h3>Student Registration</h3></div>
  <div class="form">
<div class = "row">
<center>
    <div class = "col">
<form method='post' action='signup.php'>$error
<label>Fullname:</label>
<input type='text' maxlength='40' name='Name' class='user' value='$Name'
onBlur='checkUser(this)'><br><br>
<label>Course/Sec:</label>
<input type='text' maxlength='16' name='Sec' class = 'pass'
value='$Sec'></span>
<br><br>
<label>Student no.:</label>
<input type='text' maxlength='16' name='Number' class = 'user'
value='$Sec'></div></center><br>


<input type='submit' value='Register' class = 'button login'>
</form></div></div></div>
</body>
</html>
_END;
?>