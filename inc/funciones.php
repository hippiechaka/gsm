<?php
/*****TIEMPO DURACION SESSIONES*****/
//ini_set('session.cache_expire',30);

///////VALORES PARA CAJAS DE LISTADOS//////////////
$ancho		=	700;
$alto		=	242;
$orden		=	"ASC";
$titulo		=	"";
$registro	=	11;
$cond		=	"";
$valor		=	"";

$listar		=	false;
$mostrar	=	false;
$modificar	=	false;
$editar		=	false;
$nuevo		=	false;
$charset	=	"utf8";
$funciones_cargadas=1;

////////////////////////////////////////////////
@$url		=	"admin.php?seccion=".$_GET['seccion'];	

$meses		=	array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');	
$months		=	array('','January','February','March','April','May','June','July','August','September','October','November','December');	

function check_apc_cache($sql){
	if(CACHE_ENABLED){
		if (apc_exists($sql) && CACHE_ENABLED) {
			$data = apc_fetch($sql);
		}else{
			$rs = mysql_query($sql)or die($sql);
			if(mysql_num_rows($rs)>1){
				while ($row = mysql_fetch_assoc($rs)) {
					$data[]=$row;
				}
			}else{
				if(mysql_num_rows($rs)>0){
					$data[] = mysql_fetch_array($rs);
				}else{
					$data[] = NULL;
				}
			}
			apc_store($sql,$data,86400);
			
		}		
	}else{
			$rs = mysql_query($sql)or die($sql);
			if(mysql_num_rows($rs)>1){
				while ($row = mysql_fetch_assoc($rs)) {
					$data[]=$row;
				}
			}else{
				if(mysql_num_rows($rs)>0){
					$data[] = mysql_fetch_array($rs);
				}else{
					$data[] = NULL;
				}
			}
	}
	return $data;
}


function ext($archivo) 
{
	$trozos = explode("." , strtolower($archivo));
	$ext = $trozos[ count($trozos) - 1];
	return (string) $ext;
}
		
function cebra($numero,$c_fondo,$c_over)
{
	if(bcmod($numero,2) == 0 )  return $bgcolor = ' background-color:#'.$c_over.' ';
	else  return $bgcolor = '  background-color:#'.$c_fondo.' ';
}

function fecha($fecha,$formato)
{
	$meses		=	array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre',
				 'Octubre','Noviembre','Diciembre');
	switch($formato)
	{
		case 0:
			return preg_replace( "/^\s*([0-9]{1,4})[\/\. -]+([0-9]{1,2})[\/\. -]+([0-9]{1,2})/" , "\\3/\\2/\\1" ,$fecha);
			break;
		case 1:
			return preg_replace( "/^\s*([0-9]{1,2})[\/\. -]+([0-9]{1,2})[\/\. -]+([0-9]{1,4})/" , "\\3-\\2-\\1" ,$fecha); 
			break;
		case 3:
			$fecha	=	explode('-',$fecha);
			$mes	=	$fecha[1];
			$mes	=	explode('0',$mes);
			if(empty($mes[0]))
				$mes1	=	$mes[1];
			else
				$mes1		=	$fecha[1];
				return		$fecha[2].' de '.$meses[$mes1].' de '.$fecha[0];
			break;
		case 4:
			$fecha	=	explode('-',$fecha);
			return		$fecha[2].'/'.$fecha[1].'/'.$fecha[0];  ///formato datepicker
			break;
			
	}
}

function listarArchivos($dir) {
	$files	=	array();
	
	$dir		=	'images/galerias/georgex';
	$directorio	=	opendir($dir); 
	
	while ($archivo = readdir($directorio)) { 
		if (strlen($archivo)>3) {
			$files	=	$dir."/".$archivo;
		} 
	} closedir($directorio); 
	return $files;
}

