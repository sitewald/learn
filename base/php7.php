<?php
// **************  Файл-конспект по PHP7  ******************

// -- Такая типизация была и в прежних версиях php
// function forArray(array $arr){}
// function forClass(SomeClass $obj){}

// -- Передача анонимной функции в качестве аргумента
// -- это также было доступно в прежних версиях php

function callAnonymous(callable $func){
	$func();
}

callAnonymous(function(){
	echo "<h4>from anonymous function</h4>";
});

// -- Типизированный аргумент - использование примитивных типов данных
// ---------------------------------------------------

function typedFunc($a, $b, int $c){
	echo $c, '<br />';
}

typedFunc(true, "str", 10);
typedFunc(true, "str", "10str"); // -- 10str будет приведено к 10 с notice о плохо сформированном
							   	 // -- третьем параметре (A non well formed numeric value)

// typedFunc(true, "str", "str"); // -- fatal error - третий параметр ни в каком виде не соответствует
								  // -- типу int (must be of the type integer, string given)

// -- Передача любого кол-ва аргументов в функцию
// ---------------------------------------------------

function parse(...$params){
	print_r($params);
}

parse(10, true, "str");

// -- Будет сделана попытка привести все аргументы к заданному типу

function typedParse(int ...$params){
	print_r($params);
}

parse(10, true, '10str'); // -- Notice: A non well formed numeric value - для третьего параметра

// -- Установка возвращаемого типа
// ---------------------------------------------------

function returnValue($var): int{
	return $var;
}

echo '<h3>', returnValue(10), '</h3>';

// Fatal error: Uncaught TypeError: Return value of returnValue() must be 
// of the type integer, string returned
// echo '<h3>', returnValue('str'), '</h3>'; 

// -- Таким образом php при использовании типизации всегда попытается
// -- ПРЕОБРАЗОВАТЬ аргумент или возвр. значение к заданному типу. Если
// -- такое преобразование ему выполнить не удастся - будет fatal error,
// -- а если преобразование хоть как-то возможно (true к 1, '10str' к 10 и т.д.)
// -- то выполнение продолжится (могут быть notice о неполном соответствии)

// -- Null coalescing operator 
// ---------------------------------------------------
// оператор подстановки значения вместо null
//  Замена громоздких конструкций типа

// if($a === null){
// 	$c = $b;
// }else{
// 	$c = $a;
// }

// --- или тернарного оператора $c = $a === null ? $b : $a;

$a = null;
$b = 0;

$c = $a ?? $b ?? 10; // -- если $a === null, то подставится $b и так далее

echo '<h3>', $c, '</h3>'; // -- выведет 0

// --- Spaceship operator 
// ---------------------------------------------------
// может использоваться для функции usort, 
// где пользователь задаёт свою функцию для сортировки массива,
// и эта функция должна возвратить 1 или 0 или -1
// Если первый элемент больше втрого - возвращает 1, если равны - 0, если меньше - -1

echo 1 <=> 1; // -- 0
echo 1 <=> 2; // -- -1
echo 2 <=> 1; // -- 1

echo 'a' <=> 'b'; // -- -1  сравнит коды символов 

// -- Константы - массивы
// ---------------------------------------------------

const SIMPLE_CONST = '<h4> Constant-array </h4>';

const FIRST_ARRAY = array(10, 20, 30);
// -- или так
define('SECOND_ARRAY', array(40, 50));

echo SIMPLE_CONST;
print_r(FIRST_ARRAY);
print_r(SECOND_ARRAY);


// -- Анонимные классы
// ---------------------------------------------------

$obj = new class{
	public function sayHello(){ return "hello from anonymous class"; }
	public static function staticSayHello($val){ echo '<h4>', $val, '</h4>'; }
}; // -- НУЖНО ОБЯЗАТЕЛЬНО СТАВИТЬ ТОЧКУ С ЗАПЯТОЙ

// --- вызов статического метода и метода объекта
$obj::staticSayHello(
		$obj->sayHello()
); 

// -- использование конструктора в анонимном классе
$constr = new class("hello from constructor of anonymous class"){
	public function __construct($val){
		echo '<h4>', $val, '</h4>';
	}
};

// --- наследование и реализация интерфейса в анонимном классе 
class BaseForAnonymous{
	public function sayHello() { echo 'hello from base class'; }
}

interface IDecorateParentOutput{
	public function decorate();
}

$child = new class() extends BaseForAnonymous implements IDecorateParentOutput{
	public function decorate(){
		echo '<h4>', $this->sayHello(), '</h4>';
	}
};

$child->decorate();

// -- Поддержка Unicode hex 
// ---------------------------------------------

echo '&pound;'; // --- html
echo "\u{25A9}"; // -- в двойных кавычках! Сначала \u, затем в {} hex символа

/*                                */ echo '<br />';

