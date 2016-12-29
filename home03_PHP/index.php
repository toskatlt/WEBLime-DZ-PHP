<?php
header("Content-Type: text/html; charset=utf-8");
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

error_reporting(E_ALL);
ini_set('log_errors', "On");
ini_set('display_errors', "Off");
ini_set('error_log','error.log');


echo "<head><title>Домашнее задание 3 [PHP]</title></head>";

function division ($a, $b){
	if ((is_numeric($a)) and (is_numeric($b))) {
		$c = $a/$b;
		$c = number_format($c, 2, '.', '');
		return $c;
	}
	else {
		return false;
	}
}
function is_prime ($x) {
    for($s=2; $s <= sqrt($x); $s++) {
        if($x % $s == 0) {
            return false;
        }
    }
    return true;
}
function array_prime ($x) {
	$array = range(2,$x);
	foreach($array as $y) {
		$is_prime = is_prime ($y);
		if ($is_prime) {
			$array_prime[] = $y;
		}
	}
	return $array_prime;
}

if ((isset($_POST['A'])) and (isset($_POST['B']))) {
	if ($_POST['A'] != '') {
		echo "Значение <b>A</b> не введено";
	}
	elseif ($_POST['B'] != '') {
		echo "Значение <b>B</b> не введено";
	}
	else {
		$a = $_POST['A'];
		$b = $_POST['B'];	
		
		$c = division ($a, $b);
		
		if (is_numeric($c)) {
			echo "Вывод деления <b>A</b> на <b>B</b> с округлением до 2 знаков: ".$c."<br>";
		}
		else {
			echo "Wrong arguments<br>";
		}
	}
}
elseif ($_POST['X'] != '') {

	$x = $_POST['X'];

	if ((string)(int)$x == (string)$x) {
	
		$is_prime = is_prime($x);
		
		if (!$is_prime) {
			
			echo "Разложение на простые множители ".$x." = ";			
			$array_prime = array_prime ($x);
				
			while ($x > 1) {
				foreach ($array_prime as $ap) {
					$e = $x/$ap;
					if ((is_int($e)) and ($e > 1)) {
						echo $ap." * ";
						$x = $e;
						break;
					}
					elseif ((is_int($e)) and ($e = 1)) {
						echo $ap;
						$x = $e;
						break;
					}	
				}
			}
		}
		else {
			echo "Простое число <b>".$x."</b> нельзя разложить на множители<br>";
		}	
	}
	else {
		echo "Введенные Вами символы не являются целым числом";
	}
}	
else {
	echo "<body>";
	echo "<center> Функция деления двух переменных <b>A</b> и <b>B</b> с выводом ответа округленным до 2 знаков после запятой </center>";
	echo "<br><br>";
	echo "<form name='curl' method='POST' action='index.php' enctype='multipart/form-data'>";
	echo "<input name='A' type='text' size='20' placeholder='A'><br><br>";
	echo "<input name='B' type='text' size='20' placeholder='B'><br><br>";
	echo "<input type='submit' name='enter' value='GO'>";
	echo "</form>";
	echo "<br><br>";
	echo "<center> Функция возхврата простых множителей числа <b>X</b></center>";
	echo "<br><br>";
	echo "<form name='curl' method='POST' action='index.php' enctype='multipart/form-data'>";
	echo "<input name='X' type='text' size='20' placeholder='X'><br><br>";
	echo "<input type='submit' name='enter' value='GO'>";
	echo "</form>";
	echo "</body>";
}	
?>