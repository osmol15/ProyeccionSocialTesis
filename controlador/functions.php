<?

function cambiar()

{

return "onfocus='cambiar(this,1);' onblur='cambiar(this,0);'";

}

	function encriptar($texto){

		$cadena = $texto;

		$texto="";

		$largo=strlen($cadena);

		$o="";

		$r="";

		$re="";

		$res="";

		$resu="";

		$resul="";

		$result="";

		$resulta="";

		$resultad="";

		$i=0;

		$dato=0;

		for($i=0;$i<$largo;$i++){

			$dato=ord(substr($cadena, $i, 1));

			$dato *= 2; 

		   	$o = decoct($dato);

			$r=str_replace("0", "Á", $o);

			$re=str_replace("1", "Â", $r);

			$res=str_replace("2", "Ã", $re);

			$resu=str_replace("3", "Ä", $res);

			$resul=str_replace("4", "Å", $resu);

			$result=str_replace("5", "Æ", $resul);

			$resulta=str_replace("6", "A", $result);

			$resultad=str_replace("7", "À", $resulta);

			$texto .= $resultad;

		}

		return trim($texto);

	}

	

	function desencriptar($texto){

		$cadena=$texto;

		$largo=strlen($cadena);

		$texto="";

		$n=0;

		$m=0;

		$a=0;

		$o=0;

		$i=0;

		$r="";

		$re="";

		$res="";

		$resu="";

		$resul="";

		$result="";

		$resulta="";

		$resultad="";

		$dato=0;

		$resultad=str_replace("À", "7", $cadena);

		$resulta=str_replace("A", "6", $resultad);

		$result=str_replace("Æ", "5", $resulta);

		$resul=str_replace("Å", "4", $result);

		$resu=str_replace("Ä", "3", $resul);

		$res=str_replace("Ã", "2", $resu);

		$re=str_replace("Â", "1", $res);

		$r=str_replace("Á", "0", $re);

		for($i=0;$i<$largo;$i++){

			$m=$i % 3;

			if($m==0){

				$a=(substr($r, $i, 1)*64)+(substr($r, $i+1, 1)*8)+(substr($r, $i+2, 1));

				$a/=2;

				$o=chr($a);

				$texto.=$o;

				$n++;

			}

		}

		return trim($texto);

	}

	

	function comprobar_email($email){

		$mail_correcto = 0;

		//compruebo unas cosas primeras

		if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){

		   if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {

			  //miro si tiene caracter .

			  if (substr_count($email,".")>= 1){

				 //obtengo la terminacion del dominio

				 $term_dom = substr(strrchr ($email, '.'),1);

				 //compruebo que la terminación del dominio sea correcta

				 if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){

					//compruebo que lo de antes del dominio sea correcto

					$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);

					$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);

					if ($caracter_ult != "@" && $caracter_ult != "."){

					   $mail_correcto = 1;

					}

				 }

			  }

		   }

		}

		if ($mail_correcto)

		   return "si";

		else

		   return "no";

	}

	

function changeSize($anchura, $ruta, $destino){

	list($ancho, $altura, $tipo, $atr)=getimagesize($ruta);

	$an=$ancho;

	$alt=$altura;

	$an=$anchura;

	$alt=($alt/$ancho)*$anchura;

	$alt=round($alt);

	$source=$ruta; // archivo de origen

	$dest=$destino; // archivo de destino

	$width_d=$an; // ancho de salida

	$height_d=$alt; // alto de salida

	list($width_s, $height_s, $type, $attr) = getimagesize($source, $info2); // obtengo información del archivo

	$gd_s = imagecreatefromjpeg($source); // crea el recurso gd para el origen

	$gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida

	// desactivo el procesamiento automatico de alpha

	imagealphablending($gd_d, false);

	// hago que el alpha original se grabe en el archivo destino

	imagesavealpha($gd_d, true);

	imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona

	imagejpeg($gd_d, $dest); // graba

	// Se liberan recursos

	imagedestroy($gd_s);

	imagedestroy($gd_d);

}



function htmlcaracteres($contenido){

	$contenido=ereg_replace("Á","&Aacute;",$contenido);

	$contenido=ereg_replace("É","&Eacute;",$contenido);

	$contenido=ereg_replace("Í","&Iacute;",$contenido);

	$contenido=ereg_replace("Ó","&Oacute;",$contenido);

	$contenido=ereg_replace("Ú","&Uacute;",$contenido);

	$contenido=ereg_replace("á","&aacute;",$contenido);

	$contenido=ereg_replace("é","&eacute;",$contenido);

	$contenido=ereg_replace("í","&iacute;",$contenido);

	$contenido=ereg_replace("ó","&oacute;",$contenido);

	$contenido=ereg_replace("ú","&uacute;",$contenido);

	$contenido=ereg_replace("ñ","&ntilde;",$contenido);

	$contenido=ereg_replace("Ñ","&Ntilde;",$contenido);

      

	return $contenido;

}



