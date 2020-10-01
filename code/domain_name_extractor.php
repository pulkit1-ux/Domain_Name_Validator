<?php  
include 'key_val.php';


ini_set('max_execution_time', '0');

$sourceEmailId = $_POST['sourceEmailId'];
//$sourceEmailId="shruti.4@ģmail.com";
iconv('UTF-8', 'UTF-8',$sourceEmailId);

$domain_name = substr(strrchr($sourceEmailId, "@"), 1);
$loop = str_split($domain_name); $im = implode("", $loop);
  $contains_cyrillic = (bool) preg_match('/[\p{Cyrillic}]/u', $im) ; 

if ($contains_cyrillic) {
  echo "<h2 class=\"ml6\"><span class=\"text-wrapper\"><span class=\"letters\"><center>THIS DOMAIN NAME CONTAINS CYRLLIC CHARACTERS</span></span></h2>";
  echo"<font color=\"antiquewhite\"><h2><center>DO YOU MEAN TO CHECK</font></center></h2>";
  $txtabc = str_replace(array_keys($keyval), array_values($keyval), $domain_name);
 echo "<font color=\"antiquewhite\"><h2><center>"; echo $txtabc;
 
}
else if(!checkdnsrr($domain_name,"MX")) {
echo "<br><br><br><br><br><br><br><br><br><br><br><center><STRONG><b><h1 class=\"ml6\">
  <span class=\"text-wrapper\">
    <span class=\"letters\">WARNING: DOMAIN DOES NOT EXIST</span>
  </span>
  </b>
</h1>
<center>

";
}
else {
  
//$domainArray = mb_split($domain_name);
$domainArray = preg_split('/(?<!^)(?!$)/u', $domain_name); 
echo"<center>";
echo "<b><font color=\"#CDDC39\" size=\"5\">Entered Domain Name is: </b></font>" ;

foreach($domainArray as $character){
  // echo chr($character);//
//echo array_search($character,$keyval,true);
  
  echo "<b>";
  echo "<font size=\"5\" color=\"white\">";
    echo $character;
    
    echo "</b>";
    echo "</font>";
}
// PHP function to illustrate the use of array_search() 
// detect the character encoding of the incoming file
  //  $encoding = mb_detect_encoding( $domain_name, "auto" );
  //echo($encoding); 

$txt = str_replace(array_keys($keyval), array_values($keyval), $domainArray);
echo "</br>";
//echo "<div class=\"style\"><h1><font color=\"green\" size=\"5\">Real domain name is : </h1></font></div>";

//foreach($txt as $character){
  // echo chr($character);//
//echo array_search($character,$keyval,true);

     //echo  $character;

//}

$ip = gethostbyname($domain_name);




$txtstring = implode("", $txt);

$ip1 = gethostbyname($txtstring);




function dnsbllookup($ip)
{
  $dnsbl_lookup =
    [
      'dnsbl-1.uceprotect.net', 'all.s5h.net', 'wormrbl.imp.ch',
      'dnsbl-2.uceprotect.net', 'blacklist.woody.ch',
      'dnsbl-3.uceprotect.net', 'combined.abuse.ch', 'dnsbl.spfbl.net',
      'dnsbl.dronebl.org', 'bl.spamcannibal.org' 
    ];

  $dns_count = count($dnsbl_lookup);

  $list = [];

  if ($ip)
  {
    $reverse_ip = implode(".", array_reverse(explode(".", $ip)));

    foreach ($dnsbl_lookup as $host)
      if (checkdnsrr("$reverse_ip.$host.", "A"))
        $list[] = "<img src=\"https://www.shareicon.net/data/512x512/2015/11/22/676263_clipboard_512x512.png\" width=\"40px\" height=\"40px\" align=\"center\" class=\"white\"> <font color=\"antiquewhite\" size=\"4\" >$host</font>\n";


  }
  $list_count = count($list);

   echo "<br>";
   echo "<br>";
   echo "<br>";
   echo "<br>";
   echo "<div class=\"no\">";
 if (0 === $list_count)
    echo "No record was found in the IP blacklist database for:  $ip<br></font>\n";
  else
  {
  $list_str = implode(" ", $list);
    echo "$list_str<br><font size=\"1\"\nBlacklisted: $list_count<br>\n";
  }
  echo "$list_count|$dns_count</font>\n";
   echo "</div>";
echo "<br>";
   echo "<br>";
echo "<br>";
   echo "<br>";

if (0 === $list_count) {
  
echo "<div class=\"tab\">";
echo "<table border=\"1\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 0 SOURCES</td><td>&nbsp;<img src=\"check123.gif\" width=\"100px\" height=\"100px\" align=\"center\"></td></tr>";

echo "</table>";

echo "</div>";
}


if (1 === $list_count) {
  
  
echo "<div class=\"tab\">";
echo "<table border=\"1\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 1 SOURCES</td><td>&nbsp;<img src=\"check123.gif\" width=\"100px\" height=\"100px\" align=\"center\"></td></tr>";

echo "</table>";

echo "</div>";
}


if (2 === $list_count) {
  echo "<div class=\"tab\">";

echo "<table border=\"1\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 2 SOURCES</td><td>&nbsp;<img src=\"check123.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";

echo "</div>";
}


if (3 === $list_count) {
   echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg')\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 3 SOURCES</td><td>&nbsp;<img src=\"check123.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";
echo "</div>";

}



if (4 === $list_count) {
    echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg')\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 4 SOURCES</td><td><img src=\"check1.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";

echo "</div>";
}


if (5 === $list_count) {
    echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg')\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 5 SOURCES</td><td><img src=\"check1.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";

echo "</div>";
}


if (6 === $list_count) {
   echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg)\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 6 SOURCES</td><td><img src=\"check1.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";

echo "</div>";
}


if (6 === $list_count) {
   echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg)\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 6 SOURCES</td><td><img src=\"check2.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";
echo "</div>";

}


