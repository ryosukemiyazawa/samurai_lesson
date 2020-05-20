<!DOCTYPE html>
<?php $webroot = $_SERVER['DOCUMENT_ROOT']; ?>
<?php include_once($webroot."/src/parts/temp.php"); ?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>自作CMSトップページ</title>
	<!-- BootstrapのCSS読み込み -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS読み込み -->
  <link href="assets/css/mystyle.css" rel="stylesheet">
	<!-- jQuery読み込み -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- BootstrapのJS読み込み -->
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
</head>

<body>
	<header><a href="/">オリジナル CMS サンプル</a></header>
	<div id="headerFiexdBlock"></div>
	<div class="container-fluid">
		<section class="container">
			<div class="row">
				<main class="col-md-8">
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
								</div>
							</section>
						</div>
					</section>
				</main>
			    <div class="col-md-4 side">
                   <aside>
                       <h4>CMSの管理ページは<a href="/admin/">こちら→</a></h4>
                       <p>実際に触ってみて！</p>
                   </aside>
                   <nav>
                       <h3>最新記事</h3>
                       <ul class="ul_new_contents">
                       </ul>
                   </nav>
                   <nav>
                       <h3>カテゴリ</h3>
                       <ul>
                       </ul>
                   </nav>
                   <nav>
                       <h3>アーカイブ</h3>
                       <ul>
                       </ul>
                   </nav>
                   <nav>
                       <h3>最近のコメント</h3>
                       <ul>
                       </ul>
                   </nav>
               </div>
           </div>
		</section>
	</div>
	<footer>c 2019 <a href="/">オリジナル CMS サンプル</a></footer>
</body>
