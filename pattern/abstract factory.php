
<?php
/* Абстрактная фабрика - порождение семейств взаимодействующих объектов */

abstract class AbstractConnection{
}

abstract class AbstractCommand{
	public abstract function getData(AbstractConnection $con); 
}

abstract class AbstractFactory{
	public abstract function getConnection();
	public abstract function getCommand();
}

class DataClient{
	public $con;
	public $cmd;

	public function __construct(AbstractFactory $factory){
		$this->con = $factory->getConnection(); // --- абстрагирование процессов инстанцирования
		$this->cmd = $factory->getCommand();
	}

	public function getData(){
		return $cmd->getData($this->con); // --------- абстрагирование процессов использования
	}
}

/* Далее производится конкретная реализация простых классов и фабрики. 
   DataClient предоставляет высокоуровневый интерфейс(набор методов)
   для получения данных и при этом налицо слабая связанность */

?>

<?php 

/* Фабричный метод инкапсулирует создание объектов, предоставляя субклассам 
   самим определять способ создания объекта */

abstract class AbstractCreator{
	public abstract function getObj();
}

class Client{
	public $obj;

	public function __construct(AbstractCreator $creator){
		$this->obj = $creator->getObj();
	}
}

?>