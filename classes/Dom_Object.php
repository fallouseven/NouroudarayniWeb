
<?php
	include_once('Utilitaire.php');
	class Dom_Object{
		private $_object;
		private $_xmlFile;
		private $_doc;
		private $_parent;
		private $_currentElem;
		private $parent_elt;
		private $_class;
		
		function __construc(){}
		 
		function createDOM($file, $parent){
			$this->setXmlFile($file);
			$this->setParent($parent);
			$this->_doc = new DOMDocument();
			if(!file_exists($fileArticleXML)){
				$this->_doc->version = '1.0';
				$this->_doc->encoding = 'utf-8';
				$parent_elt = $this->_doc->createElement($_parent);
			  	$doc->appendChild($parent_el);
			}else{
			 $exist = true;
			 $doc->load($_xmlFil); 
			 $parent_elt = $this->_doc->getElementsByTagName($_parent)->item(0);
			}
		}
		
		function setXmlFile($xml){
			$this->_xmlFile = $xml;
		}
		function setParent($parent){
			$this->parent_elt = $parent;
		}
		
		function setObject($object){
			$this->_object= $object;
		}
		
		function appendChild($object){
			$this->setObject($object);
			$elem = $doc->createElement(strtolower (get_class($object)));
			$methodElement = $this->getMethods($obj);
			foreach($methodElement as $key=>$value){
				$elem->appendChild($doc->createElement($key, $value));
			}
			$this->_currentElem = $elem;
		}
		function appendChild($object, $tag, $value){
			$elem->appendChild($doc->createElement($tag, $value));
			$object->addImage($value);
		}
		
		function addElement($elem){
			if($elem !== NULL) $parent_elt->appendChild($elem); 
		}
		
		function getCurrentElement(){
			return $this->_currentElem;
		}
		
		function getParent(){ 
			return $this->_parent;
		}
		
		function save(){
			$doc->preserveWhiteSpace = FALSE;
		  	$doc->formatOutput = true;  
		  	$doc->save($_xmlFile);
		}
		function create_instance($class, $params) {
			$reflection_class = new ReflectionClass($class);
			$_object = Utilitaire::create_instance($class,$params);
			return $_object;
		}
		
		function getMethods($obj){
			$reflect_class = new ReflectionClass($obj);
			$properties = Utilitaire::getProperties($reflect_class->getName());
			foreach ($reflect_class->getMethods()  as $method) {
				if (substr($method->name, 0, 3) == 'get') {//et est dans la liste des proprietes
					$propName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);
					if(in_array($propName, $properties))
						$result[$propName] = $method->invoke($obj);
				}
			}
			return $result;
		}
	}
	  
?>
