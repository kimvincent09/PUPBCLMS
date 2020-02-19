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
$error = $user = $pass = "";
if (isset($_SESSION['user'])) destroySession();
if (isset($_POST['user']))
{
$user = sanitizeString($_POST['user']);
$pass = sanitizeString($_POST['pass']);
if ($user == "" || $pass == "")
$error = "Not all fields were entered<br><br>";
else
{
$result = queryMysql("SELECT * FROM members WHERE user='$user'");
if ($result->num_rows)
$error = "That username already exists<br><br>";
else
{
queryMysql("INSERT INTO members VALUES('$user', '$pass')");
die("<h4>Account created</h4>Please Log in.<br><br>");
}
}
}
echo <<<_END
    <div class="form">
            <div class = "row">
                <img src = "1200px-Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png" class="img-container">
              <h1>Admin Signup</h1>
                <div class = "col">
<form method='post' action='signup.php'>$error
<label>Username:</label>
<input type='text' maxlength='16' name='user' class='user' value='$user'
onBlur='checkUser(this)'><br><br>
<label>Password:</label>
<input type='text' maxlength='16' name='pass' class = 'pass'
value='$pass'></div></span>


<input type='submit' value='Sign up' class = 'button login'>
</form></div></div></div>
</body>
</html>
_END;
?>