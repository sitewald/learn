

<?php

class ParentClass{
	public $info;

	public function __construct($info){
		$this->info = $info;
	}

	public function getInfo(){
		return $this->info;
	}
}

?>