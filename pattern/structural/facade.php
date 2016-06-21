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

	public function jump($position){
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
?>