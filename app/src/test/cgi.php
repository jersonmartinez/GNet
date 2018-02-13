
<?php
$sapi_type = php_sapi_name();
if (substr($sapi_type, 0, 3) == 'cgi') {
    echo "Está usando PHP CGI\n";
} else {
    echo "No está usando PHP CGI\n";
}
?>