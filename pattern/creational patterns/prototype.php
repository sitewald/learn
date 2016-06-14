<?php require('../back.php'); ?>

Прототип - порождающий паттерн проектирования, <br />
суть которого в получении объекта путём клонирования исходного 

<?php 
interface IDuplicate{
	public function duplicate();
}

class ProtoTest implements IDuplicate{
	private $name;

	public function __construct($name){
		$this->name = $name;
	}

	public function setName($value){ 
		$this->name = $value;
	}

	public function getName(){
		return '<h3>' . $this->name . '</h3>';
	}

	public function duplicate(){
		return clone $this;
	}
}

$proto = new ProtoTest('Ivan');
$new = $proto->duplicate();

$new->setName('Petr');

echo $proto->getName();
echo $new->getName();
?>