function video_dir($categoria)
{    
	$videodir = "../../videos/$categoria/";
	return $videodir;
}	
function niceURL($string)
{
	/***** Special Characters *****/
	$no_sc			=	array('?','!','¿','¡','´',"'",'.','@',':',',',';','º','&','%','"','(',')','{','}','[',']','/','\\');	
	$vali_sc		=	array('' ,'' ,'' ,'' ,'' ,"" ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'','','');

	$url		=	strtolower( str_replace( $no_sc,$vali_sc,utf8_decode($string)));

	/***** ABC *****/
	$no_abc		=	array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
	$vali_abc	=	array('a','e','i','o','u','n','a','e','i','o','u','n');

	$url		=	strtolower( str_replace( $no_abc,$vali_abc,$url));

	/***** blank space *****/
	$no_abc		=	array(' ');
	$vali_abc	=	array('-');

	$url		=	strtolower( str_replace( $no_abc,$vali_abc,trim($url)));
	
	$url = substr($url,0,50);
	$url = preg_replace("/[^0-9a-zA-Z-_]/", "", $url);
	return $url;
} 	
function photoNota($string)
{
	$no_vali	=	array('á','é','í','ó','ú','ñ','?','!','¿','¡',' ','Á','É','Í','Ó','Ú','Ñ','´',"'",'.','@',':',',',';','º','&','%','"','(',')','{','}','[',']');	
	$vali		=	array('a','e','i','o','u','n','' ,'' ,'' ,'' ,'_','a','e','i','o','u','n','' ,"" ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'');
	return strtolower( str_replace( $no_vali,$vali,utf8_decode($string) ) );
} 
function description($descripcion, $tamano=150)
{
	$descripcion	=	strip_tags($descripcion);
	$descripcion	=	trim($descripcion);
	$descripcion	=	substr($descripcion,0,$tamano);
	$descripcion	=	str_replace('"',"'",$descripcion);
	$descripcion	=	html_entity_decode($descripcion);
	$descripcion	=	utf8_encode($descripcion);
	$descripcion	=	$descripcion.'...';
	return $descripcion;
}

function description2($descripcion, $tamano=150)
{
	$descripcion	=	strip_tags($descripcion);
	$descripcion	=	trim($descripcion);
	$descripcion	=	substr($descripcion,0,$tamano);
	$descripcion	=	str_replace('"',"'",$descripcion);
	$descripcion	=	html_entity_decode($descripcion);
	return $descripcion;
}

function overlay() {
	$over	=	"<div class=\"overlay\" id=\"overlay\"> ";
   	$over	.=	"	<div class=\"wrap\"></div>";
	$over	.=	"</div>";
	
	return $over;
}

	 function cadenaAleatoria($longitud)
	 {
		$keychars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		// RANDOM KEY GENERATOR
		$randkey = "";
		$max=strlen($keychars)-1;
		for ($i=0;$i<$longitud;$i++) 
			$randkey .= substr($keychars, rand(0	, $max), 1);
		return $randkey;	
	 }
function outSession(){
	@session_unset();
	@session_destroy();
	sleep(4);
	echo '{ "aceptar" : "no"}';
	@ob_end_flush();	
}


function debug(){
	error_reporting(E_ALL);				//reporte de errores
	ini_set('display_errors', 'on');		//reporte de errores
	error_reporting(1);
}