// -- Вызов контекста функции
// ----------------------------------

$func = function(){
	print_r($this);
};

// $func(); // -- Notice: Undefined variable: this

// -- Выведет на экран class@anonymous Object ( [a] => 1 )
$func->call(
	new class() { public $a = 1; }
); 

// -- Защита десериализации - фильтрация
// ----------------------------------------------

class SomeClass{
	public $a = 1;
}

$str = serialize(new SomeClass());

echo '<h4>', $str, '</h4>';

// -- Второй аргумент появился в PHP7 для защиты, если имя класса другое -
// -- Notice: main(): The script tried to execute a method or access a property 
// -- of an incomplete object  (десериализация не пройдёт)
$obj = unserialize($str, ['allowed_classes' => ['SomeClass']]);

echo '<h4>After unserialize $obj->a = ', $obj->a, '</h4>';

// -- Изменена функция assert
// --------------------------------------

// -- Прежний вариант
$a = '100';
$errMessage = 'It is not a numeric!';

// -- Если Php не сможет привести $a к числу, будет Warning с указанным текстом
assert(is_numeric($a), $errMessage); // -- Первый аргумент - 0 или 1, второй - строка

// -- Теперь можно вместо первого аргумента передавать булево выражение, 
// -- то есть функция понимает и 0 и false (1 и true), а вместо второго - 
// -- объект встроенного класса(или наследника) AssertionError

// ini_set('assert.exception', 1); // -- Если выполнить установку этой опции,
// -- то вместо Warning будет Fatal error

assert($a > 10, new AssertionError($errMessage));

// --- Использование use для пространств имён
// ------------------------------------------------
require('Classes/MyTestNamespace.php');

$obj = new My\Test\Space\MyClass(); // -- старый вариант использования
echo $obj->a; 

use My\Test\Space as mts; // --- алиас для пространства имён

$obj = new mts\MyClass();
echo $obj->a;

echo mts\myFunction();
echo mts\MYCONST;

use My\Test\Space2\MyClass as mcl; // -- алиас для класса
use function My\Test\Space2\myFunction as mf; // -- алиас для функции
use const My\Test\Space2\MYCONST as mc; // -- алиас для константы

$obj = new mcl();
echo $obj->a;

echo mf();
echo mc;

// --- Функция intdiv - деление с округлением
// ------------------------------------------

echo intdiv(10, 3); // -- 3
echo '<br />';
echo intdiv(10, 3.9); // -- 3 - оба аргумента приводятся к int 

// *************************************************************************
// -- В PHP7 в функцию session_start() можно передавать ассоциативный массив
// -- где ключи - это название опций сессии, доступных для просмотра в секции 
// -- session - (через phpinfo), а значения переопределяют поведение сессии по умолчанию
// *************************************************************************

// -- Новые, более надёжные функции для генерации случайных значений 
// ----------------------------------------------------------------
echo '<br />', random_int(1, 1000);
echo '<br />', random_bytes(20);

// *************************************************************
// -- Новая функция для замены по регулярному выражению 
// preg_replace_callback_array(patterns_and_callbacks, subject)
// -- где первый аргумент - ассоциативный массив, в котором
// -- ключ - регулярное выражение, а значение - функция, которая
// -- принимает в качестве аргумента найденное значение и далее с ним 
// -- каким-либо образом работает
// *************************************************************

// -- Генератор
// ------------------------------------------
echo '<h4>Generator</h4>';

function gen(){
	echo '<br /> first code';
	yield '<br /> first stop';

	echo '<br /> second code';
	yield '<br /> second stop';

	echo '<br /> third code';
	$val = yield;

	echo '<br /> yield = ' . $val;
}

$generator = gen();

// -- Метод current этого объекта выполняет код до первого yield и(или) возвращает то, что
// -- стоит напротив текущего yield, метод next выполняет код следующей секции, 
// -- метод send передаёт нужное значение в yield, на котором произошла остановка
// -- и выполняет код следующей секции

$generator->current(); // -- first code
echo '<br /> after first code';
$generator->current(); // -- ничего не выведет

$generator->next(); // -- second code
$yieldValue = $generator->current(); // -- ничего не выведет, но вернёт значение yield
echo $yieldValue; // ---- second stop

$generator->next(); // -- third code
$generator->send('10'); // -- yield = 10

// --- возвращаемое значение и вложенность генераторов
function gen1(){
	yield from [10, 20, 30];
	yield 2;
	yield 3;
	yield from gen2(); // -- вложенность генераторов
	return 'value from return';
}

function gen2(){
	yield 'from gen2 1';
	yield 'from gen2 2';
}

$generator = gen1();

// echo '<br />',  $generator->getReturn(); // -- fatal error - вызывать только после всех yield

foreach($generator as $val){
	echo "<br />", $val;
}

echo '<br />',  $generator->getReturn(); // -- value from return



