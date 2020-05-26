<?php
    /** ルートを取得する */
    function getRoot(){
        return $_SERVER['DOCUMENT_ROOT'];
    }

    /* URLのドメイン以降を取得する */
	function getRequestURL(){
		return $_SERVER["REQUEST_URI"];
    }

    function getAppRequestURL(){
         $url = str_replace(_APP_PATH_, "", getRequestURL());
         if($url[strlen($url)-1] !="/"){
             $url .= "/";
         }
         return $url;
    }

	/* DBの接続オブジェクトを取得します。 */
	function getDbh(){
        $dsn='mysql:dbname=test;port=8889;host=127.0.0.1';
        // $dsn='mysql:dbname=test;host=127.0.0.1';
        $user='root';
        $pass='root';
    try{
        // $dbh = new PDO($dsn,$user,$pass);
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        // if ($dbh == null) {
        //     p('接続に失敗しました');
        // }else{
        //     p('接続に成功しました');
        // }
        $dbh->query('SET NAMES utf8');
    }catch(PDOException $e){
        p('Error:'.$e->getMessage());
        p('データベースへの接続に失敗しました。');
        die();
    }
    return $dbh;
    }
    
    /* print関数の略 */
   function p($str){
	print $str;
   }

    /* 詳細なコンテンツリストを取得する */
    function getDetailContentsList($category = NULL, $disabled = true, $day_sort_flg = false, $archive = NULL, $limit = NULL){
        if(isset($category)){
            $category_query = " AND category.category_id = ".$category;
        }else{
            $category_query = "";
        }

        if($disabled){
            $disabled_query = " AND contents.disabled_flg is null ";
        }else{
            $disabled_query = "";
        }

        if($day_sort_flg){
            $order_by_query = "ORDER BY contents.create_date DESC";
        }else{
            $order_by_query = "";
        }
    
        if(isset($archive)){
            $archive_query = " AND DATE_FORMAT(contents.create_date, '%Y%m') = '".$archive."'";
        }else{
            $archive_query = "";
        }

        if(isset($limit)){
            $limit_query = " LIMIT ".$limit;
        }else{
            $limit_query = "";
        }

        $sql="
        SELECT ".getContentsSelectItemsQuery()."
          FROM org_category category,
               org_contents contents
         WHERE category.category_id = contents.category_id
           AND category.category_id > 1
           AND contents.contents_id <> 0".$category_query.$disabled_query.$archive_query.$order_by_query.$limit_query;
            /* カテゴリIDの1以下は管理系項目の為 */
         $stmt = getDbh()->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetchAll();
         return $result;
    }

    /** 詳細なコンテンツ情報を取得するSQLのSELECT句を返す */
   function getContentsSelectItemsQuery(){
    return "category.category_id category_id,
    contents.contents_id contents_id,
    category.name category_name,
    contents.name contents_name,
    contents.name name,
    category.url category_url,
    contents.url contents_url,
    CONCAT(IFNULL(category.url, \"\"), IFNULL(contents.url, \"\"))AS url,
    contents.create_date,
    contents.update_date,
    contents.disabled_flg";
    }

    /* カテゴリリストを取得する */
   function getCategoryList($exclusion_id = NULL){
	if(isset($exclusion_id)){
        $exclusion_query = " AND category_id <> ".$exclusion_id;
    }else{
        $exclusion_query = "";
    }
	/** 管理系は常に除外（<> 0） */
	$sql="SELECT * FROM org_category WHERE 1 and category_id <> 0".$exclusion_query;
	$stmt = getDbh()->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
   }

    /* アーカイブリストを取得する */
    function getArchiveList(){
        $sql="
        SELECT DATE_FORMAT(contents.create_date, '%Y/%m') AS date,
            CONCAT('/archive',DATE_FORMAT(contents.create_date, '/%Y%m/')) AS url,
            count(*) AS count
        FROM org_category category,
            org_contents contents
        WHERE category.category_id = contents.category_id
        AND category.category_id > 1
        AND contents.contents_id <> 0
        AND contents.disabled_flg is null
        GROUP BY DATE_FORMAT(contents.create_date, '%Y/%m'), url
        ORDER BY date DESC";
        $stmt = getDbh()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /* テーブルを全て取得する */
    function getTableList(){
        $sql = "SHOW TABLE STATUS LIKE 'org%'";
        $stmt = getDbh()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ページ情報を取得する */
    function getPageInformation(){
        $sql="
        SELECT ".getContentsSelectItemsQuery()."
        FROM org_category category left outer join
            org_contents contents on category.category_id = contents.category_id
        WHERE CONCAT(IFNULL(category.url, \"\"), IFNULL(contents.url, \"\")) LIKE :url";

        $stmt = getDbh()->prepare($sql);
        $url = getSmartRequest();
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result === false){ return []; }
        return $result;
    }

    /* 整形されたURLのドメイン以降を取得する */
	function getSmartRequest(){
		$request = getAppRequestURL();
        $request = str_replace("index.html","",$request);
        
        //admin
		if(strpos($request,'?')){
			$request = strchr($request,'?',true);
		}
		return $request;
    }
    

    /* ページ情報からエンティティ名を取得する。主に管理ページで使用 */
	function getEntityName($page){
		return strchr($page["contents_url"],'/',true);
    }
    

    /* テーブルの列情報を全て取得する */
	function getColumnList($table_name){
		$sql = "SHOW FULL COLUMNS FROM ".$table_name;
		$stmt = getDbh()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }
    

    /* テーブルの保持する情報を全て取得する */
	function getEntityList($table_name){
		$sql = "SELECT * FROM ".$table_name;
		$stmt = getDbh()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
    }
    

    /* 指定された文字数以上なら３点リーダをつけて返す */
	function getTrimString($string, $trimLength){
		$count = mb_strlen($string);
		$string = mb_substr($string ,0 ,$trimLength);
		if($count > $trimLength){ $string = $string.'...'; }
		return $string;
    }
    

    /* 登録日か更新日かを返す（登録時formに表示させない目的で使用） */
    function isAdminDateItem($target){
        return strstr($target,'create_date') || strstr($target,'update_date');
    }


    /* 指定されたテーブルおよびキーに該当するエンティティを取得する */
	function getEntity($table_name,$key_array){
		$where_query = getPrimaryWhereQuery($key_array);
		$sql = "SELECT * FROM ".$table_name.$where_query;
		$stmt = getDbh()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
    }
    

    /* キー情報のみの連想配列からWHERE句を取得する */
	function getPrimaryWhereQuery($key_array){
		$where_query = "";
		foreach($key_array as $key => $item){
			if($where_query == ""){
				$where_query = " WHERE ";
			}else{
				$where_query = $where_query." AND ";
			}
			$where_query = $where_query .$key .'="'.$item.'"';
		}
		return $where_query;
    }
    

    /* typeが「checkbox」でかつ値が「1」なら "checked" を返す */
	function getCheck($column ,$type ,$entity){
		$check = "";
		if($type == "checkbox"){
			if($entity[$column["Field"]] == 1){
				$check = " checked ";
			}else{
				$check = "";
			}
		}
		return $check;
    }
    

    /* typeが「checkbox」ならname属性を。それ以外なら空文字を返す */
	function getName($column ,$type ,$entity){
		if($type == "checkbox"){
			$name = 'name="'.$column["Field"].'"';
		}else{
			$name = '';
		}
		return $name;
    }
    

    /* typeが「checkbox」なら1を。それ以外なら正規の値を返す */
	function getValue($column ,$type ,$entity){
		if($type == "checkbox"){
			$value = '1';
		}else{
			$value = $entity[$column["Field"]];
		}
		return $value;
    }
    

    /* キーかどうかを返す */
	function isKey($target){
		return $target == "PRI";
    }

    /** 公開対象のカテゴリかどうかを返す */
    function isPublicCategory($contents){
        // return $contents['category_id'] > 1 && $contents['contents_id'] == 0;
        return isset($contents['category_id']) ? $contents['category_id'] > 1 && $contents['contents_id'] == 0 : false;
    }
?>