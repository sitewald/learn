<?php require('../back.php'); ?>

Фабричный метод или Виртуальный конструктор - порождающий шаблон проектирования, <br />
позволяющий не создавать объекты специфических классов, а манипулировать <br /> 
абстрактными объектами на более высоком уровне(делегирует субклассу процесс <br />
создания объекта) - основа всех порождающих паттернов

<?php 
/* Паттерн эволюционировал и в php используют сокращённую форму */

abstract class Animal{
	// Фабричный метод, на основе типа возвращает объект
	//
	public static function init($className){
		if(!class_exists($className)){
			throw new Exception("class {$className} does not exist");
		}

		return new $className();
	}

	public abstract function voice();
}

class Leon extends Animal{
	public function voice(){
		echo '<h3>rrr</h3>';
	}
}

class Cat extends Animal{
	public function voice(){
		echo '<h3>mey miy</h3>';
	}
}

function voice(Animal $animal){
	$animal->voice();
}

$cat = Animal::init('Cat');
$leon = Animal::init('Leon');
//$dog = Animal::init('Dog'); exception 

voice($cat);
voice($leon);

?>