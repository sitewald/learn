<?php require('../back.php'); ?>

Adapter - структурный шаблон проектирования, предусматривающий <br />
создание класса-оболочки для использования класса с неподходящим интерфейсом <br />

<?php 
// Нужный интерфейс
//
interface IGetLength{
	function getObjectLength($obj);
}

// Класс с неподходящим интерфейсом
class StringAnalyzer{
	public function getStringLength($str){
		return strlen(trim($str));
	}
}

// Адаптер
//
class StringAnalyzerAdapter implements IGetLength{
	protected $stringAnalyzer;

	public function __construct(){
		$this->stringAnalyzer = new StringAnalyzer();
	}

	public function getObjectLength($obj){
		return $this->stringAnalyzer->getStringLength($obj);
	}
}

?>