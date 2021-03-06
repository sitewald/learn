
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

	.sub-header{
		padding: 10px;
		border: 1px solid #DBBB49;
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
	
	public function __clone(){ // ------------- вызывается через ключевое слово clone
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

<?php echo $headerBegin, "Перебор свойств объекта", $headerEnd;

class LoopTest{
	public $a = 1;
	public $b = 2;

	private $c = 3; // ---- не выведется в цикле

	protected $d = 4;  // ---- не выведется в цикле

	public function getA(){  // ---- не выведется в цикле
		return $this->a;
	}
}

$lt = new LoopTest();

foreach($lt as $key => $value){
	echo $key, ' = ', $value, '<br />';
}
?>

<?php echo $headerBegin, "Константы класса", $headerEnd;

class ConstTest{
	const MYCONST = 'MYCONST value'; // ----- без модификатора доступа

	public function fun(){
		$a = self::MYCONST; // ---------- обращение внутри класса
	}
}

$testConstOfClass = ConstTest::MYCONST; // ------ обращение извне класса
?>

<?php echo $headerBegin, 'Статические свойства, методы - в PHP НЕТ СТАТИЧЕСКИХ КЛАССОВ', $headerEnd;
class StaticFieldClass{
	public static $objectsCount;

	public function __construct(){
		self::$objectsCount++; // --- обращение внутри класса
	}

	public static function getCountOfObjects(){
		return self::$objectsCount;
	}
}

$staticFieldObj1 = new StaticFieldClass();
$staticFieldObj2 = new StaticFieldClass();

// --- обращение извне класса
//
echo '<h3>Используется свойство - Всего создано ' . StaticFieldClass::$objectsCount . ' объектов</h3>';
echo '<h3>Используется метод - Всего создано ' . StaticFieldClass::getCountOfObjects() . ' объектов</h3>';
?>

<?php echo $headerBegin, 'Наследование', $headerEnd;

// В функции __autoload в самом верху файла произойдёт попытка подключить класс ParentClass
//
class Child extends ParentClass{
	public function __construct($info){
		parent::__construct($info); // ------ Вызов родительского конструктора
	}

	public function getInfo(){ // ------------ Переопределение родительского метода
		return parent::getInfo(); // --------- Вызов родительской реализации метода
	}
}

$child = new Child("some info");

echo $child->getInfo(), '<br />';
?>

<?php  echo $headerBegin, "Абстрактные классы", $headerEnd;

class InfoObject{
	public $a = 1;
	public $b = 2;
}

abstract class AbstractParent{
	public abstract static function factory(); // ----- абстрактный статический метод

	public abstract function getInfo(InfoObject $obj); // -- абстрактный метод с типизированным параметром
}

class TestAbstractChild extends AbstractParent{
	public static function factory(){ // --- реализация абстрактного статического метода
		return new TestAbstractChild();
	}

	public function getInfo(InfoObject $obj){ // --- реализация абстрактного метода
		foreach($obj as $fieldName => $fieldValue){
			echo "<h2>{$fieldName} => {$fieldValue}</h2>";
		}
	}
}

// -- Здесь также можно наблюдать разыменовывание объекта, при котором
// метод вызывается у безымянного объекта, возвращаемого неким методом (фабричным)
TestAbstractChild::factory()->getInfo(new InfoObject());
?>

<?php echo $headerBegin, 'Интерфейсы', $headerEnd;

interface ISome{
	function doSomething(); // --- все методы интерфейса public abstract
}

class TestInterfaceClass implements ISome{
	public function doSomething(){
		echo 'do something <br />';
	}
}

$ti = new TestInterfaceClass();
$ti->doSomething();
?>

<?php echo $headerBegin, 'PHP не поддерживает множественное наследование', $headerEnd;
interface IA {}
interface IB {}
class BaseClass {}

class ChildClass extends BaseClass implements IA, IB{
	public function __construct(){
		echo '<h3>Но поддерживает реализацию многих интерфейсов</h3>';
	}
}

$childObj = new ChildClass();
?>

<?php echo $headerBegin, 'Финальные классы и методы', $headerEnd;
// ---- Финальный метод
//
class FinalMethodParent{
	public final function finalMethod(){}
}

class FinalMethodChild extends FinalMethodParent{
	//public function finalMethod(){} // --- произойдёт ошибка при попытке переопределить final метод
}

// --- Финальный класс
// 
final class FinalParentClass{}

//class TestFinalClass extends FinalParentClass{} // --- произойдёт ошибка при попытке 
// ----------------------------------------------------- унаследоваться от финального класса
?>

<?php echo $headerBegin, 'Проверка типа - instanceOf', $headerEnd;

interface ICar{}

class Car implements ICar{}

class Moskvich extends Car{}

$moskvich_102_bl_82 = new Moskvich();

echo '<ul>';

if($moskvich_102_bl_82 instanceOf ICar) echo '<li>it is ICar</li>';
if($moskvich_102_bl_82 instanceOf Car) echo '<li>it is Car</li>';
if($moskvich_102_bl_82 instanceOf Moskvich) echo '<li>it is Moskvich</li>';

echo '</ul>';
?>

<?php echo $headerBegin, 'Магические методы класса', $headerEnd;
// --- Вспомогательный класс для демонстрации
//
class MagicHelper{
	public static function showParameters($parameters){
		echo '<h3>';
		print_r($parameters);
		echo '</h3>';
	}
}

// Далее в кратком описании методов ->
//
// Группы магических методов:
// BEHAVIOR - если соответствующий магический метод не найден PHP в классе, то 
// реализуется поведение по умолчанию
// 
// ERROR - если соответствующий магический метод не найден PHP в классе, то 
// генерируется ошибка
// 
// Параметры в описании:
// ~par - произвольные параметры
// пустые скобки - без параметров
// $имя_метода - параметр с уточнением его назначения
//
// BEHAVIOR --------/
// __construct(~par) - вызывается при создании объекта с помощью new - см. выше
// __destruct() ------ вызывается при удалении объекта - см. выше
//
// ERROR -----------/
// __call($имя_метода, $массив_параметров) - вызывается при обращении к несуществующему методу
// __callStatic($имя_метода, $массив_параметров) - для несуществующего статического метода
//
// BEHAVIOR -------/ - будет создано новое свойство, значение которого можно будет получить
// __get($имя_свойства) -- вызывается при попытке получить значение несуществующего свойства
// __set($имя_свойства, $значение) -- вызывается при присвоении значения несуществующему свойству
//
// BEHAVIOR -------/ 
// __isset($имя_свойства) -- вызывается при проверке существования несуществующего свойства
// __unset($имя_свойства) -- вызывается при попытке удалить несуществующего свойство
//
// __sleep() // --- вызывается перед сереализацией
// __wakeup() // --- вызывается после десереализации
//
// ERROR ---------/
// __toString() // -- при попытке привести объект к строке
//
// __invoke()
// __set_state()
// __clone() ------- вызывается при клонировании объекта с помощью clone - см. выше
// __debugInfo() 

class MagicMethods{
	public $dynamicProperties = array(); // --- для __get и __set

	public function __call($name, $parameters){
		echo '<p>__call works</p>';

		if($name != "showVar"){
			echo '<h3>undefined method call!</h3>';
			return;
		} 

		MagicHelper::showParameters($parameters);
	}

	public static function __callStatic($name, $parameters){
		echo '<p>__callStatic works</p>';

		echo "<h3>Вызов несуществующего статического метода $name с параметрами:</h3>";
		MagicHelper::showParameters($parameters);
	}

	public function __set($name, $value){
		echo '<p>__set works</p>';

		$this->dynamicProperties[$name] = $value;
	}

	public function __get($name){
		echo '<p>__get works</p>';

		return $this->dynamicProperties[$name];
	}

	public function __isset($name){
		echo '<p>__isset works</p>';

		return isset($this->dynamicProperties[$name]);
	}

	public function __unset($name){
		echo '<p>__unset works</p>';

		unset($this->dynamicProperties[$name]);
	}

	public function __toString(){
		$info = '<p>__toString works</p>';

		$info .= '<ul>';

		foreach($this->dynamicProperties as $name => $value){
			$info .= "<li>$name = $value</li>";
		}

		$info .= '</ul>';

		return $info;
	}
}

$magicMethods = new MagicMethods();

// -- Вызов несуществующего метода (__call)
echo 'Реализация перегрузки методов с помощью __call(...) (перегрузка методов не предусмотрена в PHP)';
// -- Вызов любого существующего метода будет невозможен таким способом
//
$magicMethods->showVar(10);
$magicMethods->showVar('bla-bla', true);
$magicMethods->showVar(array('a' => 'A', 'b' => 'B'));
echo '<hr />';
// ---------------------------------------

// -- Вызов несуществующего статического метода (__callStatiс)
//
MagicMethods::staticShowVar(20);
echo '<hr />';
// ----------------------------------------

// -- Присвоение и получение значения несуществующего свойства (__set, __get)
//
$magicMethods->name = 'Vasya';
$magicMethods->age = 24;

echo 'Моё имя - ' . $magicMethods->name . ', мне ' . $magicMethods->age . ' лет';
echo '<hr />';
// ----------------------------------------

// -- Проверка существования и удаление несуществующего свойства (__isset, __unset)
//
isset($magicMethods->surname);
unset($magicMethods->surname);
echo '<hr />';
// -----------------------------------------

// -- __toString
// 
echo '<p>' . $magicMethods . '</p>';
echo '<hr />';
// ----------------------------------------
?>























