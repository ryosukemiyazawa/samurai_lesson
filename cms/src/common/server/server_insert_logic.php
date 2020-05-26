<?php 
	$webroot = $_SERVER['DOCUMENT_ROOT'];
	// include_once($webroot."/src/common/setup.php");
	include_once($webroot."/samurai_lesson/cms/src/common/setup.php");

	header("Content-type: text/plain; charset=UTF-8");

	$table_name = $_POST['table_name'];
	$table_columns = getColumnList($table_name);
	$insert_array = array();

	/* 入力された内容を連想配列に保持 */
	foreach($table_columns as $c){
		if(!isAdminDateItem($c['Field'])){
			/* checkboxのチェック対策（脆弱だ・・・） */
			$insert_array[$c["Field"]] = $_POST[$c["Field"]] <> "undefined" ? $_POST[$c["Field"]]: NULL;
		}
	}

	/* query生成用 */
	$items_str = " ";
	$params_str = " ";
	foreach($table_columns as $c){
		if(!isAdminDateItem($c['Field'])){
			$items_str = $items_str . $c["Field"] .',';
			$params_str = $params_str .':'. $c["Field"] .',';
		}
	}

	/* 最後のカンマを削除 */
	$items_str = rtrim($items_str , ',');
	$params_str = rtrim($params_str , ',');

	try{
		$dbh->beginTransaction();
		$sql = "INSERT INTO ".$table_name ."(".$items_str .")VALUES(".$params_str.");";
		p("以下のSQLを実行します。\n\n".$sql);
		$stmt = $dbh->prepare($sql);
		foreach($table_columns as $c){
			if(!isAdminDateItem($c['Field'])){
				$stmt->bindParam(":".$c["Field"], $insert_array[$c["Field"]], PDO::PARAM_STR);
			}
		}
		$stmt->execute();
		$dbh->commit();
	} catch (Exception $e) {
		$dbh->rollBack();
		echo "; 失敗しました｡; " . $e->getMessage();
	}
?>