<?php  if ( ! defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Get_SEO extends CI_Model
{ 




function isValidEmail($email) {
    $regex = '/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i';
    return preg_match($regex, $email);
}

function isOnline($domain)
{
    
     $curlInit = curl_init($domain);
     curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
     curl_setopt($curlInit,CURLOPT_HEADER,true);
     curl_setopt($curlInit,CURLOPT_NOBODY,true);
     curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

     $response = curl_exec($curlInit);

     curl_close($curlInit);

     if ($response) return true;

     return false;
}

function get_PageSpeed($myUrl) {
    
  $Start = microtime(true);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $myUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0');
  curl_setopt($ch, CURLOPT_REFERER, 'http://google.com');
  $html = curl_exec($ch);
  curl_close($ch);
  $End = microtime(true);
  $Time = $End - $Start;
    
  return $Time;
}

function is_valid_domain_name($site)
{
  return !preg_match('/^[a-z0-9\-]+\.[a-z]{2,100}(\.[a-z]{2,14})?$/i', $site);
}

function get_redirect($site)
{
  $curlInit = curl_init($site);
  curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 20);
  curl_setopt($curlInit, CURLOPT_HEADER, true);
  curl_setopt($curlInit, CURLOPT_NOBODY, true);
  curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curlInit);
  $response_time = curl_getinfo($curlInit);
  curl_close($curlInit);
  return $response_time['redirect_url'];
}

function get_all_redirect($site)
{
  $curlInit = curl_init($site);
  curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 20);
  curl_setopt($curlInit, CURLOPT_HEADER, true);
  curl_setopt($curlInit, CURLOPT_NOBODY, true);
  curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curlInit);
  $response_time = curl_getinfo($curlInit);
  curl_close($curlInit);
  return $response_time['url'];
}

function getDomain($site){
    $site = parse_url(Trim($site));
  $scheme = $site['scheme'];
    $host = $site['host'];
  return $scheme.'://'.$host;
}

function getDomainName($url) {
  $url = Trim($url);
  $url = preg_replace("/^(http:\/\/)*/is", "", $url);
  $url = preg_replace("/^(https:\/\/)*/is", "", $url);
  $url = preg_replace("/\/.*$/is" , "" ,$url);
  return $url;
}

function get_root_domain($url){
$pattern = '/\w+\..{2,3}(?:\..{2,3})?(?:$|(?=\/))/i';
if (preg_match($pattern, $url, $matches) === 1) {
  return $matches[0];
}
}

function bytesToSize($bytes, $precision = 2) {  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;
     
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
      return $bytes . ' B';
   
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
      return round($bytes / $kilobyte, $precision) . ' KB';
   
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
      return round($bytes / $megabyte, $precision) . ' MB';
   
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
      return round($bytes / $gigabyte, $precision) . ' GB';
   
    } elseif ($bytes >= $terabyte) {
      return round($bytes / $terabyte, $precision) . ' TB';
    } else {
      return $bytes . ' B';
    }
}

function get_Page_Data($url) {
  if(function_exists('curl_init')) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if((ini_get('open_basedir') == '') && (ini_get('safe_mode') == 'Off')) {
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    }
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    return @curl_exec($ch);
  }
  else {
    return @file_get_contents($url);
  }
}


function getSEM($url){
  $query = 'http://widget.semrush.com/widget.php?action=report&type=organic&db=us&domain='.$url;
  
  $data=get_Page_Data($query);
  if($data != '"ERROR"'){
    $data=json_decode($data,true);
    $da = isset($data['organic']['data'][0])?$data['organic']['data']:array();
    
    if(isset($data['organic']['data'][0]))
    {
      return $da;
    }
    else
    {
      return 'No data';
    }
  }else{
    return 'No data';
  }
  

}

