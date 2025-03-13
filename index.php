<?php
//membuat metode redirect dengan kode 301

header("location: public/index.php", true, 301);
//membuat kode di bawah header tidak diproses oleh website sehingga lebih aman

exit();
?>