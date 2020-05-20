<section>
	<h2>このサイトについて</h2>
	<p>ここは自作CMSのサンプルサイトです。</p>
	<p>このサイトで使用しているコンテンツマネジメントシステムの作成方法はこちらのnoteで紹介しています。</p>
	<p>ステップごとに有料コンテンツとなっていますので、進める中であなたにとって必要かどうか、判断しながらご利用ください。</p>
	<p>本サイトの中では好きなだけCMSを動かしてみて実際に作成に着手してみるか是非ご判断ください！</p>
	<p>note内でも記載していますが、これをもとにオリジナルCMSを極めるもよし、もっとセキュリティや運用面をもっと洗練させて製品化のベースとするもヨシです。</p>
	<p>また初心者の方も実際にHTML,CSS,PHP,JQuery,MYSQL等の技術を習うのにご活用ください。</p>
</section>
<section>
	<h2>新着情報</h2>
	<div class="container-fluid">
		<section class="container">
			<div class="row contents_list_wrap">
				<?php
				// $sql = "SELECT * FROM org_contents WHERE contents_id = 1";
				$sql = "SELECT * FROM org_contents";
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				p($result["name"]);
				//	foreach(getDetailContentsList(NULL,true,true,NULL,6) as $contents){
				//		include(getRoot()."/src/parts/contents_list.php");
				//	}
				?>
			</div>
		</section>
	</div>
</section>