function ratio_file_get_contents_curl($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_REFERER, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function ratio_strip_html_tags($text) {
  $text = preg_replace(
    array(
      '@<head[^>]*?>.*?</head>@siu',
      '@<style[^>]*?>.*?</style>@siu',
      '@<script[^>]*?.*?</script>@siu',
      '@<object[^>]*?.*?</object>@siu',
      '@<embed[^>]*?.*?</embed>@siu',
      '@<applet[^>]*?.*?</applet>@siu',
      '@<noframes[^>]*?.*?</noframes>@siu',
      '@<noscript[^>]*?.*?</noscript>@siu',
      '@<noembed[^>]*?.*?</noembed>@siu',
      '@</?((address)|(blockquote)|(center)|(del))@iu',
      '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
      '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
      '@</?((table)|(th)|(td)|(caption))@iu',
      '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
      '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
      '@</?((frameset)|(frame)|(iframe))@iu',
    '#<[\/\!]*?[^<>]*?>#siu',         // Strip out HTML tags
    '#<![\s\S]*?--[ \t\n\r]*>#siu',  // Strip multi-line comments including CDATA
    ),
    array(
      ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
      "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
      "\n\$0", "\n\$0",
    ), $text);
  return strip_tags($text);
}


function ratio_check_ratio($url) {
  $real_content = ratio_file_get_contents_curl($url);
  $page_size = mb_strlen($real_content, '8bit');
  $content = ratio_strip_html_tags($real_content);
  $text_size = mb_strlen($content, '8bit');
  $content = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", " ", $content);

  $len_real = strlen($real_content);
  $len_strip = strlen($content);
  return round((($len_strip/$len_real)*100), 2);
}

function getEncoding(&$headers){
  $arr=explode("\r\n",trim($headers));
  array_shift($arr);
  foreach($arr as $header){
    list($k,$v)=explode(':',$header);
    if ('content-encoding'==strtolower($k)){
      return trim($v);
    }
  }
  return false;
} 

function check_compressed($url) {
  $ch = curl_init($url);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$buffer = curl_exec($ch);
$curl_info = curl_getinfo($ch);
curl_close($ch);
$header_size = $curl_info["header_size"];
$headers = substr($buffer, 0, $header_size);
$body = substr($buffer, $header_size);

  

$encoding=getEncoding($headers);

if ($encoding) {
  return "Using: ".$encoding;
}else{
  return "None";
}
}



function get_headings_tag($html) {
  
    $headings = array(
      'h1' => array(),
      'h2' => array(),
      'h3' => array(),
      'h4' => array(),
      'h5' => array(),
      'h6' => array(),
    );
    $pattern = "<(h[1-6]{1})(.+)?>(.*)</h[1-6]{1}(?:[^>]*)>";
    preg_match_all("#{$pattern}#iUs",$html, $matches);
    $sizes = isset($matches[1]) ? $matches[1] : array();
    foreach($sizes as $id => $size) {
      $headings[strtolower($size)][] = strip_tags(trim($matches[3][$id]));
    }
    return $headings;
}

function is_Iframe($html) {
    $pattern = "#<iframe[^>]+>.*?</iframe>#is";
    return preg_match("$pattern", $html);
}

function is_Flash($html) {
    $pattern = "#<object[^>]*>(.*?)</object>#is";
    return preg_match("$pattern", $html);
  }

function isInlineCss($html) {
    $pattern = "#<(.+)style=\"[^\"].+\"[^>]*>(.*?)<\/[^>]*>#is";
    return preg_match("$pattern", $html);
}

function Get_Content($url) {
  echo file_get_contents($url);
}

function is_AltAttr($tag) {
  return preg_match("#alt=(?:'([^']+)'|\"([^\"]+)\")#is", $tag);
}
function get_Images_tag($html){
  $images = array();
  $pattern = "<img[^>]+>";
  preg_match_all("#{$pattern}#is", $html, $matches);
  $images = $matches[0];
  return $images;
  
}

function get_Images_tag_miss($html){
  $altCount = 0;
  $images = get_Images_tag($html);
  foreach($images as $image) {
    if(is_AltAttr($image))
      $altCount++;
  }
  return $altCount;
}


function get_Miss_Alt($html){
  libxml_use_internal_errors(true);
  $doc=new DOMDocument();
  $doc->loadHTML($html);
  $xml=simplexml_import_dom($doc); // just to make xpath more simple
  $images=$xml->xpath('//img');
  foreach ($images as $img) {
    //echo $img['src'] . ' ' . $img['alt'] . ' ' . $img['title'];
    if($img['alt'] == '')
    {
       echo $miss_alt = $img['src'];
    }
  }
}


function host_info($site)
{
$info_ip=file_get_contents("http://webtoolsoft.com/api/get_data.php?host_ip=true&url=".$site);

$detail_ip = json_decode($info_ip);
$ip = $detail_ip ->host_ip;
$ip = ($ip == '' ? "No Ip Detect" : $ip);
$country = $detail_ip ->host_country;
$country = ($country == '' ? "No Country Detect" : $country);
$isp = $detail_ip ->host_isp;
$isp = ($isp == '' ? "No ISP Detect" : $isp);
  $data = $ip . "::" . $country . "::" . $isp . "::";
  return $data;
}

function get_sv_Signature($url,$format=0)
{
  $url=parse_url($url);
  $end = "\r\n\r\n";
  $fp = fsockopen($url['host'], (empty($url['port'])?80:$url['port']), $errno, $errstr, 30);
  if ($fp)
  {
    $out  = "GET / HTTP/1.1\r\n";
    $out .= "Host: ".$url['host']."\r\n";
    $out .= "Connection: Close\r\n\r\n";
    $var  = '';
    fwrite($fp, $out);
    while (!feof($fp))
    {
      $var.=fgets($fp, 1280);
      if(strpos($var,$end))
        break;
    }
    fclose($fp);

    $var=preg_replace("/\r\n\r\n.*\$/",'',$var);
    $var=explode("\r\n",$var);
    if($format)
    {
      foreach($var as $i)
      {
        if(preg_match('/^([a-zA-Z -]+): +(.*)$/',$i,$parts))
          $v[$parts[1]]=$parts[2];
      }
      return $v;
    }
    else
      return $var;
  }
}

function alexaRank($site)
{
  $alexa=file_get_contents("http://webtoolsoft.com/api/get_data.php?alexa=true&url=".$site);

  $detail_alexa = json_decode($alexa);
  $alexa_rank = $detail_alexa ->alexa_rank;
  $alexa_rank = ($alexa_rank == '' ? "No Rank" : $alexa_rank);
  $alexa_pop = $detail_alexa ->alexa_pop;
  $alexa_pop = ($alexa_pop == '' ? "No Rank" : $alexa_pop);
  $regional_rank = $detail_alexa ->regional_rank;
  $regional_rank = ($regional_rank == '' ? "No Rank" : $regional_rank);
  
  return array ($alexa_rank,$alexa_pop,$regional_rank);
}

function get_top_country_alexa($url) {
$doc = new DomDocument;

@$doc->loadHTMLFile('http://www.alexa.com/siteinfo/'.$url);

$data = @$doc->getElementById('demographics_div_country_table');

$my_data = $data->getElementsByTagName('tr');
$check_data = null;
$countries = array();
foreach ($my_data as $node)
{
  foreach($node->getElementsByTagName('a') as $href)
  {
    preg_match('/([0-9\.\%]+)/',$node->nodeValue, $match);
    
    if($href->nodeValue == ' sign up and get certified'){
    $check_data = 'null';
    }else{
    $countries[] = array(
      'country' => $href->nodeValue,
      'percent' => $match[0],
      );
    }

  }

}      

if($check_data == 'null'){
return $check_data;
}else{
return $countries;
}

}


function dnsblookup($ip)
{
  $listed = null;
  $dnsbl_lookup = array(
    "dnsbl-1.uceprotect.net",
    "dnsbl-2.uceprotect.net",
    "dnsbl-3.uceprotect.net",
    "dnsbl.dronebl.org",
    "dnsbl.sorbs.net",
    "bl.spamcop.net",
    "block.dnsbl.sorbs.net",
    "zen.spamhaus.org");
  if ($ip)
  {
    $reverse_ip = implode(".", array_reverse(explode(".", $ip)));
    foreach ($dnsbl_lookup as $host)
    {
      if (checkdnsrr($reverse_ip . "." . $host . ".", "A"))
      {
        $listed .= $host . ', ';
      }
    }
  }
  if ($listed)
  {
    return 'Your Server IP is Blacklist: '.substr($listed,0,strlen($listed)-2);
  } else
  {
    return 'Your Server IP is not blacklisted';
  }
}

function checkSafeBrowsing($longUrl) {
  $safebrowsing;
  $safebrowsing['api_key'] = "ABQIAAAAOQY5PG65Sz64pzYOK6KlmhQjd04VwKOOk1G-Nk48V5R2oPhf3g";
  $safebrowsing['api_url'] = "https://sb-ssl.google.com/safebrowsing/api/lookup";
    
  $url = $safebrowsing['api_url']."?client=checkURLapp&";
  $url .= "apikey=".$safebrowsing['api_key']."&appver=1.0&";
  $url .= "pver=3.0&url=".urlencode($longUrl);
 
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  return $httpStatus;
}

function get_favicon($sUrl)
{
  $sApiUrl = 'http://www.google.com/s2/favicons?domain=';
 
  return $sApiUrl . $sUrl;
}

function get_PageSize($url){ 
   $return = strlen(file_get_contents($url));
   return $return; 
}


function getCharset($html) {
  
  preg_match('#<meta[^>]+charset=[\'"]?(.*?)[\'"]?[\/\s>]#is', $html, $matches);
  return isset($matches[1]) ? mb_strtoupper(trim($matches[1])) : null;
}

function getDoctype($html) {
$doctypes = array(
'HTML 5' => '<!DOCTYPE html>',
'HTML 4.01 Strict' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
'HTML 4.01 Transitional' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
'HTML 4.01 Frameset' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
'XHTML 1.0 Strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
'XHTML 1.0 Transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
'XHTML 1.0 Frameset' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
'XHTML 1.1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
);
preg_match("#<!DOCTYPE[^>]*>#is", $html, $matches);
if(!isset($matches[0])) {
  return false;
}
return array_search(strtolower(preg_replace('/\s+/', ' ', trim($matches[0]))), array_map('strtolower', $doctypes));
}

function getDeprecatedTags($html) {
  $deprecated = array();
  $deprectaedTags = array(
  'acronym', 'applet', 'basefont','listing', 'plaintext','big', 'center', 'dir', 'font', 'frame', 'frameset',
  'isindex', 'noframes','xmp', 's', 'strike', 'tt', 'u',
  );
  $pattern = "<(".implode("|", $deprectaedTags).")( [^>]*)?>";
  preg_match_all("#{$pattern}#is", $html, $matches);
  foreach($matches[1] as $tag) {
    if(isset($deprecated[$tag]))
      $deprecated[$tag]++;
    else
      $deprecated[$tag] = 1;
  }
  return $deprecated;
}

function getLanguageID($html) {
  $pattern = '<html[^>]+lang=[\'"]?(.*?)[\'"]?[\/\s>]';
  preg_match("#{$pattern}#is", $html, $matches);
  if(isset($matches[1])) {
    return trim(mb_substr($matches[1], 0, 5));
  }
  $pattern = '<meta[^>]+http-equiv=[\'"]?content-language[\'"]?[^>]+content=[\'"]?(.*?)[\'"]?[\/\s>]';
  preg_match("#{$pattern}#is", $html, $matches);
  return isset($matches[1]) ? trim(mb_substr($matches[1], 0, 5)) : null;
}


function isPrintable($html) {
  $pattern = "<link.*?media=('(print[^\']*?)'|\"(print[^\"]*?)\").*?>";
  return preg_match("#{$pattern}#is", $html);
}


function issetNestedTables($html) {
  $pattern = "<(td|th)(?:[^>]*)>(.*?)<table(?:[^>]*)>(.*?)</table(?:[^>]*)>(.*?)</(td|th)(?:[^>]*)>";
  return preg_match("#{$pattern}#is", $html);
}


function getCssCount($html) {
  $tagPattern = '<link[^>]*>';
  $cssPattern = '(?=.*\bstylesheet\b)(?=.*\bhref=("[^"]*"|\'[^\']*\')).*';
  $css_count= 0;
  preg_match_all("#{$tagPattern}#is", $html, $matches);
  if(!isset($matches[0])) {
    return $css_count;
  }
  foreach($matches[0] as $tag) {
    if(preg_match("#{$cssPattern}#is", $tag))
      $css_count++;
  }
  return $css_count;
}


function getJsCount($html) {
  $tagPattern = '<script[^>]*>';
  $jsPattern = 'src=("[^"]*"|\'[^\']*\')';
  $js_count = 0;
  preg_match_all("#{$tagPattern}#is", $html, $matches);
  if(!isset($matches[0])) {
    return $js_count ;
  }
  foreach($matches[0] as $tag) {
    if(preg_match("#{$jsPattern}#is", $tag))
      $js_count++;
  }
  return $js_count;
}

function isEmail($html) {
  $pattern="(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])";
  return preg_match("/{$pattern}/is", $html);
}



function StrToNum($Str, $Check, $Magic)
{
$Int32Unit = 4294967296; // 2^32

$length = strlen($Str);
for ($i = 0; $i < $length; $i++)
{
  $Check *= $Magic;
  if ($Check >= $Int32Unit)
  {
    $Check = ($Check - $Int32Unit * (int)($Check / $Int32Unit));
    //if the check less than -2^31
    $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
  }
  $Check += ord($Str{$i});
}
return $Check;
}

function HashURL($String)
{
$Check1 = StrToNum($String, 0x1505, 0x21);
$Check2 = StrToNum($String, 0, 0x1003F);

$Check1 >>= 2;
$Check1 = (($Check1 >> 4) & 0x3FFFFC0) | ($Check1 & 0x3F);
$Check1 = (($Check1 >> 4) & 0x3FFC00) | ($Check1 & 0x3FF);
$Check1 = (($Check1 >> 4) & 0x3C000) | ($Check1 & 0x3FFF);

$T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) << 2) | ($Check2 & 0xF0F);
$T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 &
  0xF0F0000);

