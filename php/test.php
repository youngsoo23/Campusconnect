<?php
$filename = 'upload_file.php';
if(is_writable($filename)){
	echo 'Writable';
} else {
	echo 'Not writeable';
}
?>
