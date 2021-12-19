<?php
if(!function_exists("showCat")){
    function showCat($cats,$parentID=0,$catSelected=null,$char=""){
        foreach($cats as $index => $cat){
            if($cat["parent_id"]==$parentID){
                unset($cats[$index]);
                echo "<option value='".$cat['module_id']."' ".($catSelected==$cat["module_id"] ? 'selected' :'').">
                    ".$char." ".$cat['module_title'].
                "</option>";
                showCat($cats,$cat["module_id"],$catSelected,$char."-");
            }
        }
    }
}



if(!function_exists("convertCat")){
    function convertCat($cats,$catParent=0,$char="",$level=1){
        $result=[];
        foreach($cats as $index=>$cat){
            if($cat["parent_id"]==$catParent){
                $cat["level"]=$char;
                $result[]=$cat;
                unset($cats[$index]);
                $child=convertCat($cats,$cat["module_id"],$char."-",$level);
                $result=array_merge($result,$child);
            }
        }
        return $result;
    }
}
