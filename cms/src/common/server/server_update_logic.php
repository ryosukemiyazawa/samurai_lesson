<?php 
	$webroot = $_SERVER['DOCUMENT_ROOT'];
	// include_once($webroot."/src/common/setup.php");
	include_once($webroot."/samurai_lesson/cms/src/common/setup.php");

	header("Content-type: text/plain; charset=UTF-8");

	$table_name = $_POST['table_name'];
	$table_columns = getColumnList($table_name);
	$update_array = array();

	/* 入力された内容を連想配列に保持 */
	foreach($table_columns as $c){
		if(!isAdminDateItem($c['Field'])){
			/* checkboxのチェック対策（脆弱だ・・・） */
			$update_array[$c["Field"]] = $_POST[$c["Field"]] <> "undefined" ? $_POST[$c["Field"]]: NULL;
		}
	}

	/* 更新値部分 */
	$items_params_str = " ";	
	foreach($table_columns as $c){
		if(!isAdminDateItem($c['Field']) && !isKey($c['Key'])){
			$items_params_str = $items_params_str . $c["Field"] .'=:'. $c["Field"].' ,';
		}
	}

	/* 最後のカンマを削除 */
	$items_params_str = rtrim($items_params_str , ',');

	/* キー部分 */
	$key_array = array();
	foreach(getColumnList($table_name) as $c){
		if(isKey($c['Key'])){
			$key_array[$c['Field']] = $_POST[$c['Field']];
		}
	}

	$where_query = getPrimaryWhereQuery($key_array);

	try{
		$dbh->beginTransaction();
		$sql = "UPDATE ".$table_name ." SET ".$items_params_str.', update_date=now()'.$where_query;
		p("以下のSQLを実行しました。\n\n".$sql);
		$stmt = $dbh->prepare($sql);
		foreach($table_columns as $c){
			if(!isAdminDateItem($c['Field']) && !isKey($c['Key'])){
				$stmt->bindParam(":".$c["Field"], $update_array[$c["Field"]], PDO::PARAM_STR);
			}
		}
		$stmt->execute();
		$dbh->commit();
	} catch (Exception $e) {
		$dbh->rollBack();
		echo "失敗しました｡" . $e->getMessage();
	}
?>