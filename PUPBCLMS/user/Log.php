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
queryMysql("INSERT INTO student VALUES('$Number')");
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

<style>
.admin-btn{
    left: 10px;
    bottom: 10px;
    position:absolute;
}
.log-tbl{
    background-color: maroon;
    text-align: center;
}
table tr td{
    border: none;
    padding-bottom: 200px;
}
table{

    width: 100%;
}
.ads{
    color: black;
}

.row{
    padding: 0;
}
.col, .user{
    margin: 0px;
}
.stud{
    width: 35%;
}
tbody tr td{
    text-align: none;
}
.rec-tbl{
    border: solid;
    background-color:black;
    width: 60%;
    margin-left: 20%;
}
h4{
    color:white;   
}
table tbody tr td{
    padding: 0px;
}
.stud-tbl{
    width: 70%;
    padding: 0px;
}
.space{
  padding: 5px 10px 5px 0px;
}

</style>
<body bgcolor="maroon">
    <div class = "header">
       
      <h1>PUPBC Library Management System</h1>
      <h3>Student Attendance Log</h3></div>
_END;
echo '<center><h1>'. date("M d, Y 10:i a"). '</h1></center>' ;
echo <<<_END
      <table>
          <tbody>
              <tr>
                  <td class="log-tbl stud">
     </div>
    <div class = "row">
        <div class = "col">
    <form method='post' action='signup.php'>$error
    <input type='text' maxlength='40' name='Number' class = 'user space'
    value='$Sec' placeholder="Search student...">
    <input type='submit' value='Search' class = 'button login'>
    </form></div></div><br>
    <div>
        <table class = "rec-tbl">
            <tbody class="rec-tbl">
                <th>
                    <h4>Student</h4>
                </th>
                <th>
                    <h4>Section</h4>
                </th>
                <tr>
                    <td class = "stud-tbl">
                        <h5>Kim Vincent P. Alday</h5>
                    </td>
                    <td>
                        <h5>BSCPEBN5-1</h5>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</td>
    <td id="ads" class="log-tbl ">
        <img src = "1200px-Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png" class="img-container" style="width: 200px">
        <h1>SCAN YOUR ID</h1>
    </td>
</tr></tbody></table>
<a href = "http://127.0.0.1/Software_Engineering/user/login.php"><img class = "admin-btn" src="IMGBIN_textbook-library-reading-png_xHPVR75L.png" width="50px"></a>
</body>
</html>
_END;
?>