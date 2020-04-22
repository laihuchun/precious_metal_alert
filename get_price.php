<?php
$status=1;
system("/bin/bash /data/scripts/get_precious_metals_price.sh",$status);
echo $status;
var_dump($status);
?>
