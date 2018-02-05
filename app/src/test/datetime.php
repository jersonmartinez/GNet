<?php
$publishDate = DateTime::createFromFormat('m/d/Y', '1/10/2014');
echo $publishDate->getTimestamp();
?>