function creaselect($nombre,$tabla,$id_tabla="id",$orden="",$seleccionado=0,$campomostrar="",$funcionjavascript="",$tipodeconsuta="tabla",$titulovacio=""){ 
	if ($tipodeconsuta=="query"){
		$sqlt=$tabla;
	} else {
		if ($campomostrar==""){
			$result = mysql_query("DESCRIBE ".$tabla);
			$datades = @mysql_fetch_row($result); 
			$datades = @mysql_fetch_row($result); 
			$campomostrar=$datades[0];
		}
		$sqlt="SELECT * FROM ".$tabla." ";
		if (strlen($orden)>1)
			$sqlt.=" ORDER BY ".$orden;
	}
	$rest=mysql_query($sqlt);
	if (!$rest) {
		die('Invalid query: ' . mysql_error());
	}
	echo '<select name="'.$nombre.'"  id="'.$nombre.'" '.(($funcionjavascript!="")?'onchange="'.$funcionjavascript.'"':'').'>';
	if ($titulovacio!="")
		echo '<option value="">'.$titulovacio.'</option>';
	while($datot=@mysql_fetch_assoc($rest)){
		echo '<option value="'.str_replace('"','',$datot[$id_tabla]).'"';
		if ($datot[$id_tabla]==$seleccionado)
			echo ' selected="selected" ';
		/********************************************************************************/
		// Por defaul se muestra $campomostrar (si es diferente a vacio) sino se busca el segundo campo de la tabla y se muestra
		if($campomostrar=="")
			echo '>'.$datot[$datades[1]].'</option>';
		else
			echo '>'.$datot[$campomostrar].'</option>';
	}
	echo '</select>';
}

function displaymes($numero)
{
	$meses		=	array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	if ($numero>0 && $numero<13) return $meses[$numero];
	else return false;
}

	function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}


	function snippetwop($text,$length=64,$tail="...") {
		$text = trim($text);
		$txtl = strlen($text);
		if($txtl > $length) {
			for($i=1;$text[$length-$i]!=" ";$i++) {
				if($i == $length) {
					return substr($text,0,$length) . $tail;
				}
			}
			for(;$text[$length-$i]=="," || $text[$length-$i]=="." || $text[$length-$i]==" ";$i++) {;}
			$text = substr($text,0,$length-$i+1) . $tail;
		}
		return $text;
	}	



function search_processing($search_string, $fields){
	$search_string = " ".strtoupper(str_replace("\'", "'", $search_string))." ";
	$wordstoquit = "THE HE SHE OF IT FOR THEM AND IN YOU NO. NUM. TO BY";
	$charstoquit = "' . ".'"'." { } [ ] , @ - + / $ % # & ? ! ¡ ¿ < > ¨ ^ ` ¬ | ";
	$arrtoquit = explode(" ", $wordstoquit);
	$arrchartoquit = explode(" ", $charstoquit);
	for($i=0; $i<count($arrtoquit); $i++){
		if(strpos($arrtoquit[$i],"'")>0){
			$search_string = str_replace(" ".$arrtoquit[$i], " ", $search_string);		
		}else{
			$search_string = str_replace(" ".$arrtoquit[$i]." ", " ", $search_string);
		}
	}
	for($i=0; $i<count($arrchartoquit); $i++){
		$search_string = str_replace($arrchartoquit[$i], "", $search_string);
	}	
	$array_result = explode(" ", substr($search_string, 1, strlen($search_string)-1));
	$array_length=count($array_result);
	$cad_last="";
	for($i=0; $i<$array_length; $i++){
		if($array_result[$i]<>" " and $array_result[$i]<>"" and $array_result[$i]<>"*"){
			$cad_last.=$array_result[$i]." ";
		}
	}
	$array_search = explode(" ", trim($cad_last));
	$contcads="";
	$where ="";
	if(count($array_search)>0){
		for($i=0; $i<(count($array_search)); $i++){
			for($j=0; $j<(count($fields)); $j++){
				$contcads .= ' or '. field_likes($fields[$j] , $array_search[$i]);
			}
		}// for
		$where .= "(".substr($contcads,4).")";
	}else{
		$search="";			
	}// if	
	return $where;
}

function field_likes($field, $cad){
	if(strpos($cad,"*")>-1){
		$like_cad = " $field LIKE '%".str_replace("*","%", $cad)."%' ";	
	}else{
		$like_cad = " $field REGEXP  '[[:<:]]".$cad."[[:>:]]' ";
	}
	return $like_cad;
}


