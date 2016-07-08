<style = "text/css">
	.header{
		font-weight: bold;
		color: #0C6910;
		margin: 20px;
		text-decoration: underline; 
	}
</style>

<!-- Обучающий файл-конспект по процедурному php -->

<?php // Комментарии

// Никто не увидит в браузере этот текст

/*
Этот
	текст
		тоже 
		 	никто
		 		не 
		 		  увидит
*/
?>

<?php // Рекомендуемый блок ?> 
<?php // Для php все блоки php в этом документе - один код, одна логика.
// Данная переменная будет вызвана ниже 
$highest_variable = "<h2> Эта переменная была объявлена самой первой в этом документе </h2>"; ?>

<?php echo $highest_variable ?>

<? // Не рекомендуется - похож на xml 
  // Если это будет видно в исходном коде страницы,
  // то опция short_open_tag в php.ini установлена в off.
  // Нужно открыть/создать в папке проекта .htaccess и в нём
  // написать php_flag short_open_tag on
?>

<?php // Основные виды ошибок

// 1. Parse  - во время парсинга кода(до выполнения)
// 2. Fatal  - во время выполнения(выполнение прервано)
// 3. Warning - во время выполнения(выполнение продолжается)
// 4. Notice - рекомендация(обычно отключена)

// Отключить все сообщения об ошибках
error_reporting(0);

// Сообщать обо всех ошибках PHP 
error_reporting (E_ALL); 

