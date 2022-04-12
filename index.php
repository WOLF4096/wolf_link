<?php
$time0 = microtime(true);
$time1 = microtime(true);
$timec = (int)(($time1 - $time0)*1000000);
echo "<!--开始计时：$timec μs-->";

$xian = 200;                //每日创建上限
$beia = "浙ICP备wolf4096号";//网站备案号
$addr = "127.0.0.1";        //数据库地址
$user = "te1_0l6_cc";       //数据库用户名
$pass = "ptwLiJLMxp7c4jbr"; //数据库密码
$name = "te1_0l6_cc";       //数据库名
$conn = new mysqli($addr, $user, $pass, $name);

//初始化数据库
$sql = "SELECT * FROM `wolflink` WHERE `ID` = 746515005";
if ($conn->query($sql)){
    $sql = "";
}else{
    $sql = "CREATE TABLE `wolflink` (`ID` int(8) NOT NULL,`SJ` datetime NOT NULL,`IP` varchar(16) NOT NULL,`CL` text NOT NULL,`DL` varchar(4) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    if ($conn->query($sql)){
        $sql = "ALTER TABLE `wolflink`ADD PRIMARY KEY (`ID`);";$conn->query($sql);
        $sql = "ALTER TABLE `wolflink`MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";$conn->query($sql);
        $sql = "INSERT INTO `wolflink` VALUES(1, '2022-04-12 20:48:02', '127.0.0.1', 'https://github.com/WOLF4096', '1');";$conn->query($sql);
        $time1 = microtime(true);
        $timec = (int)(($time1 - $time0)*1000000);
        echo "<script>window.alert('初始化完成，耗时：$timec μs');</script>";
    }else{
        echo "<script>window.alert('初始化失败,请检查数据库参数是否正确');</script>";
    }
}

$ZT = ($_GET["e"]);$ZT = (String)$ZT;$ZT = str_replace('`','',$ZT);$ZT = str_replace("'",'',$ZT);
$CL = ($_GET["c"]);$CL = (String)$CL;$CL = str_replace('`','',$CL);$CL = str_replace("'",'',$CL);
$DL = $_SERVER["QUERY_STRING"];$DL=(String)substr($DL, 0, 2);
$SJ = date('Y-m-d H:i:s',time());
$IP = $_SERVER['REMOTE_ADDR'];
$HT = $_SERVER['HTTP_HOST'];
echo '
<!-- 狼介（WOLF4096）    Email: wolf4096@foxmail.com    QQ: 2275203821
 _       __   ____     __     ______   __ __   ____    ____    _____
| |     / /  / __ \   / /    / ____/  / // /  / __ \  / __ \  / ___/
| | /| / /  / / / /  / /    / /_     / // /_ / / / / / /_/ / / __ \ 
| |/ |/ /  / /_/ /  / /___ / __/    /__  __// /_/ /  \__, / / /_/ / 
|__/|__/   \____/  /_____//_/         /_/   \____/  /____/  \____/  

