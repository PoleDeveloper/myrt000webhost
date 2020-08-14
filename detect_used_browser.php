<?php
include "config/config.php";
function current_url(){
    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $valid_url = str_replace("&", "&amp", $url);

    header("Location: ".$valid_url);
}
function base_dub_cookie($conn, $used_browser, $used_browser_version){
    setcookie("browser", $used_browser, time() + (86400*30), "/")or die("Gagal");
    setcookie("version", $used_browser_version, time() + (86400*30), "/")or die("Gagal");
    savebrowseractivity($conn, $used_browser, $used_browser_version);
}
function savebrowseractivity($conn, $used_browser, $used_browser_version){
    if(empty($_COOKIE['brwco']) AND !empty($_SESSION['email']) && $_SESSION['setcookie'] == "yes"){
        current_url();
    }
    if(!empty($_COOKIE['email'])){
        $email = $_COOKIE['email'];
        $keylenght = 20;
        $str = "1234567890avcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str2 = date("YmdHis");
        $randstrz = substr(str_shuffle($str), 0, $keylenght);
        $randstr = $randstrz.$str2;
        setcookie("brwco", $randstr, time() + (86400*30), "/")or die("Gagal");
        if(!empty($_COOKIE['email']) && !empty($used_browser) && !empty($used_browser_version) && empty($_COOKIE['brwco'])){
            mysqli_query($conn, "INSERT INTO used_browser(email,browser,version,security_code) VALUES('$email','$used_browser','$used_browser_version','$randstr') ")or die(mysqli_error($conn));
            setcookie("brwco", $randstr, time() + (86400*30), "/")or die("Gagal");
        }else if(!empty($_COOKIE['email']) && !empty($used_browser) && !empty($used_browser_version) && !empty($_COOKIE['brwco'])){
            $security_code = $_COOKIE['brwco'];
            $date = date('Y-m-d H:i:s');
            $get = mysqli_query($conn, "SELECT * FROM used_browser WHERE email='$email' AND security_code='$security_code' AND browser='$used_browser' ")or die(mysqli_error($conn));
            $get_count = mysqli_num_rows($get);
            if($get_count == 0){
                setcookie("email", "", time() - 3600, "/")or die("Gagal");
                setcookie("wc", "", time() - 3600, "/")or die("Gagal");
                setcookie("brwco", "", time() - 3600, "/")or die("Gagal");
                setcookie("browser", "", time() - 3600, "/")or die("Gagal");
                setcookie("version", "", time() - 3600, "/")or die("Gagal");
                if(!isset($_SESSION)){
                    session_start();
                }
                $_SESSION = array("myrt4session");
                session_destroy();
                current_url();
            }else{
                mysqli_query($conn, "UPDATE used_browser SET security_code='$randstr', create_date='$date' WHERE email='$email' AND browser='$used_browser' AND security_code='$security_code' ")or die(mysqli_error($conn));
                setcookie("brwco", $randstr, time() + (86400*30), "/")or die("Gagal");
            }
        }else if(empty($_COOKIE['browser']) || empty($_COOKIE['brwco'])){
            setcookie("email", "", time() - 3600, "/")or die("Gagal");
            setcookie("wc", "", time() - 3600, "/")or die("Gagal");
            setcookie("brwco", "", time() - 3600, "/")or die("Gagal");
            setcookie("browser", "", time() - 3600, "/")or die("Gagal");
            setcookie("version", "", time() - 3600, "/")or die("Gagal");
            current_url();
        }
    }else{

    }
}

