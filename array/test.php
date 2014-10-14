<?php

$provideFields="contact,contactid,groupid,vcardid,cardresurl,remark";

$order = "contactaa,desc;";

$arr = array_filter (explode(';', $order) ) ;

$fieldarr = explode(',', $provideFields);

foreach ($arr as $item)
{
  list($field,$ascdesc) = explode(',', $item);
  if( !in_array($ascdesc, array('desc','asc')) || !in_array($field, $fieldarr) )
  {
      echo "fild";
  }
}



exit();

/**
 * 比较传入字段和提供字段，返回两个里面都有的字段
 *
 * @param string $fields 传入要显示的字段 该参数空的话，返回所有字段
 * @param string $provideFields 提供显示的所有字段
 * @return string
 */
public function getResultFields($fields, $provideFields)
{
    if (empty($fields)) {
        return $provideFields;
    } else {
        $fields = trim($fields, ',');
        $fields = empty($fields) ? $provideFields : $fields;
    }
    //比较两个数组，取出两个里面都有的字段
    $fieldsArr = array_intersect(explode(',', $fields), explode(',', $provideFields));
    return empty($fieldsArr) ? $provideFields : implode(',', $fieldsArr);
}

/**
 * 排序参数检测
 *
 * @param string $order 排序字段
 * @param string $provideFields 提供回显或可查询的所有字段
 * @return false|order  返回false错误 ，order  验证解析后排序字段，可安全使用
 */
public function checkOrderParam($order,$provideFields)
{
    if( strpos($order,',')===false )
        return false;
    $fieldarr = explode(',', $provideFields);
    $arr = array_filter (explode(';', $order) ) ;
    foreach ($arr as $item)
    {
        list($field,$ascdesc) = explode(',', $item);
        if( !in_array($ascdesc, array('desc','asc')) || !in_array($field, $fieldarr) )
        {
            return false;
        }
    }
    return str_replace(array(',',';'), array(' ',',') ,$order);
}

$array1 = array(1=>'a','b','c');

$array2 = array('d','b','f','c');


print_r( array_intersect( $array1, $array2 ) );