https://github.com/WOLF4096    All Platform ID: WOLF4096
如有修改建议、添加功能、修复Bug等问题，请与本狼联系（不吃人）
此站点为初代版本，做了些小修改，最新版本请前往 https://github.com/WOLF4096/wolf4096-short_link
-->
<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta name="keywords" content="狼链,短网址,短链接,狼介,WOLF4096,WOLF,兽,Furry,福瑞,rua,兽人,兽人控" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>狼链</title>
        <link rel="shortcut icon" href="favicon.ico"/>
        <style>
            @charset "utf-8";* {padding:0;margin:0;outline:none;-webkit-tap-highlight-color:transparent;}
            html,body {width:100%;height:100%;position:relative;overflow:hidden;background:#fff;}
            form,input,button {padding:0;margin:0;border:none;outline:none;background:none;}
            a {text-decoration:none;color:#999;}
            .con {width:100%;transition:1s all;margin:auto;min-width:320px;height:380px;position:absolute;left:0;top:-100px;right:0;bottom:0;}
            .con .sou {max-width:680px;position:relative;width:calc(100% - 60px);min-width:320px;margin:0 auto;}
            .con .sou form {width:100%;height:50px;display:block;margin:10px auto 30px;position:relative;}
            .con .sou form .wd {width:100%;height:100%;display:block;border:1px solid #ddd;border-radius:8px;line-height:100%;font-size:18px;transition:0.3s all;}
            .con .sou form .lg {display:block;height:20px;position:absolute;right:20px;top:14px;border-radius:10%;overflow:hidden;cursor:pointer;font-size:16px;color:#000;}
            .con .sou form .wd:focus {background:#fff;box-shadow:0 0px 15px 0 rgba(32,33,36,0.2);border-color:#fff}
            .con .sou form button {width:40px;height:40px;display:block;position:absolute;z-index:10;right:6px;top:6px;cursor:pointer;font-size:22px;line-height:40px;border-radius:50%;color:#777;}
            .foot {position:absolute;bottom:10px;text-align:center;width:100%;color:#999;height:20px;line-height:20px;font-size:12px;}
        </style>
    </head>
    <body>
        <div id="content">
            <div class="con">
                <div class="sou">
                <a href="http://'.$HT.'/"><font color="#7092BE"><h1 align="center">狼链</h1></font></a>
';
if ($DL == ""){
    echo '                <br/>
                <form action="" method="get" target="_self">
                    <textarea class="wd" type="text" name="c" lang="zh-CN" autocomplete="off" maxlength="4096" placeholder="输入长链或文本"
                    style="width: 100%;height: 100px;font-family: inherit;font-size: 17px;padding: 14px;margin: -14px;line-height: 24px;"></textarea><br/>
                    <div style="text-align: center;"><input type="submit" value="生成狼链" style="font-size: 20px;"></div>
                </form>';
}elseif ($CL<>""){
    $sql = "SELECT COUNT(*) AS SJ24 FROM wolflink WHERE SJ >=(NOW() - INTERVAL 86400 SECOND) AND IP = '$IP'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $CS = $row["SJ24"];
    if($CS <= $xian){
        $sql = "SELECT * FROM wolflink WHERE CL='$CL'";
        $row = mysqli_fetch_array($conn->query($sql));
        $curl = $row["CL"];
        $durl = $row["DL"];
        if($curl == ""){
            $sql = "SELECT COUNT(*) AS lf FROM wolflink";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $dec = $row["lf"] + 1;
            $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $result = '';
            do {
                $result = $dict[$dec % 62] . $result;
                $dec = intval($dec / 62);
            } while ($dec != 0);
            $DL = $result;
            $sql = "INSERT INTO `wolflink` VALUES (NULL, '$SJ', '$IP', '$CL', '$DL')";
            if ($conn->query($sql)){
                $eurl = "http://".$HT."/?".$DL."&e=e";
                Header("Location:$eurl");
            }
        }else{
            $eurl = "http://".$HT."/?".$durl."&e=e";
            Header("Location:$eurl");
        }
    }else{
        echo '              
                <br/><h3 align="center">每位用户每天只能使用'.$xian.'次<br/>请明天再来</h3>
                <br/><h4 align="center"><a href="http://'.$HT.'/"><font color="#7092BE">返回主页</font></a></h4>';
    }
}elseif ($DL<>"" and $DL<>"c=" and $ZT<>"e"){
    $DL = str_replace('&','',$DL);
    $sql = 'SELECT * FROM `wolflink` WHERE binary DL="'.$DL.'"';
    $row = mysqli_fetch_array($conn->query($sql));
    $URL = $row["CL"];
    if ($URL == ""){
        echo '              
                <br/><h3 align="center">无结果</h3>
                <br/><h4 align="center"><a href="http://'.$HT.'/"><font color="#7092BE">返回主页</font></a></h4>';        
    }elseif (substr($URL, 0, 4)<>"http"){
        $qurl = 'http://'.$HT.'/?'.$DL;
        echo '              
                <br/><h3>当前短链（'.$qurl.'）的文本如下:</h3><br/>
                <textarea class="wd" style="width: 100%;height: 320px;font-family: inherit;font-size: 17px;padding: 10px;margin: -10px;">'.$URL.'</textarea><br/><br/>
                <h4 align="center"><a href="'.$qurl.'&e=e"><font color="#7092BE">返回上级</font></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://'.$HT.'/"><font color="#7092BE">返回主页</font></a></h4>';        
    }elseif (!Header("Location:$URL")){
        $qurl = 'http://'.$HT.'/?'.$DL;
        echo '              
                <br/><h3>跳转链接错误，当前短链（'.$qurl.'）的文本如下:</h3><br/>
                <textarea class="wd" style="width: 100%;height: 320px;font-family: inherit;font-size: 17px;padding: 10px;margin: -10px;">'.$URL.'</textarea><br/><br/>
                <h4 align="center"><a href="'.$qurl.'&e=e"><font color="#7092BE">返回上级</font></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://'.$HT.'/"><font color="#7092BE">返回主页</font></a></h4>';
    }else{
        Header("Location:$URL");
    }
}elseif ($DL<>"" and $DL<>"c=" and $ZT=="e"){
    $DL = str_replace('&','',$DL);
    $sql = 'SELECT * FROM `wolflink` WHERE binary DL="'.$DL.'"';
    $row = mysqli_fetch_array($conn->query($sql));
    $URL = $row["CL"];
    if(substr($URL, 0, 4)<>"http"){
        $wb = "&nbsp;&nbsp;&nbsp;文本";
        $tz = "_self";
    }else{
        $wb = "&nbsp;&nbsp;&nbsp;长链";
        $tz = "_blank";
    }
    $wurl = "http://".$HT."/?".$DL;
    echo '                <br/>
                <form>
                    <a href="'.$wurl.'" target="'.$tz.'"><p class="lg">打开狼链</p></a>
                    <input class="wd" type="text" autocomplete="off" readonly="readonly" value="&nbsp;&nbsp;&nbsp;短链：'.$wurl.'"><br/>
                    <input class="wd" type="text" autocomplete="off" readonly="readonly" value="'.$wb.'：'.$URL.'">
                </form>
                <br/><br/><br/><div style="text-align: center;"><img style="width: 128px;height: 128px;" src="https://api.isoyu.com/qr/?m=1&e=L&p=10&url='.$wurl.'" ></div>
                <h3 align="center">短链二维码</h3>';
}else{
    echo '              
                <br/><h3 align="center">未输入文本</h3>
                <br/><a href="http://'.$HT.'/"><font color="#7092BE"><h4 align="center">返回主页</h4></font></a>';    
}
$conn->close();
echo '
                </div>
            </div>
            <div class="foot" style="height:20px;">Copyright © 2022. <a href="https://blog.wolf4096.top/" target="_blank">狼介(WOLF4096). </a><a href="https://beian.miit.gov.cn/" target="_blank">'.$beia.'</a></div>
        </div>
    </body>
</html>
';
$time1 = microtime(true);
$timec = (int)(($time1 - $time0)*1000000);
echo "<!--结束计时：$timec μs-->\n";
?>
