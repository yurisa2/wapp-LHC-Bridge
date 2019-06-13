
<?php
$output = shell_exec('php71 ../lhc_web/cron.php -s site_admin -c cron/workflow');
echo "<pre>$output</pre>";
?>
