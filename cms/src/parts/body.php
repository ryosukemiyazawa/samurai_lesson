<body>
	<header><a href="/">オリジナル CMS サンプル</a></header>
	<div id="headerFiexdBlock"></div>
	<div class="container-fluid">
		<section class="container">
			<div class="row">
				<main class="col-md-8">
				<?php 
				
				// // admin/category/list -> admin/category/list/c.php
				// // admin/contents/list -> admin/contents/list/c.php
				// if(getAppRequestURL() == "/admin/contents/list/"){
				// 	//include_once(APP_ROOT."/admin/contents/list/c.php");
				// }
				// //include_once(getRoot().getRequestURL()."c.php");
				// // include_once(APP_ROOT.getAppRequestURL()."c.php");
				// include_once(APP_ROOT.$page["url"]."c.php");
				// 	// include_once(getRoot()."/samurai_lesson/cms/src/parts/c.php"); 
				// 	// echo (getRoot().getRequestURL()."c.php");
				// 	// echo (APP_ROOT.$page["url"]."c.php");
				if(isPublicCategory($page)){
					/** カテゴリ記事一覧 */
					// include_once(getRoot()."/src/parts/category.php");
					include_once(getRoot()."/samurai_lesson/cms/src/parts/category.php");
					
				}else if(strstr(getRequestURL(),"archive")){
					/* アーカイブ */
					// include_once(getRoot()."/src/parts/archive.php");
					include_once(getRoot()."/samurai_lesson/cms/src/parts/archive.php");
					
				}else {
					/** その他。管理ページの想定。URLパラメータ付きの為、getRequest()しない。 */
					// include_once(getRoot().$page["url"]."c.php");
					include_once(APP_ROOT.$page["url"]."c.php");
				}
				?>
				</main>
				<?php 
					include_once(getRoot()."/samurai_lesson/cms/src/parts/sub.php"); 
					// include_once(APP_ROOT."/cms/src/parts/sub.php"); 
				?>
			</div>
		</section>
	</div>
	<footer>c 2019 <a href="/">オリジナル CMS サンプル</a></footer>
</body>