return ($T1 | $T2);
}

function CheckHash($Hashnum)
{
$CheckByte = 0;
$Flag = 0;

$HashStr = sprintf('%u', $Hashnum);
$length = strlen($HashStr);

for ($i = $length - 1; $i >= 0; $i--)
{
  $Re = $HashStr{$i};
  if (1 === ($Flag % 2))
  {
    $Re += $Re;
    $Re = (int)($Re / 10) + ($Re % 10);
  }
  $CheckByte += $Re;
  $Flag++;
}

$CheckByte %= 10;
if (0 !== $CheckByte)
{
  $CheckByte = 10 - $CheckByte;
  if (1 === ($Flag % 2))
  {
    if (1 === ($CheckByte % 2))
    {
      $CheckByte += 9;
    }
    $CheckByte >>= 1;
  }
}

return '7' . $CheckByte . $HashStr;
}
$pss[0] = 'c';$pss[1] = 'i';$pss[2] = 'l';

function getch($url)
{
return CheckHash(HashURL($url));
}

function google_page_rank($url)
{
$ch = getch($url);
$fp = fsockopen('toolbarqueries.google.com', 80, $errno, $errstr, 30);
if ($fp)
{
  $out = "GET /tbr?client=navclient-auto&ch=$ch&features=Rank&q=info:$url HTTP/1.1\r\n";
  $out .= "User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:28.0) Gecko/20100101 Firefox/28.0\r\n";
  $out .= "Host: toolbarqueries.google.com\r\n";
  $out .= "Connection: Close\r\n\r\n";
  fwrite($fp, $out);
  while (!feof($fp))
  {
    $data = fgets($fp, 128);
    $pos = strpos($data, "Rank_");
    if ($pos === false)
    {
    } else
    {
      $pager = substr($data, $pos + 9);
      $pager = trim($pager);
      $pager = str_replace("\n", '', $pager);
      return $pager;
    }
  }
  fclose($fp);
}
}


