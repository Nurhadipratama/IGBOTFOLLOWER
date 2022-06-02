<?php
error_reporting(0);
system("xdg-open https://youtube.com/channel/UC54QxRrmSaXr4cZ4pKmZG4Q");

// W A R N A
$h = "\33[32;1m";
$b = "\33[0;36m";
$m = "\33[31;1m";
$p = "\e[1;37m";
$dark="\033[1;30m";
$k = "\33[1;33m";
$c = "\e[1;36m";
$u = "\e[1;35m";
$abu = "\e[1;30m";
$end = "\033[0m";
$bmerah = "\033[101m";
$bputih = "\033[107m";
 
function autosave($data){
$open = fopen("config.json","w+");
$js_dump = json_encode($data,JSON_PRETTY_PRINT);
fwrite($open,$js_dump);
fclose($open); }

// B A N N E R
function banner(){
global $m,$c,$p,$k;
system("clear");
animasi($m."\n ╔╗╔{$p}┌─┐┌─┐{$m}╔═╗\n");
animasi($m." ║║║{$p}│  └─┐{$m}║╣ \n");
animasi($m." ╝╚╝{$p}└─┘└─┘{$m}╚═╝ {$k}v0.10\n");
animasi($p."  |{$c}≽ {$p}Author: {$p}hadibot\n");
animasi($p."  |{$c}≽ {$p}Thanks: {$p} BODYSWEMING\n\n"); }

function animasi($str){ $arr = str_split($str); 
 foreach ($arr as $az){ echo $az; 
 usleep(5000); }} function memuat(){ 
 $p = "\e[1;37m"; $c = "\e[1;36m"; $m = "\33[31;1m";
 echo$m." » {$p}Loading    \r"; usleep(150000); echo$m." » {$p}Loading.  \r"; usleep(150000); echo$m." » {$p}Loading.. \r"; usleep(150000); echo$m." » {$p}Loading... \r"; usleep(150000);  echo$m." » {$p}Loading    \r"; usleep(150000); echo$m." » {$p}Loading.  \r"; usleep(150000); echo$m." » {$p}Loading.. \r"; usleep(150000); echo$m." » {$p}Loading... \r"; usleep(150000); 
 echo$m." » {$p}Loading    \r"; usleep(150000); echo$m." » {$p}Loading.  \r"; usleep(150000); echo$m." » {$p}Loading.. \r"; usleep(150000); echo$m." » {$p}Loading... \r"; usleep(150000);  echo$m." » {$p}Loading    \r"; usleep(150000); echo$m." » {$p}Loading.  \r"; usleep(150000); echo$m." » {$p}Loading.. \r"; usleep(150000); echo$m." » {$p}Loading... \r"; usleep(150000); }


if(file_exists("config.json")){
$your_ig = json_decode(file_get_contents("config.json"))->username;
$username = json_decode(file_get_contents("config.json"))->username_tumbal;
$pswd = json_decode(file_get_contents("config.json"))->pswd;
}else{
banner();
animasi($k." masukan data yang di perlukan, di bawah ini!\n");
$your_ig = readline($p." username: ");
$username = readline($p." username (tumbal): ");
$pswd = readline($p." password (tumbal): ");
$data = ["username_tumbal"=>$username,"pswd"=>$pswd,"username"=>$your_ig];
autosave($data); memuat();}


function curl($url,$httpheader=0,$post=0){ 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    if($httpheader){
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    }
    if($post){
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch);
    if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
    $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    curl_close($ch);
    return array($header, $body)[1];} }

function headers(){
 $ua[]="Host: app.ncse.info";
 $ua[]="x-requested-with: XMLHttpRequest";
 $ua[]="user-agent: Mozilla/5.0 (Linux; Android 10; dandelion Build/QP1A.190711.020;) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/91.0.4472.101 Mobile Safari/537.36";
 $ua[]="referer: https://app.ncse.info/";
return $ua; }

function ambil_token(){
 $url="https://app.ncse.info/login";
return curl($url,headers()); }

function masuk(){
global $username,$pswd,$token;
 $url="https://app.ncse.info/login?";
 $data="username=$username&password=$pswd&userid=&antiForgeryToken=$token"; 
 return curl($url,headers(),$data); }

function find_fl(){
global $your_ig;
 $url="https://app.ncse.info/tools/send-follower?formType=findUserID";
 $data="username=$your_ig";
 return curl($url,headers(),$data); }

function send_fl($id,$your_ig){
 $url="https://app.ncse.info/tools/send-follower/".$id."?formType=send";
 $data="adet=15&userID=$id&userName=$your_ig";
 return curl($url,headers(),$data); }
 
 banner();
 ulang:
 system("rm cookie.txt");
 $ambil_tk = ambil_token();
 $token = explode('"',explode('&antiForgeryToken=',$ambil_tk)[1])[0];
 $masuk = masuk();
 $status = json_decode($masuk)->status;
 
 if($status=="success"){
 $find_fl = find_fl();
 $id = explode('"',explode('<input type="hidden" name="userID" value="',$find_fl)[1])[0];
 
 $fl = send_fl($id,$your_ig);
 $status = json_decode($fl)->status;
  if($status=="success"){
  animasi($k." messages: {$h}success {$p}mengirim followers ke {$c}@{$your_ig}\n");
   for($x=1200;$x>0;$x--){echo "\r \r";
   echo$m." » {$p}pleas wait ".$k.$x." ";
   echo "\r \r"; sleep(1);} goto ulang;
  }
  else{
  animasi($k." messages: {$m}failed, {$p}terkena limit harap tunggu\n");
   for($x=1200;$x>0;$x--){echo "\r \r";
   echo$m." » {$p}pleas wait ".$k.$x." ";
   echo "\r \r"; sleep(1);} goto ulang;
  }
 }
 else{
 animasi($k." messages: {$p}akun {$m}tidak tersambung\n");
 exit;
 }