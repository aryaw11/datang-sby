<?php
$date = date('dmY');
$no_datang = "REGS/D/3578/29052018/0002";
$no_datang = explode("/", $no_datang);
$maxno_datang = str_pad((int) $no_datang[4] + 1, 4, '0', STR_PAD_LEFT);
echo "REGS/D/3578/$date/$maxno_datang";

?>