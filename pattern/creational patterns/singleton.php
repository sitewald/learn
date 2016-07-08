<?php require('../back.php'); ?>

Singleton или Одиночка - порождающий паттерн проектирования, <br />
гарантирующий создание одного единственного объекта

<?php 
class Singleton{
	private static $instance;
	private $name;

	private function __construct(){ /* Защита от создания чере new */ 
		$this->name = 'initial name';
	}
	private function __clone(){ /* Защита от создания через клонирование */ }
	private function __wakeup(){ /* Защита от создания через unserialize */ }

	public static function getInstance(){
		if(empty(self::$instance)){
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function getName(){
		return '<h3>' . $this->name . '</h3>';
	}

	public function setName($value){
		$this->name = $value;
	}
}

$first = Singleton::getInstance();
echo $first->setName('new name');

$second = Singleton::getInstance();
echo $second->getName();
?>