<div class="col-md-4 new_contents main_display_contents_list">
<?php
	p('<a href="'.$contents["url"].'">');
	//if(date("Y-m-d") <= getCompareNewContentsDate($contents)){
	//	p('<span class="new_mark">new</span>');
	//}
	//p('<img src="'.getEyeCatchImage($contents).'">');
	p('<img src="/samurai_lesson/cms/assets/img/index.png">');
	p('<span>'.$contents["contents_name"].'</span>');
	p('<span class="news_create_date"><small>'.$contents["create_date"].'</small></span>');
?>
</a>
</div>
