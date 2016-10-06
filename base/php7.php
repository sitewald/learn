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




