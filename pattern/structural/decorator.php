<?php require('../back.php'); ?>

Decorator - структурный шаблон проектирования, предусматривающий <br />
динамическое подключение дополнительного поведения к объекту <br />

<?php 

interface IComponent{
	public function operation();
}

class Component implements IComponent{
	public function operation(){
		//...
	}
}

abstract class AbstractDecorator{
	protected $component;

	public function __construct(IComponent $component){
		$this->component = $component;
	}
}

class Decorator extends AbstractDecorator{
	public function decoratedOperation(){
		//... added
		$this->component->operation();
		//... added
	}
}

?>