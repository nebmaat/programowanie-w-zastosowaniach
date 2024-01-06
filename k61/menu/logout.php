<?php
# ZAMYKAMY SESJĘ I NISZCZYMY WSZYSTKIE ZMIENNE SESYJNE
session_start();
session_unset();
session_destroy();

# PRZEKIEROWANIE DO STRONY GŁÓWNEJ
header('Location: ../index.php');
exit();
?>
