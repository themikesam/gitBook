<?php
session_start();
//require("dbconnect.php");

//set the login mark to empty
if ( ! isset($_SESSION['uID']) or $_SESSION['uID'] <= 0) {
	header("Location: loginForm.php");
	exit(0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>my guest book !! [<a href='loginForm.php'>logout </a>]</p>
<hr />
<table width="600" border="1">
  <tr>
    <td>id</td>
    <td>title</td>
    <td>message</td>
    <td>author</td>
    <td>recommend by</td>
    <td>Likes</td>
  </tr>
<?php
require_once("model.php");
$results=getBookList();

while (	$rs=mysqli_fetch_array($results)) {

	echo "<tr><td>" , $rs['id'] ,
	"<a href='control.php?act=delete&id=",$rs['id'] ,"'>砍</a> | ",
	"<a href='editMessageForm.php?id=",$rs['id'] ,"'>改</a> | ",
  "<a href='control.php?act=like&id=",$rs['id'] ,"'>Like</a> | ",
  "<a href='control.php?act=unlike&id=",$rs['id'] ,"'>踩</a> | ",
  "<a href='viewdetail.php?id=",$rs['id'] ,"'>Comment</a> | ",
	"</td><td><a href='showBook.php'id=",$rs['id'],">" , $rs['title'],"</a>",
	"</td><td>" , $rs['msg'],
	"<td>", $rs['author'],
	"<td>", $rs['name'],
	"<td>(", $rs['push'], ")</td></td></tr>";
}
?>

  <tr><form method="post" action="control.php">
    <td><label>
      <input type="submit" name="Submit" value="新增" />
      <input name="act" type="hidden" value='insert' />
    </label></td>
    <td><label>
      <input name="title" type="text" id="title" />
    </label></td>
    <td><label>
      <input name="msg" type="text" id="msg" />
    </label></td>
    <td><label>
      <input name="author" type="text"  />
    </label></td>
    <td><label>
      <input name="myname" type="hidden" id="myname" value='<?php echo $_SESSION['uID']; ?>' />
    </label></td>
	</form>
  </tr>
</table>
</body>
</html>
