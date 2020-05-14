<?php
/*
 * ニュースの一覧を表示する
 */
session_start();

//セッションからニュースのデータを取り込む（news）
$news_data = $_SESSION["news"];
?>

<?php
echo "<h2>お知らせ一覧</h2>";
echo "<ul>";
foreach($news_data as $news){
	echo "<li>";
	echo "<h5>" . $news["title"] . "</h5>";
	echo "<p>" . $news["body"] . "</p>";
	echo "</li>";
}
echo "</ul>";
?>

<form method="POST" action="post.php">
Title=<input type="text" name="News[title]" value="" />
Body=<input type="text" name="News[body]" value="" />
<input type="submit" value="送信" />
</form>