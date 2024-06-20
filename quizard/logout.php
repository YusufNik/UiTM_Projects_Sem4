<?php
 session_start();
 session_destroy();
 echo "<script>alert('Logout Succesfull!'); window.location= 'homeScreen.php'</script>";
?>