function toArray($string, $leftDelimiter, $rightDelimiter){
	$tempArray = array();
/*	while(strpos($string,$rightDelimiter)>-1){
		echo("Pos:".strpos($string,$rightDelimiter)."<br>");
		$string_temp = substr($string, strpos($string,$leftDelimiter)+strlen($leftDelimiter), strpos($string,$rightDelimiter)-strpos($string,$leftDelimiter)-strlen($leftDelimiter));
		echo("Str Temp:".$string_temp ."<br>");
		$string = substr($string, strpos($string,$rightDelimiter)+strlen($rightDelimiter));
		echo("STR:".$string ."<br>");
		array_push($tempArray, $string_temp);
	}*/
	if($leftDelimiter != $rightDelimiter){
		$tempArray = explode($rightDelimiter, $string);
		unset($tempArray[count($tempArray)-1]);
		for($i=0; $i<count($tempArray); $i++){
			$tempArray[$i] = str_replace($leftDelimiter, '', $tempArray[$i]);
		}
	}else{
		$tempArray2 = explode($rightDelimiter, $string);
		unset($tempArray2[count($tempArray2)-1]);
		$j=0;
		for($i=0; $i<count($tempArray2); $i++){
			if($j==1){
				array_push($tempArray, $tempArray2[$i]);
				$j=-1;				
			}
			$j++;
		}
	}
	return $tempArray;
}


function datetime_format($datetime){
	$months_short	= array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");		
	$date 			= substr($datetime, 0, strpos($datetime, ' '));
	$arr_date		= explode("-", $date);
	$date 			= $arr_date[2]."/".$months_short[1 * $arr_date[1]]."/".$arr_date[0];

	$time 			= substr($datetime, strpos($datetime, ' ')+1);
	$arr_time 		= explode(":", $time);
	$time_mer		= "AM";
	if($arr_time[0]>12){
		$time_mer		= "PM";
		$arr_time[0]	= $arr_time[0]-12;
	}
	$time 			= $arr_time[0].":".$arr_time[1]." ".$time_mer;
	return($date." ".$time);
}

function format_time($time, $format = 0){
	if($format){
		$arr_time 		= explode(":", $time);
		$time_mer		= "am";
		if($arr_time[0]>12){
			$time_mer		= "pm";
			$arr_time[0]	= $arr_time[0]-12;
		}
		$cad_time 			= $arr_time[0].":".$arr_time[1].$time_mer;
	}else{
		$arr_time	= explode(":", $time);
		$cad_time 	= "";
		if($arr_time[0]<>"00"){
			$cad_time .= $arr_time[0]." HRS ";
		}
		if($arr_time[1]<>"00"){
			$cad_time .= $arr_time[1]." MIN ";
		}
		if($arr_time[2]<>"00"){
			$cad_time .= $arr_time[2]." SEG";
		}
	}
	return($cad_time);
}

function linkifyYouTubeURLs($text) {
		$text = preg_replace('~
			https?://         # Required scheme. Either http or https.
			(?:[0-9A-Z-]+\.)? # Optional subdomain.
			(?:               # Group host alternatives.
			  youtu\.be/      # Either youtu.be,
			| youtube\.com    # or youtube.com followed by
			  \S*             # Allow anything up to VIDEO_ID,
			  [^\w\-\s]       # but char before ID is non-ID char.
			)                 # End host alternatives.
			([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
			(?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
			(?!               # Assert URL is not pre-linked.
			  [?=&+%\w]*      # Allow URL (query) remainder.
			  (?:             # Group pre-linked alternatives.
				[\'"][^<>]*>  # Either inside a start tag,
			  | </a>          # or inside <a> element text contents.
			  )               # End recognized pre-linked alts.
			)                 # End negative lookahead assertion.
			[?=&+%\w]*        # Consume any URL (query) remainder.
			~ix', 
			'$1',
			$text);
		return $text;
	}

function token($field="",$table=""){
	return md5("OPR$".$_SESSION['id_admin']."%".$field."%".$table."%");
}

function GetIP()
	{
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
		{
			if (array_key_exists($key, $_SERVER) === true)
			{
				foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip)
				{
					if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
					{
						return $ip;
					}
				}
			}
		}
	}

?>
