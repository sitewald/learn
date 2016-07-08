
<!-- Файл-конспект по объектно-ориентированному php -->

<?php

error_reporting(E_NOTICE | E_WARNING | E_PARSE | E_ERROR);

function __autoload($className){
	require_once('Classes/' . $className . '.php');
}

?>

<style type="text/css">
	.header{
		color: #1b3687; font-size: 20px; font-weight: bold;
	}
</style>

<?php
	$headerBegin = "<p class='header'>";
	$headerEnd = "</p>";
?>

<?php 
echo "<h3>Имя класса условно регистрозависимо!</h3>";
echo "<h4>То есть желательно обращаться правильно, так как</h4>";
echo "<h4>могут быть проблемы с автозагрузкой класса</h4>";

class SomeClass{
	
}

$obj = new SomeClass();
$obj2 = new someclass(); // ошибки не будет, но нежелательно
?>

<?php
class MyClass{
	public $a = "В php переменная класса - свойство";	
	public $b = "Модификатор доступа для свойства обязателен!";
}

$obj = new MyClass();

echo "<h3>", $obj->a, "</h3>"; // при обращении к свойству
echo "<h3>", $obj->b, "</h3";  // оно указывается без $
?>

<?php
class MethodTest{
	private $a = "Функция в классе - МЕТОД! <br />";
	private $b = 
	 "У метода есть модификатор доступа по умолчанию - PUBLIC <br />";

	private function SomeMethod(){
		echo $this->a; // Обращение к свойствам и методам 
		echo $this->b; // класса - с помощью $this					   
	}
	
	public function SomeMethodCall(){
		$this->SomeMethod();	
	}
}

$funcTest = new MethodTest();
$funcTest->SomeMethodCall();
?>

<?php echo $headerBegin, "Конструктор/деструктор", $headerEnd;

class TestConstructDestruct{
	private $objectNum;
	
	// Круглые скобки конструктора - это и есть круглые скобки
	// при создании нового объекта с помощью new. Можно передать параметры
	public function __construct($num){
		$this->objectNum = $num;
		echo "object {$this->objectNum} created <br />";
	}
	
	// В старых версиях php(4) использовался конструктор 
	// с именем класса. Совместимость осталась
	// public function TestConstructDestruct(){
		
	//}
	
	// Круглые скобки деструктора положены по синтаксису, 
	// однако передавать туда ничего нельзя, да и неоткуда
	public function __destruct(){
		echo "object {$this->objectNum} deleted <br />";
		echo "<h4>Порядок удаления объектов неопределён! Ищи где-то в конце</h4>";
	}
}

$testObj1 = new TestConstructDestruct(1);
$testObj2 = new TestConstructDestruct(2);
$testObj3 = new TestConstructDestruct(3);
unset($testObj3); // Явный вызов деструктора
?>

<?php echo $headerBegin, "Инициализация свойств при создании объекта", $headerEnd;

class FieldTest{
	public $a = 1;
	public $b;
}

$ft = new FieldTest();

echo $ft->a, '<br />'; // --- 1
echo $ft->b, '<br />'; // --- ничего не выведет (пустое место)

?>

<?php echo $headerBegin, "Псевдоконстанты", $headerEnd;
	
	echo __LINE__, "<br />";
	echo __FILE__, "<br />";
	
	function PseudoConstFunc(){
		echo __FUNCTION__, "<br />";
	}
	
	PseudoConstFunc();
	
	class PseudoTest{
		public function __construct(){
			echo __CLASS__, "<br />";
			echo __METHOD__, "<br />";
		}
	}
	
	$pseudoTest = new PseudoTest();
?>

<?php echo $headerBegin, "Клонирование", $headerEnd;

class A{
	public $count;
	
	public function __construct($count){
		$this->count = $count;
		echo "<h3>При создании объекта его свойство count = {$this->count}</h3>";
	}
	
	public function __clone(){
		echo "<h3>Объект был клонирован</h3>";
	}
}

$a = new A(1);

// В php версии 4 $a1 = $a означает копирование объекта,
// $a1 = &$a означает копирование ссылки на объект

// В php версии 5 
$a1 = $a; // Копирование ссылки на объект для объектов и копирование по значению для 
 		  // обычных переменных.
// $a1 = &$a; -- Это также копирование ссылки на объект для объектов, но 
// для простых переменных это копирование ссылки на переменную

$a1->count = 10;
echo "<h3>Через ссылку значение count изменено на {$a->count}</h3>"; // 10

$b = new A(20);

$b2 = clone $b;

$b2->count = 100;
echo "<h3>У клона свойство count было изменено {$b2->count}</h3>";
echo "<h3>У объекта свойство count = {$b->count}</h3>";
?>

<?php echo $headerBegin, 'Наследование', $headerEnd;

// В функции __autoload в самом верху файла произойдёт попытка подключить класс ParentClass
//
class Child extends ParentClass{
	public function __construct($info){
		parent::__construct($info); // ------ Вызов родительского конструктора
	}

	public function getInfo(){
		return parent::getInfo(); // --------- Вызов родительской реализации метода
	}
}

$child = new Child("some info");

echo $child->getInfo(), '<br />';

?>

<?php echo $headerBegin, 'Интерфейс', $headerEnd;

class TestInterface implements ISome{
	public function showVar($var){
		echo "<h1>$var</h1>";
	}
}

$ti = new TestInterface();

$ti->showVar('implemented interface method work');

?>












