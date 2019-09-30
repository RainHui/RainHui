<?php
//echo '****************client*****************<br/>';
//设置 IP 和 端口 
header("Content-Type: text/html;charset=utf-8");
$port = 6000;
$ip = '115.29.240.46';
date_default_timezone_set("Asia/Shanghai");//设置时区
//-----------------------------------------------------------------
$in = 'ep=YSPHXGFGU96BZUJJ&pw=123456';
$in1 = 'Hello,Huiiiii';
//超时设计
set_time_limit(0);

//创建UDP协议的socket资源
$socket  = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP) or die('socket_create 失败：'.socket_strerror($socket));

if(socket_bind($socket,$ip,$port) === false){
	echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
}

if (socket_listen($socket, 5) === false) {
    echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
}
if ( ! socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1)) 
{ 
    echo socket_strerror(socket_last_error($socket)); 
    exit; 
}
//echo '创建成功<br/>';
$restult = socket_connect($socket, $ip, $port);
//echo '连接成功<br/>';

//-------------------------------------------------------

//-----------------------发送注册包------------------------
if(socket_write($socket, $in, strlen($in))) {
    echo '发送成功，发送信息为'.$in.'<br/>';
	$out = socket_read($socket, 1024);
} else {
    echo '发送失败，原因为'.$socket_strerror($socket).'<br/>';
}
//------------------发送“Hello,Huiiiii”-------------------
if(socket_write($socket, $in1, strlen($in1))) {
    echo '发送成功，发送信息为'.$in1.'<br/>';
//	$out = socket_read($socket, 1024);
} else {
    echo '发送失败，原因为'.$socket_strerror($socket).'<br/>';
}
$out;
if($out = socket_read($socket, 1024)) {
	echo "接收服务器回传信息成功！\n";
    echo "接受的内容为:",$out;
//	 if($out=='[iotxx:ok]'){
//		 return;	
//	 }
 }
//echo("<p>Done Reading from Socket</p>");
//echo $out;
//echo 'socket关闭<br/>';
//socket_close($socket);
//echo '关闭完成<br/>';
?>
