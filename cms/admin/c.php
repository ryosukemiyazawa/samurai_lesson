			<section>
				<h2>管理ページ</h2>
				<p>各テーブルの編集や記事の作成、プロパティの設定ができます。</p>
			</section>
			<section>
				<h2>各テーブルの登録・更新・削除</h2>
				<ul>
				<?php
					foreach(getTableList() as $table){
						$name = str_replace('org_' ,'' , $table['Name']);
						// p('<li><a href="admin/'.$name.'/list/">'.$table['Comment'].'</a>');
						p('<li><a href="'.$name.'/list/">'.$table['Comment'].'</a>');
					}
				?>
				</ul>
			</section>
			<section>
				<h2>記事の編集・設定</h2>
				<ul>
				<?php
					foreach(getDetailContentsList(NULL,false) as $c){
						$name = $c['contents_name'];
						$caid = $c['category_id'];
						$coid = $c['contents_id'];
						if($c['disabled_flg']==1){
							$disabled="（<b class='red'>未公開</b>）";
						}else{
							$disabled="（公開済）";
						}
						p('<li>');
						p($caid.'-'.$coid.':<a href="/admin/edit/?category_id='.$caid.'&contents_id='.$coid.'">'.$name.'</a>');
					}
				?>
				</ul>
			</section>