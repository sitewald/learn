<?php require('../back.php'); ?>

Proxy или заместитель - структурный шаблон проектирования, предоставляющий <br />
объект, который перехватывает все вызовы к другому объекту, является его <br />
контейнером и предоставляет тот же интерфейс <br />  

<?php 

interface IGetDataFromDb{
	public function testRights($user);
	public function connect($connectionString);
	public function execute($commandString);
}

class RealSubject implements IGetDataFromDb{
	public function testRights($user){
		//... real test rights
	}

	public function connect($connectionString){
		//... real connection
	}

	public function execute($commandString){
		//... real command execute
		//... return $result;
	}
}

class Proxy implements IGetDataFromDb{
	protected $realSubject;

	public function __construct(){
		$this->realSubject = null;
	}

	// Простая операция - создание тяжёлого объекта не требуется
	//
	public function testRights($user){
		return $user->rights > 0;
	}

	// Сложная операция - необходимо создание тяжёлого объекта
	//
	public function connect($connectionString){
		if($this->realSubject == null) 
			$this->realSubject = new RealSubject();

		return $this->realSubject->connect($connectionString);
	}

	public function execute($commandString){
		if($this->realSubject == null) 
			$this->realSubject = new RealSubject();

		return $this->realSubject->execute($commandString);
	}
}

?>  