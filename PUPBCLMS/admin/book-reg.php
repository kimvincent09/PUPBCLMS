<?php
require_once 'header.php';
echo <<<_END
<script>
function checkUser(user)
{
if (user.value == '')
{
O('info').innerHTML = ''
return
}
params = "user=" + user.value
request = new ajaxRequest()
request.open("POST", "checkbook.php", true)
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
$error = $ISBN = $Title =  $Author =  $Pub = "";
if (isset($_SESSION['ISBN'])) destroySession();
if (isset($_POST['ISBN']))
{
$ISBN = sanitizeString($_POST['ISBN']);
$Title = sanitizeString($_POST['Title']);
$Author = sanitizeString($_POST['Author']);
$Pub = sanitizeString($_POST['Pub']);
if ($ISBN == "" || $Title == ""|| $Author == "" || $Pub == "")
$error = "Not all fields were entered<br><br>";
else
{
$result = queryMysql("SELECT * FROM books WHERE ISBN='$ISBN'");
if ($result->num_rows)
$error = "That ISBN already exists<br><br>";
else
{
queryMysql("INSERT INTO books VALUES('$ISBN', '$Title', '$Author', '$Pub')");
die("<h4>Book Registered</h4><br><br>");
}
}
}
echo <<<_END
<style>
a{
    text-decoration: none;
    color: white;
}
</style>
<button class="button"><a href = "http://127.0.0.1/Software_Engineering/admin/ui.html">Back</a></button>
<div class="form2">
    <div class = "row2">
        <img src = "1200px-Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png" class="img-container">
      <h1>PUPBC Library Management System</h1>
      <h3>Book Registration</h3>
        <div class = "col">
            <center>
            <table>
                <tbody> 
<form method='post' action='book-reg.php'>$error
    <tr>
    <td class="maroon">
<label class = ''>ISBN:</label></td>
<td>
<input type='text' maxlength='40' name='ISBN' class='user' value='$ISBN'
onBlur='checkUser(this)'></td></tr><br><br>
<tr><td class="maroon">
<label class="">Title:</label></td>
<td>
<input type='text' maxlength='40' name='Title' class = 'pass'
value='$Title'></td></tr>
<tr><td class="maroon">
<label class="">Author:</label></td>
<td>
<input type='text' maxlength='40' name='Author' class = 'pass'
value='$Author'></td></tr>
<tr><td class="maroon">
<label class="">Publisher:</label></td>
<td>
<input type='text' maxlength='40' name='Pub' class = 'pass'
value='$Pub'></div></span></td></tr></tbody></table>


<input type='submit' value='Register' class = 'button login'>
</form></div></div></div>
</center>
</body>
</html>
_END;
?>