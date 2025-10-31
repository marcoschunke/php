<?php
session_start();
session_unset();   // limpa as variáveis de sessão
session_destroy(); // encerra a sessão
header("Location: index.php"); // volta para login
exit;
