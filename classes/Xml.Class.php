<?php

class Xml {
	//Atributos
	private $xml;
	private $tab = 1;
	
	//métudos
	public function __construct($version = '1.0', $encode = 'iso-8859-1') {
		$this->xml .= "<?xml version=\"$version\" encoding=\"$encode\" ?>\n";
	}
	
	public function openTag($name){
		$this->addTab();
		$this->xml .= "<$name>\n";
		$this->tab++;
	}
	
	public function closeTag($name){
		$this->tab--;
		$this->addTab();
		$this->xml .= "</$name>\n";
	}
	
	public function openString($name){
		$this->addTab();
		$this->xml .= "$name\n";
		$this->tab++;
	}
	
	public function closeString($name){
		$this->tab--;
		$this->addTab();
		$this->xml .= "$name\n";
	}
	
	public function setValue($value){
		$this->xml .= "$value\n";
	}
	
	private function addTab(){
		for ($i = 1; $i <= $this->tab; $i++){
			$this->xml .= "\t";
		}
	}
	
	public function addTag($name, $value){
		$this->addTab();
		$this->xml .= "<$name>$value</$name>\n";
	}
	
	public function __toString() {
		return $this->xml;
	}
}

?>