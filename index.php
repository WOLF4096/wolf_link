<!DOCTYPE html>
<html lang="zh">
    <!--
     _       __   ____     __     ______   __ __   ____    ____    _____
    | |     / /  / __ \   / /    / ____/  / // /  / __ \  / __ \  / ___/
    | | /| / /  / / / /  / /    / /_     / // /_ / / / / / /_/ / / __ \ 
    | |/ |/ /  / /_/ /  / /___ / __/    /__  __// /_/ /  \__, / / /_/ / 
    |__/|__/   \____/  /_____//_/         /_/   \____/  /____/  \____/  
    -->
  <head>
  <meta charset="UTF-8">
  <meta name="keywords" content="狼链,短网址,短链接,狼介,WOLF4096,WOLF,兽,Furry,福瑞,rua,兽人,兽人控" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>狼链 - 短网址</title>
  <link rel="shortcut icon" href="favicon.ico"/>
  <link rel="stylesheet" href="index/sy.css">
  <script type="text/javascript" src="index/bkl.js"></script>
</head>
  <body>
      <div id="content">
        <div class="con">
            <div class="sou">
<?php
error_reporting(0);
$u = $_SERVER["QUERY_STRING"];$u=(String)substr($u, 0, 2);//短链
$c = htmlspecialchars($_GET["c"]);$CL = (String)$c;//长链或文本
$e = htmlspecialchars($_GET["e"]);$e = (String)$e;//返回上级用的参数
//连接数据库参数
$servername = "";
$username = "";
$password = "";
$dbname = "";
$conn = new mysqli($servername, $username, $password, $dbname);
switch ($u)
{
case ""://参数为空，显示主页
    echo '              <a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h1 align="center">狼链 - 短网址</h1></font></a><br/>
                <form action="" method="get" target="_self">
                    <textarea class="wd" type="text" name="c" lang="zh-CN" autocomplete="off" maxlength="4096" placeholder="输入长链或文本"
                    style="width: 100%;height: 100px;font-family: inherit;font-size: 17px;padding: 14px;margin: -14px;"></textarea><br/>
                    <div style="text-align: center;"><input type="submit" value="生成狼链" style="font-size: 20px;"></div>
                </form>';//提交参数
    break;
case $c<>""://长链不为空时执行
    $sql = "SELECT COUNT(*) AS SJ24 FROM wolflink WHERE SJ >=(NOW() - INTERVAL 86400 SECOND) AND IP = '".$_SERVER['REMOTE_ADDR']."'";//查询24小时内，相同IP添加长链的数量
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $CS = $row["SJ24"];
    if($CS<=5){//如果24小时内，添加长链的数量小于等于5，则执行以下代码
        $sql = "SELECT * FROM wolflink WHERE CL='$CL'";//查询数据表中是否存在长链
        $row = mysqli_fetch_array($conn->query($sql));
        $curl = $row["CL"];//查询到的长链
        $durl = $row["DL"];//查询到的短链
        if($curl==""){//如果数据表中不存在此长链，这执行以下代码添加
            $sql = "select count(*) as lf from wolflink";//查询总记录行数
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $zs = $row["lf"];
            $dec = $zs + 1;//总记录数+1
            function from10to62($dec) {//转62进制
                $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $result = '';
                    do {
                        $result = $dict[$dec % 62] . $result;
                        $dec = intval($dec / 62);
                    } while ($dec != 0);
              return $result;
            }
            $DL = from10to62($dec);//62进制短链
            $SJ = date('Y-m-d H:i:s',time());//获取当前时间
            $IP = $_SERVER['REMOTE_ADDR'];//获取客户端IP
            $sql = "INSERT INTO `wolflink` VALUES (NULL, '$SJ', '$IP', '$CL', '$DL')";//添加至数据表
            if ($conn->query($sql) === TRUE) {//判断是否添加成功
                $eurl = "http://".$_SERVER['HTTP_HOST']."/?".$DL."&e=e";//组合参数
                Header("Location:$eurl");//跳转页面
            }
        }else{//如果数据表中存在此长链，这执行以下代码
            $eurl = "http://".$_SERVER['HTTP_HOST']."/?".$durl."&e=e";//组合参数
            Header("Location:$eurl");//跳转页面
        }
    }else{//如果24小时内，添加长链的数量超过5个，则执行以下代码
        echo '              <a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h1 align="center">狼链 - 短网址</h1></font></a>
              <br/><h3 align="center">每位用户每天只能使用5次<br/>请明天再来</h3>
              <br/><h4 align="center"><a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE">返回主页</font></a></h4>';
    }
    break;
case $u<>"" and $u<>"c=" and $e<>"e"://跳转短链接
    $u = str_replace('&','',$u);//去除$u中的&字符
    $sql = 'SELECT * FROM `wolflink` WHERE binary DL="'.$u.'"';//查询长链
    $row = mysqli_fetch_array($conn->query($sql));
    $URL = $row["CL"];//查询到的长链
    switch ($URL)
    {
    case ""://如果不存在长链，则输出无结果
        echo '              <a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h1 align="center">狼链 - 短网址</h1></font></a>
              <br/><h3 align="center">无结果</h3>
              <br/><h4 align="center"><a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE">返回主页</font></a></h4>';
        break;
    case substr($URL, 0, 4)<>"http"://如果不是链接，则输出文本
        $qurl = 'http://'.$_SERVER['HTTP_HOST'].'/?'.$u;
        echo '              <a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h1 align="center">狼链 - 短网址</h1></font></a>
              <br/><h3>当前短链（'.$qurl.'）的文本如下:</h3><br/>
              <textarea class="wd" style="width: 100%;height: 320px;font-family: inherit;font-size: 17px;padding: 10px;margin: -10px;">'.$URL.'</textarea><br/><br/>
              <h4 align="center"><a href="'.$qurl.'&e=e"><font color="#7092BE">返回上级</font></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE">返回主页</font></a></h4>';
        break;
    case !Header("Location:$URL")://跳转链接失败，则输出错误链接
        $qurl = 'http://'.$_SERVER['HTTP_HOST'].'/?'.$u;
        echo '              <a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h1 align="center">狼链 - 短网址</h1></font></a>
              <br/><h3>跳转链接错误，当前短链（'.$qurl.'）的文本如下:</h3><br/>
              <textarea class="wd" style="width: 100%;height: 320px;font-family: inherit;font-size: 17px;padding: 10px;margin: -10px;">'.$URL.'</textarea><br/><br/>
              <h4 align="center"><a href="'.$qurl.'&e=e"><font color="#7092BE">返回上级</font></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE">返回主页</font></a></h4>';
        break;
    default://都不是就跳转链接
        Header("Location:$URL");
    }
    break;
case $u<>"" and $u<>"c=" and $e=="e"://显示中间页面
    $u = str_replace('&','',$u);//去除$u中的&字符
    $sql = 'SELECT * FROM `wolflink` WHERE binary DL="'.$u.'"';//查询长链
    $row = mysqli_fetch_array($conn->query($sql));
    $URL = $row["CL"];//查询到的长链
    if(substr($URL, 0, 4)<>"http"){//判断是文本还是链接
        $wb = "&nbsp;&nbsp;&nbsp;文本";
        $tz = "_self";
    }else{
        $wb = "&nbsp;&nbsp;&nbsp;长链";
        $tz = "_blank";
    }
    $wurl = "http://".$_SERVER['HTTP_HOST']."/?".$u;//组合短链
echo '              <a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h1 align="center">狼链 - 短网址</h1></font></a><br/>
                <form>
                    <a href="'.$wurl.'" target="'.$tz.'"><p class="lg">打开狼链</p></a>
                    <input class="wd" type="text" autocomplete="off" readonly="readonly" value="&nbsp;&nbsp;&nbsp;短链：'.$wurl.'"><br/>
                    <input class="wd" type="text" autocomplete="off" readonly="readonly" value="'.$wb.'：'.$URL.'">
                </form>
                <br/><br/><br/><div style="text-align: center;"><img style="width: 128px;height: 128px;" src="https://api.isoyu.com/qr/?m=1&e=L&p=10&url='.$wurl.'" ></div>
                <h3 align="center">短链二维码</h3>';//显示二维码
    break;
default://未输入文本
    echo '              <a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h1 align="center">狼链 - 短网址</h1></font></a>
              <br/><h3 align="center">未输入文本</h3>
              <br/><a href="http://'.$_SERVER['HTTP_HOST'].'/"><font color="#7092BE"><h4 align="center">返回主页</h4></font></a>';
}
$conn->close();//关闭数据库连接
?>

            </div>
        </div><div class="foot" style="height:20px;">Copyright © 2017 - 2022. <a href="https://wolf.furry.vin/" target="_blank"> 狼介(WOLF4096). </a> All Rights Reserved.</div>
     </div>
  </body>
</html>