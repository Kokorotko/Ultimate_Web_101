<?php
session_start();
if (isset($_POST))
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();    
}
else echo "HOW DID YOU GET HERE";
?>