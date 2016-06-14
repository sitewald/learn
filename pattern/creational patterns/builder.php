<?php require('../back.php'); ?>

Строитель - порождающий паттерн проектирования,<br />
предоставляющий способ создания составного объекта

<?php 
/* Объект строительства */
class House{
	public $footing;
	public $walls;
	public $roof;

	public function setFooting($footing){
		$this->footing = $footing;
	}

	public function setWalls($walls){
		$this->walls = $walls;
	}

	public function setRoof($roof){
		$this->roof = $roof;
	}
}

/* Абстрактный строитель */
abstract class AbstractBuilder{
	public $house;

	public function __construct(){
		$this->house = new House();
	}

	public function getNewHouse(){
		echo '<h3>' . 
		$this->house->footing . ' ' . 
		$this->house->walls . ' ' . 
		$this->house->roof . 
		'</h3>';
	}

	public abstract function buildFooting();
	public abstract function buildWalls();
	public abstract function buildRoof();
}

class RedFirm extends AbstractBuilder{
	public function buildFooting(){
		$this->house->setFooting('gray footing');
	}

	public function buildWalls(){
		$this->house->setWalls('red walls');
	}

	public function buildRoof(){
		$this->house->setRoof('red roof');
	}
}

class GreenFirm extends AbstractBuilder{
	public function buildFooting(){
		$this->house->setFooting('gray footing');
	}

	public function buildWalls(){
		$this->house->setWalls('green walls');
	}

	public function buildRoof(){
		$this->house->setRoof('green roof');
	}
}

/* Реализация паттерна Строитель - показывает делегирование создания дома методу buildHouse */
class HouseBuilder{
	public $firm;

	public function __construct(AbstractBuilder $builder){
		$this->firm = $builder;
	}

	public function buildHouse(){
		$this->firm->buildFooting();
		$this->firm->buildWalls();
		$this->firm->buildRoof();
		$this->firm->getNewHouse();
	}
}

$houseBuilder = new HouseBuilder(new RedFirm());
$houseBuilder->buildHouse();
?>