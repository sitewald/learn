<?php

error_reporting(E_NOTICE | E_WARNING | E_PARSE | E_ERROR);

// ------------- base exception 

function testException($data){
	try{
		if ($data !== true){
			$myErrorCode = 1;
			throw new Exception("data doesn't equal true", $myErrorCode); // -- все аргументы не обязательны
		}
	}catch(Exception $e){
		echo $e->getCode(), '<br />';
		echo $e->getMessage(), '<br />';
		echo $e->getLine(), '<br />';
	}finally{
		echo "finally works <br />";
	}
}

testException(10);

// ------------- custom exception

class myException extends Exception{
	public function __construct($message){
		parent::__construct('--' . $message . '--'); // -- нужно вызывать родительский конструктор, 
									   				 // -- поскольку реализация родительского класса
									   				 // -- со временем может измениться
	}
}

function testMyException($data){
	try{
		if ($data !== true){
			throw new myException("data doesn't equal true");
		}
	}catch(myException $e){ // ------------- Исключение попадёт только в один catch
		echo $e->getMessage(), '- it is myException<br />';
	}catch(Exception $e){ // ------------- catch для базового исключения должен стоять последним,
						  // ------------- поскольку иначе до дочерних исключений оно не дойдёт
		echo $e->getCode(), '<br />';
	}finally{
		echo "finally works <br />";
	}
}

testMyException(10);

?>