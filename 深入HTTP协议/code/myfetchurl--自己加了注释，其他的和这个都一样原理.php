<?php
/**
 * 抓取京东自己的订单
 * 先登录后获取自己的cookie信息，直接复制订单页面的cookie就行
 */

$url = "http://order.jd.com/center/list.action";  //京东订单页面地址
//$cookie = "btw=3512.10068396.13; abtest=20130613111718737_93; _jzqx=1.1365557572.1399167149.20.jzqsr=item%2Ejd%2Ecom|jzqct=/161316%2Ehtml.jzqsr=item%2Ejd%2Ecom|jzqct=/107850%2Ehtml; __utmz=122270672.1399168538.32.28.utmcsr=trade.jd.com|utmccn=(referral)|utmcmd=referral|utmcct=/order/getOrderInfo.action; mt_ext=%7b%22adu%22%3a%225e1c1d17f89e7236e28b945cfdbeec93%22%7d; aview=9866.1059942022|9868.1105850888|9868.1090160434|1658.1049774694|6917.1171457031|745.136061|745.136062|750.717251; atw=9868.1105850888.6|9866.1059942022.5|1658.1049774694.4|6917.1171457031.2|745.136061.0|1049.107850.-1|750.717251.-2|5064.532521.-2; ipLocation=%u5317%u4EAC; areaId=1; ipLoc-djd=1-2800-2848-0; _pst=lgmyxbjfu; pin=lgmyxbjfu; unick=lgmyxbjfu; ceshi3.com=44CC979249BCC7C3DFA1DEDB498CAAB3784BEE1EE7C5CA9E13894271F4C5F46F85D869F505E0C5AE10BA63981400D03EEC8DBDFF2DD6E38F755C211814C14E249065602E776D1055C224BD13DA517F240123EFCC74E06BA41AABFFB8090167DA307B3FE2B46F7ADA66BA7758E5D66636D11C7A3AAB8F5D85156AB43CF6A40CC1238A493EF0772F88EEEE0DEB88FBBE0D; _tp=uEGZChtLVVgZQk9e7mt%2BdA%3D%3D; __jda=122270672.330604952.1405478885.1405478885.1405478885.1; __jdb=122270672.2.330604952|1.1405478885; __jdc=122270672; __jdv=122270672|direct|-|none|-; __jdu=330604952";
$cookie = 'btw=3512.10068396.13; abtest=20130613111718737_93; _jzqx=1.1365557572.1399167149.20.jzqsr=item%2Ejd%2Ecom|jzqct=/161316%2Ehtml.jzqsr=item%2Ejd%2Ecom|jzqct=/107850%2Ehtml; __utmz=122270672.1399168538.32.28.utmcsr=trade.jd.com|utmccn=(referral)|utmcmd=referral|utmcct=/order/getOrderInfo.action; un_ex=%7B%22adp%22%3A%22%22%2C%22unt%22%3A%222014-07-24T10%3A44%3A34%22%2C%22stid%22%3A%22A100186591%22%2C%22wuid%22%3A%2207ca9c0030fd49af9a16da4c603c99f4%22%2C%22rf%22%3A0%2C%22stp%22%3Anull%2C%22uuid%22%3A%2207ca9c0030fd49af9a16da4c603c99f4%22%2C%22euid%22%3A%22%22%2C%22unid%22%3A%224%22%7D; unionUnId=4; websiteId=A100186591; euId=""; unt="2014-07-24T10:44:34"; aview=870.1023795|870.1067808|870.1078918|870.352668|870.1063073|9901.1002620317|1505.1176628612|9866.1059942022; atw=870.1023795.13|1505.1176628612.1|9901.1002620317.0|9868.1105850888.-2|9866.1059942022.-3|1658.1049774694.-4|6917.1171457031.-6|745.136061.-8; ipLocation=%u5317%u4EAC; areaId=1; ipLoc-djd=1-72-4137-0; mt_ext=%7b%22adu%22%3a%22c6b5eeaf74491497b3fb0d3ae02e3104%22%7d; _pst=lgmyxbjfu; pin=lgmyxbjfu; unick=lgmyxbjfu; ceshi3.com=6690E40816F3D35DCDBE5778C2B19625FC5D3511C092BAF1BA8A5B648AC8F4F2031006BB4694C705DA1DEF87A7E7958D01CFE27C9966D2F1EE7A869BD9F6956B9077E80AFA3858DE46518CFC0980D247CD15FEFDFCEE56FD376D1D5F201E2FF910F5E217705D629394E11C6DE5FDD84B422C884F896C423CF4DD744DA2647570229324A066032D100A8CB46D9182D0B0; _tp=uEGZChtLVVgZQk9e7mt%2BdA%3D%3D; __jda=122270672.330604952.1405478885.1406169877.1406943608.10; __jdb=122270672.3.330604952|10.1406943608; __jdc=122270672; __jdv=122270672|click.linktech.cn|t_4_A100186591|tuiguang|07ca9c0030fd49af9a16da4c603c99f4; __jdu=330604952';
$data   = myfopen($url, 0, '', $cookie);
var_dump($data);


function myfopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = false, $ip = '', $timeout = 15, $block = true)
{
    $return  = '';
    $matches = parse_url($url);
    $host    = $matches['host'];
    @$path = $matches['path'] ? $matches['path'].'?'.$matches['query'].'#'.$matches['fragment'] : '/'; //请求行的path是path+参数
    $port = !empty($matches['port']) ? $matches['port'] : 80;

    if ($post) {
        $out = "POST $path HTTP/1.0\r\n";
        $out .= "Accept: */*\r\n";
        //$out .= "Referer: $site_url\r\n";
        $out .= "Accept-Language: zh-cn\r\n";
        $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
        $out .= "Host: $host\r\n";
        $out .= 'Content-Length: '.strlen($post)."\r\n";
        $out .= "Connection: Close\r\n";
        $out .= "Cache-Control: no-cache\r\n";
        $out .= "Cookie: $cookie\r\n\r\n";    //头信息和http体之间用1个空行分割，所以要2个\r\n
        $out .= $post;
    } else {
        $out = "GET $path HTTP/1.0\r\n";
        $out .= "Accept: */*\r\n";
        //$out .= "Referer: $site_url\r\n";
        $out .= "Accept-Language: zh-cn\r\n";
        $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
        $out .= "Host: $host\r\n";
        $out .= "Connection: Close\r\n";
        $out .= "Cookie: $cookie\r\n\r\n";  //get方法可以没有http体
    }
    $fp = fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);  //打开一个tcp通道
    if (!$fp) {
        return '';
    } else {
        stream_set_blocking($fp, $block);
        stream_set_timeout($fp, $timeout);
        fwrite($fp, $out);  //通过tcp通道向服务器发送头信息
        $status = stream_get_meta_data($fp);
        if (!$status['timed_out']) {
            $firstline = true;
            while (!feof($fp)) {
                $header = @fgets($fp); //取出状态行，判断是否是200成功。
                if ($firstline && (false === strstr($header, '200'))) {
                    return '';
                }
                $firstline = false;
                if ($header && ($header == "\r\n" || $header == "\n")) { //一直取到空行（消息头和消息体的那个空行）跳出，即把消息头部分都跳过
                    break;
                }
            }
            $stop = false;
            while (!feof($fp) && !$stop) {  //读取消息体部分
                $data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));  //此处是fread函数对fsockopen的限制，看php手册
                $return .= $data;
                if ($limit) {
                    $limit -= strlen($data);
                    $stop = $limit <= 0;
                }
            }
        }
        @fclose($fp);

        return $return;
    }
}

?>