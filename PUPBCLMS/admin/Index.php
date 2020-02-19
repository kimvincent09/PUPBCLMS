<?php
require_once 'header.php';
echo "
<style>
.column {
    float: left;
    width: 33.33%;
    padding: 20px 0px 0px 0px;
    margin-left: 140px
  
  
  }
.column2 {
    float: left;
    width: 33.33%;
    padding: 20px 0px 0px 0px;
  }
  .column:hover, .column2:hover{
cursor:pointer;
}

  
  /* Clear floats after image containers */
  .row {
    content: '';
    clear: both;
    display: table;
    width: 100%
  }
  </style>
  
<center><img src = '1200px-Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png' class='img-container'>
<br><h1>Welcome to $appname!<h1></center>
<div class='row'>
<center>
<div class='column'>
<a href = 'http://127.0.0.1/Software_Engineering/admin/login.php'>
  <img src='IMGBIN_computer-icons-login-user-system-administrator-png_m41CwRMM.png' alt='Snow' style='width:40%; border= 'black'></a>
<h3>Admin Login</h3>
</div>
<div class='column2'>
<a href = 'http://127.0.0.1/Software_Engineering/User/log.php'>
  <img src='IMGBIN_textbook-library-reading-png_xHPVR75L.png' alt='Forest' style='width:40%'></a>
  <h3>Library Manager</h3></div></center>
</div>
</div>";

if ($loggedin) echo " $user, you are logged in.";

?>
</span><br><br>
</body>
</html>