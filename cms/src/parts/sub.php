<div class="col-md-4 side">
	<aside>
		<h4>CMSの管理ページは<a href="admin/">こちら→</a></h4>
		<p>実際に触ってみて！</p>
	</aside>
	<nav>
		<h3>最新記事</h3>
		<ul class="ul_new_contents">
		<?php
			foreach(getDetailContentsList(NULL,true,true,NULL,5) as $contents){
				p('<li class="new_contents">');
				p('<a href="'.$contents["url"].'">');
				//p('<img src="'.getEyeCatchImage($contents).'">');
				p('<img src="/samurai_lesson/cms/assets/img/index.png">');
				p('<span>'.$contents["contents_name"].'</span>');
				p('</a>');
				p('</li>');
			}
		?>
		</ul>
	</nav>
	<nav>
		<h3>カテゴリ</h3>
		<ul>
		<?php
			foreach(getCategoryList(1) as $c){
				p('<li><a href="'.$c['url'].'">'.$c['name'].'</a>');
			}
		?>
		</ul>
	</nav>
	<nav>
		<h3>アーカイブ</h3>
		<ul>
		<?php
			foreach(getArchiveList() as $a){
				p('<li><a href="'.$a['url'].'">'.$a['date'].' ('.$a['count'].')</a>');
			}
		?>
		</ul>
	</nav>
	<nav>
		<h3>最近のコメント</h3>
		<ul>
		<?php
		?>
		</ul>
	</nav>
</div>