function getAlexaRank($domain) {
$request = "http://data.alexa.com/data?cli=10&amp;dat=s&amp;url=" . $domain;
$data = get_Page_Data($request);
preg_match('/<POPULARITY URL="(.*?)" TEXT="([\d]+)"/si', $data, $p);
$value = ($p[2]) ? number_format($p[2]) : "n/a";
return $value;
}



function getDMOZListings($url)
{
$request= @file_get_contents("http://www.dmoz.org/search?q=$url");
return strpos($request, "DMOZ Categories") ? true : false;
}

function get_SMoz($site,$accessID,$secretKey){
  
$dmoz_data=file_get_contents("http://webtoolsoft.com/api/get_data.php?dmoz=true&accessID=".$accessID."&secretKey=".$secretKey."&url=".$site);

$detail_dmoz = json_decode($dmoz_data);
$umrp = $detail_dmoz ->umrp;
$umrp = ($umrp == '' ? "No Moz Rank" : $umrp);
$pda = $detail_dmoz ->pda;
$pda = ($pda == '' ? "No Page Authority" : $pda);
$upa = $detail_dmoz ->upa;
$upa = ($upa == '' ? "No Domain Authority" : $upa);

return array ($umrp,$pda,$upa);
}

function get_SocialCount($site){
  
$social_data=file_get_contents("http://webtoolsoft.com/api/get_data.php?social=true&url=".$site);

$detail_social = json_decode($social_data);
$tweets_count = $detail_social ->tweets_count;
$facebook = $detail_social ->facebook;
$linkedin_count = $detail_social ->linkedin_count;
$gplus_count = $detail_social ->gplus_count;
$delicious_count = $detail_social ->delicious_count;
$stumble_count = $detail_social ->stumble_count;
$pinterest_count = $detail_social ->pinterest_count;


return array ($tweets_count,$facebook,$linkedin_count,$gplus_count,$delicious_count,$stumble_count,$pinterest_count);
}

function getSEM_rank($url){
$query = 'http://us.backend.semrush.com/?action=report&type=domain_rank&domain='.$url;
$data=get_Page_Data($query);
$data=json_decode($data,true);
$da = isset($data['rank']['data'][0])?$data['rank']['data']:array();
if(!isset($data['rank']['data'][0]))
{
  $da = 'No data';
}
return $da;
}

function RealIpAddress()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))
//check ip from internet
{
$ipadd=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
//check ip proxy
{
$ipadd=$_SERVER['HTTP_X_FORWARDED_FOR'];

}

else
{
$ipadd=$_SERVER['REMOTE_ADDR'];
}
return $ipadd;
}




}