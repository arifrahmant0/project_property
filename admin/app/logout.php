<?php
session_start();
session_destroy(); // Menghancurkan semua session
header("Location:../../../../../amartagroups/admin/index.php"); // Redirect ke halaman login
exit();
