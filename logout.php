<?php 
error_reporting(0);
session_start();
clearstatcache();
session_destroy();
?>
<script type="text/javascript">
	alert('Anda berhasil logout!');
	window.location.href = 'index.php';
</script>