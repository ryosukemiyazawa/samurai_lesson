<body>
	<header><a href="/">オリジナル CMS サンプル</a></header>
	<div id="headerFiexdBlock"></div>
	<div class="container-fluid">
		<section class="container">
			<div class="row">
				<main class="col-md-8">
				<?php 
					include_once(getRoot().getRequestURL()."c.php");
				?>
				</main>
				<?php 
					include_once(getRoot()."/samurai_lesson/cms/src/parts/sub.php"); 
				?>
			</div>
		</section>
	</div>
	<footer>c 2019 <a href="/">オリジナル CMS サンプル</a></footer>
</body>