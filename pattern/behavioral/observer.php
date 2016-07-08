<?php require('../back.php'); ?>

Наблюдатель - поведенческий шаблоно проектирования, <br />
определяющий связь "один ко многим" между объектами <br />
таким образом, что при изменении одного объекта все <br />
зависящие от него объекты автоматически уведомляются (обновляются)

<?php 
interface ISubject{
	function addObserver(IObserver $observer);
	function removeObserver(IObserver $observer);
	function notify($newData);
}

interface IObserver{
	function update($newData);
}

class Subject implements ISubject{
	private $observers;

	public function __construct(){
		$this->observers = array();
	}

	public function addObserver(IObserver $observer){
		array_push($this->observers, $observer);
	}

	public function removeObserver(IObserver $observer){
		$index = array_search($observer, $this->observers);

		if($index !== false){
			unset($this->observers[$index]);
		}
	}

	public function notify($newData){
		foreach($this->observers as $observer){
			$observer->update($newData);
		}
	}
}

class FirstObserver implements IObserver{
	private $data;

	public function __construct(){
		$this->data = "initial value of first observer";
	}

	public function update($newData){
		$this->data = $newData;
	}

	public function showData(){
		echo "<h3>{$this->data}</h3>";
	}
}

class SecondObserver implements IObserver{
	private $data;

	public function __construct(){
		$this->data = "initial value of second observer";
	}

	public function update($newData){
		$this->data = $newData;
	}

	public function showData(){
		echo "<h3>{$this->data}</h3>";
	}
}

function Main(){
	$subject = new Subject();
	$firstObserver = new FirstObserver();
	$secondObserver = new SecondObserver();

	echo "<br />Before notify<br />";
	$firstObserver->showData();
	$secondObserver->showData();

	$subject->addObserver($firstObserver);
	$subject->addObserver($secondObserver);

	$subject->notify('New data from subject');

	echo "<br />After notify<br />";
	$firstObserver->showData();
	$secondObserver->showData();

	$subject->removeObserver($firstObserver);

	$subject->notify('new data after removing one of observers');

	$secondObserver->showData();
}

Main();
?>