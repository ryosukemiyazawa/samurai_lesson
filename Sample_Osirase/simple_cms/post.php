<?php
/*
 * データを受け取る 
 */
session_start();

 //Newsのデータを受け取る
$new_data = $_POST["News"];

//こう受け取っても良い
//$title = $_POST["News"]["title"];
//$body = $_POST["News"]["body"];

$title = $new_data["title"];
$body = $new_data["body"];

//保存されているデータ
//$saved_data = (isset($_SESSION["news"])) ? $_SESSION["news"] : [];

//保存されているデータを取り込む
$saved_data = [];
if(isset($_SESSION["news"])){
	$saved_data = $_SESSION["news"];
}

//データを追加する
array_push($saved_data, [
	"title" => $title,
	"body" => $body
]);

// 今風の書き方
// $saved_data[] = [
// 	"title" => $title,
// 	"body" => $body
// ];

//セッション(news)にデータを保存する
$_SESSION["news"] = $saved_data;

//完了画面を表示

echo "<p>書き込みが完了しました</p>";

echo "<a href=\"news.php\">戻る</a>";

?>
