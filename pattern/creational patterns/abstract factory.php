<?php require('../back.php'); ?>

Абстрактная фабрика - порождающий шаблон проектирования, <br />
предоставляет интерфейс для создания семейств взаимодействующих или <br />
взаимозависимых объектов не специфицируя их конкретных классов

<?php

interface IParent{
	public function getParentRole();
}

interface IChild{
	public function getChildName();
}

/* interface IFamily - this is abstract factory */
interface IFamily{
	public function createFamily();
}

//---------------------------------------------

class IvanovFather implements IParent{
	public function getParentRole(){
		return 'father Ivanov';
	}
}

class IvanovMother implements IParent{
	public function getParentRole(){
		return 'mother Ivanova';
	}
}

class IvanovChild implements IChild{
	public function getChildName(){
		return 'son Ivan Ivanov';
	}
}

/* Class IvanovFamily - this is concrete factory */
class IvanovFamily implements IFamily{
	public $father;
	public $mother;
	public $child;

	public function __construct(){
		$this->father = new IvanovFather();
		$this->mother = new IvanovMother();
		$this->child = new IvanovChild(); 
	}

	public function createFamily(){
		echo '<h4>This is family of Ivanov - ' .
			$this->father->getParentRole() . ' and ' .
			$this->mother->getParentRole() . ' and ' .
			$this->child->getChildName() . '</h4>';
	}
}

function getFamilyInfo(IFamily $family){
	$family->createFamily();
}

getFamilyInfo(new IvanovFamily());
?>