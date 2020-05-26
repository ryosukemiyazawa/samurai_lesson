<section>
	<h2><?php p($page["contents_name"]); ?></h2>
    <?php
        $entity_name = getEntityName($page);
        $table_name = 'org_'.$entity_name; 

        $key_array = array();
        foreach(getColumnList($table_name) as $c){
            if($c['Key'] == "PRI"){
                $key_array[$c['Field']] = $_GET[$c['Field']];
            }
        }

        $entity = getEntity($table_name,$key_array);

        foreach(getColumnList($table_name) as $c){
            if(strstr($c['Type'] ,"int")){
                output_form_item($c ,"number" ,$entity);
            }else if(strstr($c['Type'] ,"varchar")){
                if(strstr($c['Field'] ,"_flg")){
                    output_form_item($c,"checkbox" ,$entity);
                }else{
                    output_form_item($c,"text" ,$entity);
                }
            }else if(strstr($c['Type'] ,"datetime")){
                output_form_item($c ,"datetime" ,$entity);
            }
        }
    ?>
    <center>
        <button type="button" class="btn btn-primary" id="send">送信</button>
    </center>

</section>

<?php
    if($entity_name == "contents"){
        $category_id = $key_array["category_id"];
        $contents_id = $key_array["contents_id"];
        // p('<a href="/admin/edit/?category_id='.$category_id.'&contents_id='.$contents_id.'">この記事を編集する</a>');
        p('<a href="/samurai_lesson/cms/admin/edit/?category_id='.$category_id.'&contents_id='.$contents_id.'">この記事を編集する</a>');
        
    }
?>

<?php //include_once($webroot."/src/parts/table_information.php"); ?>

<?php
    /* 入力パーツ出力 */
    function output_form_item($column ,$type ,$entity){
        if($column["Key"] == "PRI"){$readonly="readonly";}else{$readonly="";}
        p('<div class="form-group">');
        $defalut = $column["Default"] <> "" ? ' ('.$column["Default"].')' : "";
        p('<label>'.$column["Comment"].$defalut.' （'.$column["Type"].'）</label>');
        /* 初期化 */
        $check = "";
        $value = "";
        if(!isAdminDateItem($column['Field'])){
            $check = getCheck($column ,$type ,$entity);
            $name  = getName($column ,$type ,$entity);
            $value = getValue($column ,$type ,$entity);
            if($column["Type"] == "varchar(4000)"){
               p('<textarea class="form-control" rows="4" placeholder="'.$column["Field"].'">'.$value.'</textarea>');
            }else{
                p('<input type="'.$type.'" class="form-control" placeholder="'.$column["Field"].'" id="'.$column["Field"].'" value="'.$value.'"'.$readonly.$check.$name.'>');
            }
        }else{
            /* 管理日付項目はラベル出力 */
            p('<label style="display: block;">　'.$entity[$column["Field"]].'</label>');
        }
        p('</div>');
    }
?>
<?php //$file = "/src/common/server/server_update_logic.php"; ?>
<?php $file = "/samurai_lesson/cms/src/common/server/server_update_logic.php"; ?>
<?php //include_once($webroot."/src/common/request/cud_request.php"); ?>
<?php include_once(APP_ROOT."/src/common/request/cud_request.php"); ?>