if (8 === $list_count) {
    echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg)\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 8 SOURCES</td><td><img src=\"check2.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";

echo "</div>";
}



if (9 === $list_count) {
    echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg)\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 9 SOURCES</td><td><img src=\"check2.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";

echo "</div>";
}

if (10 === $list_count) {
    echo "<div class=\"tab\">";

echo "<table border=\"1\" style=\"background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg)\">";

echo "<tr><th>IP ADDRESS</th><th>BLACKLIST STATUS</th><th>OVERALL REPUTATION</th></tr>";

echo "<tr><td>$ip</td><td>BLACKLISTED IN 10 SOURCES</td><td><img src=\"check2.gif\" width=\"100px\" height=\"100px\"></td></tr>";

echo "</table>";

echo "</div>";
}

           
                }
            




  
dnsbllookup($ip); 


  echo "<font color=\"antiquewhite\" size=\"5\">";
echo "<H1>LEGENDS</H1></font>";
echo"<dl>
    <dt><img src=\"check123.gif\" width=\"80px\" height=\"80px\"></dt>
    <dd><b>VERY SAFE</b> </dd>

    <dt><img src=\"check1.gif\"  width=\"80px\" height=\"80px\"></dt>
    <dd><b>&nbsp;SAFE</b></dd>
    <br>
    <dt><img src=\"check2.gif\"  width=\"80px\" height=\"80px\"></dt>
    <dd><b>  MAILICIOUS </b></dd>
</dl>";


  }










?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
    body{
      background: url('https://thumbs.dreamstime.com/t/abstract-blue-color-background-white-curves-high-quality-resolution-105632200.jpg');

      background-repeat: no-repeat;

      background-size: cover;
    }


.tab{
background-image: url('https://static.vecteezy.com/system/resources/previews/000/575/952/non_2x/gray-and-white-color-geometric-modern-background-design-vector-illustration.jpg');
width: 500px;

}

.enter{
color: white;

}

img.white{
  background: white;
}

.no{
  display: none;
}

h3 {font-size: 24px; }
            h3.success {
                color: #008000;
                text-align: center;
            }
            h3.fail {
                color: #ff0000;
                text-align: center;
            }


.ml6 {
  position: relative;
  font-weight: 900;
  font-size: 2.2em;
}

.ml6 .text-wrapper {
  position: relative;
  display: inline-block;
  padding-top: 0.2em;
  padding-right: 0.05em;
  padding-bottom: 0.1em;
  overflow: hidden;
}

.ml6 .letter {
  display: inline-block;
  line-height: 1em;
  color: #FF6347;
}
  

 dl
     {
         width: 255px;
         background: #fff;
         border: 1px solid #000;
         padding: 0px 5px;
      }

      dt, dd
      {
         display: inline-block;

      }

a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  background-color: #f1f1f1;
  color: black;
}
.round {
  border-radius: 50%;
}
.topleft {
  position: absolute;
  top: 8px;
  left: 16px;
  font-size: 18px;
}




  </style>




</head>
<body><div class="topleft">
  <button onclick="goBack()" class="round">
  <a href="#" class="previous round">&#8249;&#8249;</a></button></div>


<script>

anime.timeline({loop: true})
  .add({
    targets: '.ml6 .letter',
    translateY: ["1.1em", 0],
    translateZ: 0,
    duration: 750,
    delay: (el, i) => 50 * i
  }).add({
    targets: '.ml6',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });



function goBack() {
  window.history.back();
}
</script>
</script>
</body>
</html>