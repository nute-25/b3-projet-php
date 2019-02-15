<?php
/**
 * Created by PhpStorm.
 * User: osboxes
 * Date: 2/15/19
 * Time: 5:49 AM
 */
session_start();
?>
<html>
    <body>
        <h1>YOU'RE WELCOME <?php echo $_SESSION['login']?></h1>
    </body>
</html>
