<?php
    /** ルートを取得する */
    function getRoot(){
        return $_SERVER['DOCUMENT_ROOT'];
    }

    /* URLのドメイン以降を取得する */
	function getRequestURL(){
		return $_SERVER["REQUEST_URI"];
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
        if ($dbh == null) {
            p('接続に失敗しました');
        }else{
            p('接続に成功しました');
        }
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
    
?>