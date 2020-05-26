<?php 
	$webroot = $_SERVER['DOCUMENT_ROOT'];
	// include_once($webroot."/src/common/setup.php");
	include_once($webroot."/samurai_lesson/cms/src/common/setup.php");

	header("Content-type: text/plain; charset=UTF-8");

	$table_name = $_POST['table_name'];

	/* キー部分 */
	$key_array = array();
	foreach(getColumnList($table_name) as $c){
		if($c['Key'] == "PRI"){
			$key_array[$c['Field']] = $_POST[$c['Field']];
		}
	}

	$where_query = getPrimaryWhereQuery($key_array);

	try{
		$dbh->beginTransaction();
		$sql = "DELETE FROM ".$table_name.$where_query;
		p("以下のSQLを実行します。\n\n".$sql."\n\n");
		$stmt = $dbh->prepare($sql);
		if($stmt->execute()){
			/** コンテンツのときのみ、レコード削除の成功時にフォルダおよびファイルも削除する */
			if($table_name == "org_contents"){
				$category_id = $key_array["category_id"];
				$contents_id = $key_array["contents_id"];
				//$contents = getDetailContents($category_id, $contents_id);
				//dir_full_clean($contents);
				//p("関連ファイルを削除しました。")
			}
			$dbh->commit();
		}else{
			p("削除処理が失敗しました。");
			$dbh->rollBack();
		}
	} catch (Exception $e) {
		$dbh->rollBack();
		p("失敗しました｡;".$e->getMessage());
	}
?>