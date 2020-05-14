<h5>説明</h5>

<ul>
	<li>フォームの値を連想配列で受け取る時は<code>XXX[YYY]</code>の形式で指定する
	<li>例:<code>Book[title]</code>は<code>$_GET["Book"]["title"]</code>に変換される
	<li>連想配列にすると複数のデータのまとまりをまとめて受け取ることができる
	<li>例:<code>Book[title]</code>と<code>Book[author]</code>は<code>$_GET["Book"]</code>でまとめて受け取れる
	<li>配列にする場合は<code>XXX[]</code>の形式になる
	<li>例:<code>Tag[]</code>として複数件のデータを受け取る
	<li>連想配列は何件にも入れ子にしても良いが、あまりに階層が深いと後々わかりにくくなるので適度な範囲にしたほうが良い
	<li>例:<code>Book[a][b][c][d][e][f][g][]</code>は<code>$_GET["Book"]["a"]["b"]["c"]["d"]["e"]["f"]["g"]</code>になる
</ul>


<form method="get">
	<h2>Book</h2>
	Title=<input type="text" name="Book[title]" value="" />
	<br />
	Author=<input type="text" name="Book[author]" value="" />

	<h2>Library</h2>
	LibraryName=<input type="text" name="Library[name]" value="" />
	<br />
	LibraryArea=<input type="text" name="Library[area]" value="" />

	<h2>書籍タグ</h2>
	Tag1=<input type="text" name="Book[tag][]" value="" />
	<br />
	Tag2=<input type="text" name="Book[tag][]" value="" />
	<br />
	Tag3=<input type="text" name="Book[tag][]" value="" />
	<br />
	Tag4=<input type="text" name="Book[tag][]" value="" />


	<hr />
	<input type="text" name="Book[a][b][c][d][e][f][g][]" value="" />

	<input type="submit" value="submit" />
</form>

<?php
if($_GET){

	echo "<pre>";
	//var_dump(@$_GET["Test"]);
	var_dump(@$_GET["Book"]);
	echo "</pre>";

	//Bookの受け取り
	$book = [
		"title" => "",
		"author" => "",
	];
	if(isset($_GET["Book"])){
		$book = $_GET["Book"];
	}

	//Libraryの受け取り
	$library = [
		"name" => "",
		"area" => ""
	];
	if(isset($_GET["Library"])){
		$library = $_GET["Library"];
	}

	$title = $book["title"];
	$author = $book["author"];

	echo $title . ":" . $author;
	echo "<br />";

	//
	echo "Tag:<br />";
	var_dump($book["tag"]);

}
?>