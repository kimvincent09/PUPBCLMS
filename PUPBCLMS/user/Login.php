<?php
require_once 'header.php';
echo "<div class='main'>";
$error = $user = $pass = "";
if (isset($_POST['user']))
{
$user = sanitizeString($_POST['user']);
$pass = sanitizeString($_POST['pass']);
if ($user == "" || $pass == "")
$error = "Not all fields were entered<br>";
else
{
$result = queryMySQL("SELECT user,pass FROM members
WHERE user='$user' AND pass='$pass'");
if ($result->num_rows == 0)
{
$error = "<span class='error'>Username/Password
invalid</span><br><br>";
}
else
{
$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;
die("You are now logged in. Please <a href='http://127.0.0.1/Software_Engineering/admin/ui.html'>" .
"click here</a> to continue.<br><br>");
}
}
}

echo <<<_END

<body bgcolor="maroon">
    
<div class="form">
    <div class = "row">
        <img src = "1200px-Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png" class="img-container">
      
        <h1>Admin Login</h1>
        <div class = "col">
    <form method='post' action='login.php'>$error
        <table><tbody></table><tr><td>
    <label>Username:</label></td><td>
    <input type='text' maxlength='16' name='user' class='user space' value='$user'><br><br>
    </td></tr>
    <tr><td>
    <label>Password:</label></td><td>
    <input type='password' maxlength='16' name='pass' class = 'pass space'
    value='$pass'></td></tr></tbody></table></div></span>
    
    
    <input type='submit' value='Login' class = 'button login'>
    </form></div></div></div>
    </body>
    </html>
    
</body>
</html>

_END;
?>
