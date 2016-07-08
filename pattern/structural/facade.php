<?php require('../back.php'); ?>

Facade - структурный шаблон проектирования, суть которого заключается <br />
в сокрытии сложной системы путём предоставления объекта, обрабатывающего <br />
возможные вызовы и делегирующего их обработку компонентам этой системы <br />

<?php 
/* Сложная система */
class CPU{
	public function freeze(){
		//...
	}

	public function jump(){
		//...
	}

	public function execute(){
		//...
	}
}

class Memory{
	public function load(){
		//...
	}
}

class HardDrive{
	public function read(){
		//...
	}
}

/* Фасад */
class Computer{
	private $_cpu;
	private $_memory;
	private $_hardDrive;

	public function __construct(){
		$this->_cpu = new CPU();
		$this->_memory = new Memory();
		$this->_hardDrive = new HardDrive();
	}

	public function run(){
		$this->_cpu->freeze();
		$this->_hardDrive->read();
		$this->_memory->load();
		$this->_cpu->jump();
		$this->_cpu->execute();
	}
}
?>