function redondear($valor)

{

	$vredondo=round($valor*100)/100;

	$vr=number_format($vredondo,2,".",",");

	return $vr;

	

}



function cusr(){

$n=3;

global $DATA;

$sql="select count(idUsuario) as n from usuarios";

$rs=$DATA->Execute($sql);

$rs->MoveLast();

if($rs->fields['n'] >= $n){

$x=1;

}else{

$x=0;

}

return $x;

}



function getName($user){

global $DATA;

$sql="SELECT nombre FROM usuarios WHERE usuario=?";

$rs=$DATA->Execute($sql,$user);

$rs->MoveLast();

return $rs->fields['nombre'];

}



function getNombreMedico(){

global $DATA;

$sql="SELECT medico FROM datos_empresa";

$rs=$DATA->Execute($sql);

$rs->MoveLast();

echo $rs->fields['medico'];

}

//By William
function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}

//Funcion para crear algoritmos aleatorios
//Valor a enviar: cantidad de caracteres
function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
$source = 'abcdefghijklmnopqrstuvwxyz';
if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
if($n==1) $source .= '1234567890';
if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
if($length>0){
$rstr = "";
$source = str_split($source,1);
for($i=1; $i<=$length; $i++){
mt_srand((double)microtime() * 1000000);
$num = mt_rand(1,count($source));
$rstr .= $source[$num-1];
}

}
return $rstr;
}

//calcular edad actual
function edad_actual($fecha_nacimiento, $fecha_control) 
{ 
   $fecha_actual = $fecha_control; 
    
   if(!strlen($fecha_actual)) 
   { 
      $fecha_actual = date('d/m/Y'); 
   } 
 
   // separamos en partes las fechas  
   $array_nacimiento = explode ( "/", $fecha_nacimiento );  
   $array_actual = explode ( "/", $fecha_actual );  
 
   $anos =  $array_actual[2] - $array_nacimiento[2]; // calculamos años  
   $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses  
   $dias =  $array_actual[0] - $array_nacimiento[0]; // calculamos días  
 
   //ajuste de posible negativo en $días  
   if ($dias < 0)  
   {  
      --$meses;  
 
      //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual  
      switch ($array_actual[1]) {  
         case 1:  
            $dias_mes_anterior=31; 
            break;  
         case 2:      
            $dias_mes_anterior=31; 
            break;  
         case 3:   
            if (bisiesto($array_actual[2]))  
            {  
               $dias_mes_anterior=29; 
               break;  
            }  
            else  
            {  
               $dias_mes_anterior=28; 
               break;  
            }  
         case 4: 
            $dias_mes_anterior=31; 
            break;  
         case 5: 
            $dias_mes_anterior=30; 
            break;  
         case 6: 
            $dias_mes_anterior=31; 
            break;  
         case 7: 
            $dias_mes_anterior=30; 
            break;  
         case 8: 
            $dias_mes_anterior=31; 
            break;  
         case 9: 
            $dias_mes_anterior=31; 
            break;  
         case 10: 
            $dias_mes_anterior=30; 
            break;  
         case 11: 
            $dias_mes_anterior=31; 
            break;  
         case 12: 
            $dias_mes_anterior=30; 
            break;  
      }  
 
      $dias=$dias + $dias_mes_anterior; 
 
      if ($dias < 0) 
      { 
         --$meses; 
         if($dias == -1) 
         { 
            $dias = 30; 
         } 
         if($dias == -2) 
         { 
            $dias = 29; 
         } 
      } 
   } 
 
   //ajuste de posible negativo en $meses  
   if ($meses < 0)  
   {  
      --$anos;  
      $meses=$meses + 12;  
   } 
 
   $tiempo[0] = $anos; 
   $tiempo[1] = $meses; 
   $tiempo[2] = $dias; 
 
   return $tiempo; 
} 
 
function bisiesto($anio_actual){  
   $bisiesto=false;  
   //probamos si el mes de febrero del año actual tiene 29 días  
     if (checkdate(2,29,$anio_actual))  
     {  
      $bisiesto=true;  
   }  
   return $bisiesto;  
}

//Recortar Tetxo a partir de una cadena
//Envia la cadena y el tamano
function recortar_texto($texto, $limite=100){   
    $texto = trim($texto);
    $texto = strip_tags($texto);
    $tamano = strlen($texto);
    $resultado = '';
    if($tamano <= $limite){
        return $texto;
    }else{
        $texto = substr($texto, 0, $limite);
        $palabras = explode(' ', $texto);
        $resultado = implode(' ', $palabras);
        $resultado .= '...';
    }   
    return $resultado;
}

function redondeado ($numero, $decimales) { 
   $factor = pow(10, $decimales); 
   return (round($numero*$factor)/$factor); }
?>