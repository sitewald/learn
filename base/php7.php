<?php
// -- Файл-конспект по PHP7

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

function typedFunc($a, $b, int $c){
	echo $c, '<br />';
}

typedFunc(true, "str", 10);
typedFunc(true, "str", "10str"); // -- 10str будет приведено к 10 с notice о плохо сформированном
							   	 // -- третьем параметре (A non well formed numeric value)

// typedFunc(true, "str", "str"); // -- fatal error - третий параметр ни в каком виде не соответствует
								  // -- типу int (must be of the type integer, string given)

// -- Передать любое кол-во аргументов в функцию

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




