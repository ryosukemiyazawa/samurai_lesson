<section>
	<h2>『<?php p($page["category_name"]); ?>』の記事一覧</h2>
    <div class="container-fluid">
		<section class="container">
			<div class="row contents_list_wrap">
				<?php
					foreach(getDetailContentsList($page["category_id"],true,true) as $contents){
						include(getRoot()."/samurai_lesson/cms/src/parts/contents_list.php");
					}
				?>
			</div>
		</section>
	</div>	
</section>

<script>
    document.title = <?php p('"『'.$page["category_name"].'』"'); ?> + "の記事一覧";
</script>