<section>
	<h2><?php p($page["contents_name"]); ?></h2>
    <?php
        $entity_name = getEntityName($page);
        $table_name = 'org_'.$entity_name; 
        p('<a href="/admin/">管理トップへ</a>');
        p('　　<a href="/admin/'.$entity_name.'/create/">新規登録はこちら</a>');
        
    ?>
    <table class="table table-hover" style="font-size:0.8rem">
        <thead>
            <tr style="font-size: 0.5rem;">
                <th>更新</th>
                <th>削除</th>
    <?php
        //$property = getProperty($entity_name.'_head_items');
        //$head_item_array = explode(",", $property["value"]);
        foreach(getColumnList($table_name) as $c){
            //if(in_array($c['Field'], $head_item_array)){
                p('<th>'.$c['Comment'].'</th>');
            //}
        }
    ?>
            </tr>
        </thead>
        <tbody>
    <?php
        foreach(getEntityList($table_name) as $q){
            p('<tr>');
            $key_parameter = getKeyParameter($table_name,$q);
            p('<td><a href="/admin/'.$entity_name.'/update/'.$key_parameter.'">更新</a></td>');
            p('<td><a href="/admin/'.$entity_name.'/delete/'.$key_parameter.'">削除</a></td>');
            foreach(getColumnList($table_name) as $c){

                //if(in_array($c['Field'], $head_item_array)){
                    if($c['Field'] <> 'memo'){
                        p('<td>'.getTrimString($q[$c['Field']],10).'</td>');
                    }else{
                        p('<td>'.$q[$c['Field']].'</td>');
                    }
                //}
            }
			p('</tr>');
		}
	?>
        </tbody>
    </table>
</section>

<?php
    /* KEY情報のURLパラメータ文字列を取得する。 */
    function getKeyParameter($table_name ,$entity){
        $key_parameter = '';
        foreach(getColumnList($table_name) as $c){
            if($key_parameter == ""){
                $key_parameter = "?";
            }
            if($c['Key'] == "PRI"){
                if(strstr($key_parameter,"=")){
                    $key_parameter = $key_parameter.'&';
                }
                $item_name = $c['Field'];
                $key_parameter = $key_parameter.$item_name.'='.$entity[$item_name];
            }
        }
        return $key_parameter;
    }
?>