// Сообщать о простых ошибках во время выполнения
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Сообщение E_NOTICE может быть очень кстати (для сообщения о неинициализированных
// переменных или для отлова неправильного ввода имён переменных)
error_reporting (E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
?>

<?php echo "<p class='header'> Объявление переменных </p>";

$variable = "$ затем _ или буква, затем буква, или цифра или _";
$variaBLE = "<h3>Переменные регистрозависимы!</h3>";

unset($variable); // Переменная удалена

print $variaBLE;
?>

<?php echo "<p class='header'> Создание констант </p>";
	
define("MYCONSTANT", "Это содержимое моей константы по имени MYCONSTANT");  // Третий параметр - true, если 
// константа должна быть НЕрегистрозависимой - но это НЕЖЕЛАТЕЛЬНО      
echo MYCONSTANT;                        echo "<br />"

?>

<?php echo "<p class='header'> Вывод данных </p>";

print("print выводит только одно значение");
echo "<br />", "echo", " может ", "вывести", " несколько ";
?>

<?php echo "<p class='header'> heredoc </p>";

// После blabla не должно быть даже пробела!

$s = <<<blabla
<br />
 Вообще то, этот
  текст написан
   лесенкой, но
 	 		только в исходном коде 
 	 страницы :(
blabla;

// Ни перед, ни после blabla не должно быть ничего кроме ; в конце строки

echo $s; 
?>

<?php echo "<p class='header'> Про кавычки </p>";

// Разница между двойными "" кавычками и одинарными '' 

$userName = "Вася";

echo "<h4> Конечно, $userName, кто его не знает... </h4>";
echo "<br /> Хочу 100\$, а потом перенос строки \n, табуляцию \t, возврат каретки \r, 
косую черту \\, двойные кавычки \" посмотри исходный код страницы \" <br />";

echo '<h4> Всё, что осталось от его имени - $userName </h4>';
echo '<br /> Шеф, пропали 100\$, а потом перенос строки \n, табуляция \t, возврат каретки \r, 
косая черта выжила \\, двойные кавычки \" посмотри исходный код страницы \" <br />';
?>

<?php echo "<p class='header'> Экранирование переменной в строке </p>"; 

$userName = "Петя";

echo "<br /> php читает имя переменной в строке до
первого недопустимого символа - сказал $userName+++++ <br />";

echo "<br /> Поэтому $userName_ для него другая переменная <br />";

echo "<br />  А так он её прочтёт правильно - {$userName}_  <br />";

echo "<br />  И так тоже - ${userName}_  <br />";
?>

<?php echo "<span class='header'> Типы </span>";

// СКАЛЯРНЫЕ ----  4 вида

$_boolean = true; // false
$_integer = 1;
$_float = 1.1; // В php плавает ТОЧКА
$_string = "string";

// СМЕШАННЫЕ ---- 2 вида

// $_array = 
// $_object = 

// СПЕЦИАЛЬНЫЕ --- 2 вида

$_null = null; // Пустой тип -> переменная = null, если: 
// а) переменная не была определена
// б) переменной присвоили null
// в) переменную удалили

//$_resource = 
?>

<?php echo "<p class='header'> Доступ к символу в строке </p>"; 

$somestr = "somestr";

$first = $somestr{0}; // Индекс символа - с 0

$danger = $somestr[0]; // Так тоже можно, но нежелательно,
                       // так как неясно, строка это, или массив

echo "<br /> В строке somestr первый символ $first <br />";
?>

<?php echo "<p class='header'> Арифметические операторы </p>"; 

$a = 1; $b = 2;

$c = $a + $b;
$c = $a - $b;
$c = $a * $b;
$c = $a / $b;
$c = $a % $b; // Целочисленный остаток от деления
//$c = $a ** $b; // Возведение в степень - внедрено в PHP 5.6

// Сокращённая запись

$a += 2; // То же самое, что и $a = $a + 2

// Пре/постинкремент и пре/постдекремент
$a++; ++$a; $a--; --$a;
?>

<?php echo "<p class='header'> Неявное приведение типов - php всегда приводит одно к другому </p>";

echo true * 1; // 1 (true = 1)
											echo "<br />";
echo "2" * 1; // 2 ("2" = 2)
										    echo "<br />";
echo "2bla-bla" * 2; // 4 ("2bla-bla" = 2) 
											echo "<br />";

// php доходит до первой не-цифры в строке и прекращает преобразование
//
echo "_20" * 3; // 0 ("_20" = 0)
											echo "<br />";
?>

<?php echo "<p class='header'> Явное приведение типов </p>";

$str = "10 стрел на 10 ветрах <br />";
echo $str;

$int = (int)$str;
echo $int; // 10
											echo "<br />";
?>

<?php echo "<p class='header'> Конкатенация строк </p>";

echo 
 "Эта" . " строка " . "была получена" . " с помощью " . "конкатенации" . "<br />";

 $str = " А эта строка ";
 $str .= "была получена";
 $str .= " с помощью сокращённой записи конкатенации вида .= ";
 $str .= "<br />";

 echo $str;
?>

<?php echo "<p class='header'> Операторы ветвления </p>";

if(0)  // Любое выражение внутри круглых скобок php приведёт к boolean
	echo "Эта надпись не будет выведена, так как 0 приведётся к false";
elseif(0.0)
	echo "0.0 => false";
elseif("") // пустая строка
	echo "\"\" => false";
elseif("0")
	echo "\"0\" => false";
elseif(null)
	echo "null => false";
elseif(array()) // пустой массив
    echo "array() => false";
else
	echo "<h4> Всё остальное будет приведено к true </h4>";

if(true){
	echo "if содержит более 1 строки <br />";
    echo "поэтому строки заключены в фигурные скобки - блок <br />";
}

// Альтернативный способ записи блоков кода в if - подобие switch
if(0):
	echo "first <br />";
    echo "second <br />";
    echo "third <br />";
elseif(1):
	echo "first2 <br />";
    echo "second2 <br />";
    echo "third2 <br />";
endif;

// Тернарный оператор
//
echo "<span style='color: #ff0000; font-size: 20px;'>";

echo (2 * 2) == 4 ? "Тернарный оператор работает <br />" : "Не выведется";

echo "</span>";

// switch
//
$a = 1;

switch($a)
{
	case 0: echo "Это не выведется";
	case 1: echo "Этот switch";
	case 2: echo " не использует ";
	case 3: echo " break, поэтому ";
	case 4: echo "будут выведены все строки начиная с case 1<br />";
}

switch($a)
{
	case 0: echo "Это не выведется"; break;
	case 1: echo "Эта строка только и выведется, потому, что в ней есть break <br />"; break;
	case 2: echo "unvisible row"; break;
	case 3: 
	{
		echo "так тоже можно писать блок кода";
	}
	default: echo "необязательный default";
}

?>

<?php echo "<p class='header'> Логические операторы </p>";

$str = "10";
$int = 10;

if($str == $int) echo "Выведется, так как сравниваются значения <br />";
if($str === $int) echo "Не выведется, так как сравниваются значения и типы";
if($str != $int) echo "Не выведется, так как совпадают значения";
if($str !== $int) echo "Выведется, так как не совпадают типы";

// Приоритет логических операторов

// and = &
// or = |
// && > and
// || > or

if(1 and 1) echo "<h2> 1 and 1</h2>";
if(0 or 1) echo "<h2> 0 or 1</h2>";
if(1 & 1) echo "<h2> 1 & 1 </h2>";
if(1 | 0) echo "<h2> 1 | 0 </h2>";
if(1 and 1 && 0) 
	echo "<h2>Не выведется, так как это равноценно 1 and (1 and 0)</h2";
?>

<?php echo "<p class='header'> Массивы </p>";

// Ячейки будут автоматически пронумерованы, 
// начиная с наибольшего на данный момент индекса - индексированный массив
$user[] = "Vasya";
$user[] = 25;
$user[] = true;

echo $user[1]; // 25
										echo "<br />";
$admin[] = "Sergey";
$admin[0] = "Petya"; // Перезапись элемента массива с индексом 0
$admin[100] = true;
$admin[] = 20;

echo $admin[0];                         echo "<br />";
echo $admin[101]; // 20

// Краткая запись массива
//
$arr = array("Vasya", 100, "20");       
print_r($arr); // Показать содержимое массива
									       echo "<br />";
// Краткая запись с указанием индексов
//
$arr2 = array(10 => "Hallo", 20 => "world");
var_dump($arr2); // Показать подробно содержимое массива

// Массивы в php динамические, то есть могут быть дополнены после создания
//
$arr2[21] = "Ячейка создана позже";

// Массивы в php могут содержать индексированные ячейки и/или ассоциативные - смешанные масивы
$arr["name"] = "Oleg";

// Массив с названиями ячеек - ассоциативный. Доступ к ассоциативным ячекам - только по имени!
//
$arr3 = array("name" => "serg", "login" => "sergio");
$arr3[] = 20; // индекс = 0
echo "<br /> Имена или индексы ячеек не влияют на порядок ячеек <br />";
print_r($arr3);                                                   echo "<br />";

// Вывод элементов массива в строке
//
echo "My name is $arr3[name], my login is $arr3[login]"; // Первый вариант
																			echo "<br />";
echo "My name is {$arr3["name"]}, my login is {$arr3["login"]}"; // Второй вариант
																			echo "<br />";	

$dangerArray = array(name => "Serg", login => "sergio"); // Не стоит использовать такой синтаксис, 
// поскольку, если выше будет объявлена константа name или login, вместо этих ключей подставится
// содержимое константы, поэтому лучше брать ключи в кавычки	

// Многомерные массивы
//
$child_array = array("one", "two", "<h3> three </h3>");
$parent_array = array("serg", "petya", $child_array);

echo $parent_array[2][2]; // <h3> three </h3>
										echo "<br />";	
?>

<?php echo "<p class='header'> Циклы </p>";

// for (часть А ; часть Б ; часть Г) { тело цикла - часть В }
//
// Порядок работы цикла for
//
// часть А - любой код, выполняется один раз. Как правило (но необязательно) - инициализация счётчика
// часть Б - встроенный if, должен содержать булево условие. Если false - выход из цикла, если true - выполняется тело цикла
// часть В - любой код, тело цикла, выполняется при каждой итерации
// часть Г - любой код, выполняется после итерации, как правило, приращение счётчика
// часть Б и т.д.

$a = 0;

for(;;) // части могут быть пустыми, но ; обязательны
{
	$a++;
	if($a > 5) break; // иначе - бесконечный цикл
	else echo "Запомни, ни одна из частей цикла for не является обязательной! <br />";
}

// Выход из двух(и более) циклов

while(true)
{
	while(true)
	{
		echo "Сработает один раз, а потом произойдёт выход из двух циклов";
		break 2; // Нельзя указывать число более кол-ва используемых циклов
	}
}

// continue в php, аналогично break, может использовать число для обрыва 
// текущей итерации во внутреннем и внешних циклах

$a = 0;

while($a < 3)
{
	echo "<h1> . </h1>"; // ----------------- код работает от сих 

	while(true)
	{
		$a++;
		echo "дальше идёт continue 2";
		continue 2; // ---------------------- до сих
	    echo "Никогда не выведется";
	}

	echo "Никогда не выведется";
}

do
{
	echo "<h4> it works first time </h4>";
}
while(false);

// Цикл массивов

$indexed_array = array("one", "two", "three");
$associative_array = array("first" => "one", "second" => "two", "third" => "three");

foreach($indexed_array as $var)
{
	echo "$var <br />"; // только значение ячейки
}
											                  echo "<br /><br />";
foreach($associative_array as $key => $val)
{
	echo "$key has value = $val <br />"; // ключ и значение
}
															  echo "<br /><br />";
// так тоже будет работать
foreach($associative_array as $val)
{
	echo "$val <br />"; // только значение
}
															  echo "<br /><br />";
// и так тоже будет работать
foreach($indexed_array as $key => $val)
{
	echo "$key has value = $val <br />"; // индекс и значение
}
?>

<?php echo "<p class='header'> Функции </p>";

function MyFunc($parameter){
	echo "<h2> $parameter </h2>";
}

myfunc("Функции в php нерегистрозависимы!");

$ref = "myfunc";

$ref("Функция вызвана через переменную, в которой хранится её имя в виде строки");

?>

<?php echo "<p class='header'> Область видимости </p>";

$a = "Глобальная переменная";

function ShowLocal(){
	$a = "Локальная переменная";
	echo "$a <br />";
} // По выходу из функции локальные переменные удаляются

ShowLocal();

$b = "Глобальная переменная";

function ShowGlobal(){
	global $b;
    echo "$b <br />";
}

ShowGlobal();

function ShowFromGlobalArray(){
	echo $GLOBALS['b']; 
							echo "<br />";
}

ShowFromGlobalArray();
?>

<?php echo "<p class='header'> Статическая переменная </p>";

function Test(){
	$a = 0;
	echo $a++, " - обычная локальная переменная <br />";
}

Test(); // 0
Test(); // 0
Test(); // 0 

function StaticTest(){
	static $a = 0;
	echo $a++, " - статическая переменная <br />";
}

StaticTest(); // 0
StaticTest(); // 1
StaticTest(); // 2
?>

<?php echo "<p class='header'> Возврат значения из функции </p>";

function GetSum($n1, $n2){
	return $n1 + $n2;
}

$result = GetSum(20, 30);
echo "Функция GetSum(20, 30) вернула значение $result", "<br />";
?>

<?php echo "<p class='header'>Аргументы по умолчанию</p>";

function useDefaultArgs($arg = 10){
	echo $arg, '<br />';
}

useDefaultArgs(); // ----- 10
useDefaultArgs(5); // ---- 5

function useDefaultArgs2($first = 10, $second){ // --- бессмысленно, так как
	echo "{$first}, {$second} <br />";			// --- первый аргумент всё равно придётся указать
}

// поэтому аргумент со значением по умолчанию нужно писать в конце
//
function useDefaultArgs3($first, $second = 10){
	echo "{$first}, {$second} <br />";
}

useDefaultArgs3(1); // ---- 1, 10
?>

<?php echo "<p class='header'>Аргументы по ссылке</p>";

// ---- Обычные аргументы
//
function testVarChange($var){
	$var++;
}

function testArrChange($arr){
	$arr[1] = 100;
}

function testObjChange($obj){
	$obj->_field = 1000;
}

// ---- По ссылке 
function testVarByRef(&$var){
	$var++;
}

function testArrByRef(&$arr){
	$arr[1] = 100;
}

function testObjByRef(&$obj){
	$obj->_field = 2000;
}

// --- класс для тестирования передачи объекта в функцию
class ClassRefTest{
	public $_field = 1;
}

$var_ref_test = 1;
$arr_ref_test = array(1, 2);
$obj_ref_test = new ClassRefTest();

testVarChange($var_ref_test);
testArrChange($arr_ref_test);
testObjChange($obj_ref_test);

echo $var_ref_test, '<br />'; // ---------- 1 (не изменилось)
echo $arr_ref_test[1], '<br />'; // ------- 2 (не изменилось)
echo $obj_ref_test->_field, '<br />'; // -- 1000 (изменилось - объект передаётся по ссылке)

testVarByRef($var_ref_test);
testArrByRef($arr_ref_test);
testObjByRef($obj_ref_test);

echo $var_ref_test, '<br />'; // ---------- 2 (изменилось)
echo $arr_ref_test[1], '<br />'; // ------- 100 (изменилось)
echo $obj_ref_test->_field, '<br />'; // -- 1000 (изменилось - объект и без этого передаётся по ссылке)

?>

<?php echo "<p class='header'> Рекурсия </p>";

function func($a){
	if($a < 0) return;
    else echo $a, " recursion works<br />";

    $a--;

	func($a);
}

func(3);
?>

<?php echo "<p class='header'>Изменение переменной по ссылке</p>";

$someVar = 1;
$refVar = &$someVar;
$refVar = 2;

echo $someVar, '<br />'; // --- 2
?>


