if(isset($_GET['browser'])){
    $used_browser = $_GET['browser'];
    $used_browser_version = $_GET['version'];
    setcookie("browser", $used_browser, time() + (86400*30), "/")or die("Gagal");
    setcookie("version", $used_browser_version, time() + (86400*30), "/")or die("Gagal");
    savebrowseractivity($conn, $used_browser, $used_browser_version);
}else{
    $used_browser = "";
    $used_browser_version = "";
    $used_browser2 = "";
    $used_browser_version2 = "";

    $server = $_SERVER['HTTP_USER_AGENT'];
    $strexplode = explode(" ", $server);
    $countstr = 0;
    $countstr2 = 0;
    $countstr3 = 0;
    foreach($strexplode as $a){
        $strexplode2 = explode("/", $a);
        foreach($strexplode2 as $b){
            $countstr = $countstr+1;
        }
    }
    $countstrfin1 = $countstr-2;
    $countstrfin2 = $countstr-1;
    $countstrfin3 = $countstr-4;
    $countstrfin4 = $countstr-3;
    foreach($strexplode as $c){
        $strexplode2 = explode("/", $c);
        foreach($strexplode2 as $d){
            if($countstr2 == $countstrfin1){
                $used_browser = $d;
            }
            if($countstr2 == $countstrfin2){
                $used_browser_version = $d;
            }
        $countstr2 = $countstr2+1;
        }
    }
    if($used_browser == "Safari"){
        foreach($strexplode as $e){
            $strexplode2 = explode("/", $e);
            foreach($strexplode2 as $f){
                if($countstr3 == $countstrfin3){
                    $used_browser2 = $f;
                }
                if($countstr3 == $countstrfin4){
                    $used_browser_version2 = $f;
                }
                $countstr3 = $countstr3+1;
            }
        }
    }  

    $used_device = get_device();
    $used_os = get_os();
    $user_used_host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $used_user_host_name = get_user_agent();

    if(!empty($_COOKIE['email'])){
        $apois = 0;
        if(!empty($_COOKIE['email']) && !empty($_COOKIE['brwco'])){
            $sesionemail = $_COOKIE['email'];
            $brwco = $_COOKIE['brwco'];
            $browser = $_COOKIE['browser'];
            $get = mysqli_query($conn, "SELECT * FROM used_browser WHERE email='$sesionemail' AND security_code='$brwco' AND browser='$browser' ")or die(mysqli_error($conn));
            $count_get = mysqli_num_rows($get);
            if($count_get == 1){
                if(!isset($_SESSION)){
                    session_start();
                }
                if(empty($_SESSION['setcookie']) && !empty($_COOKIE['email'])){
                    $_SESSION['setcookie'] = "yes";
                }
                $_SESSION['myrt4session'] = true;
                $_SESSION['email'] = $_COOKIE['email'];
                $apois = 1;
            }else{
                /* to logout */
                setcookie("email", "", time() - 3600, "/")or die("Gagal");
                /* Unset all of the session variables */
                $_SESSION = array("myrt4session");
                /* Destroy the session. */
                session_destroy();
                $apois = 1;
            }

            if($apois == 1){
                $get = mysqli_query($conn, "SELECT * FROM used_browser WHERE email='$sesionemail' AND security_code='$brwco' AND browser='$browser' ")or die(mysqli_error($conn));
                $get_count = mysqli_num_rows($get);
                if($get_count == 0){
                    setcookie("email", "", time() - 3600, "/")or die("Gagal");
                    setcookie("wc", "", time() - 3600, "/")or die("Gagal");
                    setcookie("brwco", "", time() - 3600, "/")or die("Gagal");
                    setcookie("browser", "", time() - 3600, "/")or die("Gagal");
                    setcookie("version", "", time() - 3600, "/")or die("Gagal");
                    $_SESSION = array("myrt4session");
                    session_destroy();
                    current_url();
                }else{
                    if($used_browser == "Safari" AND $used_browser2 == "Chrome"){
                        $used_browser = $used_browser2."/".$used_device."/".$used_os."/".$user_used_host_name;
                        $used_browser_version = $used_browser_version2;
                        base_dub_cookie($conn, $used_browser, $used_browser_version);
                    }else{
                        $used_browser = $used_browser."/".$used_device."/".$used_os."/".$user_used_host_name;
                        base_dub_cookie($conn, $used_browser, $used_browser_version);
                    }
                }
            }else{
                if($used_browser == "Safari" AND $used_browser2 == "Chrome"){
                    $used_browser = $used_browser2."/".$used_device."/".$used_os."/".$user_used_host_name;
                    $used_browser_version = $used_browser_version2;
                    base_dub_cookie($conn, $used_browser, $used_browser_version);
                }else{
                    $used_browser = $used_browser."/".$used_device."/".$used_os."/".$user_used_host_name;
                    base_dub_cookie($conn, $used_browser, $used_browser_version);
                }
            }
        }
        if(empty($_COOKIE['browser']) OR empty($_COOKIE['brwco'])){
            if($used_browser == "Safari" AND $used_browser2 == "Chrome"){
                $used_browser = $used_browser2."/".$used_device."/".$used_os."/".$user_used_host_name;
                $used_browser_version = $used_browser_version2;
                base_dub_cookie($conn, $used_browser, $used_browser_version);
            }else{
                $used_browser = $used_browser."/".$used_device."/".$used_os."/".$user_used_host_name;
                base_dub_cookie($conn, $used_browser, $used_browser_version);
            }
        }
    }

}

if(isset($_GET['uaction'])){
    $action = $_GET['uaction'];
    if($action == "group"){
        header("Location: group/");
    }
}
function get_user_agent() {
    return  $_SERVER['HTTP_USER_AGENT'];
}
function get_os() {

    $user_agent = get_user_agent();
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
        '/windows nt 10/i'     	=>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }   
    return $os_platform;
}
function  get_device(){

    $tablet_browser = 0;
    $mobile_browser = 0;

    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $tablet_browser++;
    }

    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
    }

    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
    }

    $mobile_ua = strtolower(substr(get_user_agent(), 0, 4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda ','xda-');

    if (in_array($mobile_ua,$mobile_agents)) {
        $mobile_browser++;
    }

    if (strpos(strtolower(get_user_agent()),'opera mini') > 0) {
        $mobile_browser++;
            //Check for tablets on opera mini alternative headers
        $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
            $tablet_browser++;
        }
    }

    if ($tablet_browser > 0) {
           // do something for tablet devices
        return 'Tablet';
    }
    else if ($mobile_browser > 0) {
           // do something for mobile devices
        return 'Mobile';
    }
    else {
           // do something for everything else
        return 'Computer';
    }   
}
?>