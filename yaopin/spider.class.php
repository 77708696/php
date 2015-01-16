<?php

//	$regp='~<a cityid.+?</li>~is';
function getlist($pagestr,$regp)
{
	preg_match_all($regp, $pagestr, $r);
	return $r;
}
function getlist0($pagestr,$regp)
{
	preg_match_all($regp, $pagestr, $r);
	return $r[0];
}


function getinfo($url,$site)
{

 
	
	$htmlView = DAQURLContentBySocket($url);
	if($site['charset']=="utf-8")
		$htmlView = mb_convert_encoding( $htmlView, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5' );  
	//	$html = iconv("UTF-8",'gb2312',$html);
		
	//echo $htmlView;
	$site_v = include 'conf/site_view.php';
	
	$siteID = $site['ID'];
	$info = $site_v[$siteID];
	$info['url'] = $url;
	$info['siteName'] = $site['siteName'];
	 
	return ($info);	
	$pic_list_db = array();
	if($pic_list){	
		foreach ($pic_list as $a)
		{
			$pic_list_db[] = doimg($a);
		}	
	}	
	print_r($pic_list_db);

}


function gethtml($url)
{
//	return file_get_contents($url);

	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, $url);  
	$r = rand(1,254);  
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:8.8.8.'.$r, 'CLIENT-IP:120.80.8.'.$r));  //构造IP  
	curl_setopt($ch, CURLOPT_REFERER, "http://ypk.39.net/");   //构造来路  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);   // 0 不输出 ， 1 输出  
	$out = curl_exec($ch);  
	curl_close($ch);  

	return $out;
	
}

function DAQURLContentBySocket($url, 
									$host="ypk.39.net", 
									$port=80, 
									$timeout=30){ 
										 
				if($host == ""){ 
					if(!($pos = strpos($url,'://'))){ 
							return false; 
						} 
				$host = substr( $url, 
				$pos+3, 
				strpos($url,'/',$pos+3) - $pos - 3); 
				$uri = substr($url,strpos($url,'/',$pos+3)); 
				} 
			else{ 
				$uri = $url; 
				} 
				$r = rand(100,199);
				$rr = rand(200,250);
				$rrr = rand(1,254);
				$rrrr = rand(1,254);
		$request = "GET ".$uri." HTTP/1.0\r\n" 
				."Host: ".$host."\r\n" 
			    ."Referer: http://ypk.39.net\r\n"
		        ."Client-IP: ".$r.".".$rr.".".$rrr.".".$rrrr."\r\n"
				."X-Forwarded-For: ".$r.".".$rr.".".$rrr.".".$rrrr."\r\n"  //主要是这里来构造IP 
				."Accept: */*\r\n" 
				."User-Agent: Mozilla/5.0\r\n" 
				."Connection: Close\r\n" 
				."\r\n\r\n"; 
				$sHnd = @fsockopen ($host, $port, $errno, $errstr, $timeout); 
				if(!$sHnd){ 
					return false; 
				} 
		@fputs ($sHnd, $request); 
		// Get source 
			$result = ""; 
		while (!feof($sHnd)){ 
			$result .= fgets($sHnd,4096); 
			} 
		fclose($sHnd); 
		$headerend = strpos($result,"\r\n\r\n"); 
		if (is_bool($headerend)) 
		{ 
			return $result; 
		} 
	else{ 
		return substr($result,$headerend+4); 
		} 
	}
/**
 * 根据规则提取一个字段
 *
 * @param string $pattern
 * @param string $content
 * @return string
 * 
 * $fildlist['title']=array('field'=>'title',
		'pattern'=>'<span class="pro_name">{title}</span></strong>',
		'rp1'=>array('中医乐活_','中国中医'),
		'rp2'=>array('|这里是中医乐活|','lehoba')
		);
	    $return['title'] = trim(getPregField($fildlist['title'],$s));

 */
function getPregField($fieldinfo,$content)
{
	/**
	 * 规则为固定值的情况,直接返回固定值
	 */
	if(strpos($fieldinfo['pattern'],'{'.$fieldinfo['field'].'}') === false)
		return $fieldinfo['pattern'];
	$pattern = preg_quote($fieldinfo['pattern']);
	$pattern = str_replace('\{'.$fieldinfo['field'].'\}','(?P<'.$fieldinfo['field'].'>.*?)',$pattern);
	$pattern = "~".$pattern."~is";
	preg_match($pattern,$content,$preg_rs);
	$fieldresult = $preg_rs[$fieldinfo['field']];
	/**
	 * 去掉换行符
	 */
	$fieldresult = preg_replace("~[\r\n]*~is",'',$fieldresult);
	/**
	 * 对采集到的结果根据规则再进行二次替换处理
	 * $sql_value = array();
	 foreach ($result as $key => $value){
	 $sql_value[] = "'".$this->addslash($value)."'";
	 }
	*/

	// $replace_arr = $fieldinfo['replace'];
	if(is_array($fieldinfo['rp1'])){
		// $replace_arr[0] = "~".$replace_arr[0]."~s";
		$arr1 = array();
		foreach ($fieldinfo['rp1'] as $key => $val)
		{
			$arr1[$key]="~".$val."~s";
		}
		$fieldresult = preg_replace($arr1,$fieldinfo['rp2'],$fieldresult);
	}

	return $fieldresult;
}


?>