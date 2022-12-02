<?php

	/***
	*
	*	kittens.php
	*
	*	You do not need to edit this code.
	*
	*	The code is writen in object oreiented PHP.
	*	You can lean more about OO PHP in the Web App Integration course in the final year.
	*
	*	Try running this script in your browser. Try:
	*
	*	kittens.php
	*	kittens.php?xml
	*	kittens.php?json
	*
	*	Make sure the necessary images are stored in an img/ subdirectory
	*
	***/

	/***
	* 
	*	Class Kitten
	*	
	*	Creates a kitten object
	*	The get_kitten method returns an associative array 
	*	
	***/
	class Kitten {
		private $img = "";
		private $creator = "";
		private $source = "";
		private $downloaded = "";

		public function __construct($img, $fname, $sname, $source, $downloaded) {
			$this->img = $img;
			$this->creator = array('fname' => $fname, 'sname' => $sname);
			$this->source = $source;
			$this->downloaded = $downloaded;
		}

		public function get_kitten() {
			return array('img' => $this->img, 'creator' => $this->creator, 'source' => $this->source, 'downloaded' => $this->downloaded);
		}
	}

	/***
	* 
	*	Class Response
	*	
	*	This takes an associative array (generated via a kitten object) and
	*	returns html, json or xml (depending on the parameter passed via the URL, with html as default)
	*	
	***/
	class Response {
		private $head;
		private $body;
		private $format;
		public $output = "";

		public function __construct($kitten) {
			$this->format = Utilites::getOutputType();
			$this->make_header();
			$this->make_body($kitten);
		}

		private function make_header() {

			$headerType = array('json' => "application/json",  'xml' => "text/xml", 'html' => "text/html"); 
			header("Content-Type: " . $headerType[$this->format]);
		}

		private function xmlLoop($kitten) {
			foreach ($kitten as $key => $value) {
					if (is_array($value)) {
						$this->output .=  "<$key>";
						$this->xmlLoop($value);
						$this->output .=  "</$key>";
					} 
					else {
 						$this->output .=  "<$key>$value</$key>";
 					}
				}
		}

		private function make_body($kitten) {

			if ($this->format == "xml") {
				$this->output .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
				$this->output .=  "<kitten>";
				$this->xmlLoop($kitten);
				$this->output .=  "</kitten>";
			} 
			if ($this->format == "json") {
				$this->output .= json_encode($kitten);
			} 
			if ($this->format == "html") {
				$this->output .=  "<img src=\"img/". $kitten['img'] ."\" alt=\"kitten\">";
				$this->output .=  "<p>Image by ". $kitten['creator']['fname'] . " ". $kitten['creator']['sname'] . " on " . $kitten['source'] . "</p>"; 
			} 
		}

	}

	/***
	* 
	*	Class Utilies
	*	
	*	This has some general utilities 
	*	This class should be used as a singleton and is not instantiated. 
	*	
	***/
	class Utilites {
		private static $randomNum;
		private static $outputType = "html";
		private static $params;

		private function __construct() {}

		static function getRandomNum($min, $max) {
			self::$randomNum = rand($min,$max);
			return self::$randomNum;
		}

		static function getOutputType() {
			self::$params = array_change_key_case($_GET, CASE_LOWER);
			
			if (isset(self::$params['xml'])) 
			{
				self::$outputType = "xml";
			}
			if (isset(self::$params['json'])) 
			{
				self::$outputType = "json";
			}
			return self::$outputType;
		}
	}



	/***
	* 
	*	Main 
	*	
	***/

	// Firstly, we create an array of kitten objects
	$k = array();
	$k[] = new Kitten("kote-puerto-771605-unsplash.jpg", "Kote", "Puerto", "Unsplash", "21-10-2018");
	$k[] = new Kitten("ramdan-authentic-490590-unsplash.jpg", "Ramdan", "Authentic", "Unsplash", "21-10-2018");
	$k[] = new Kitten("zhan-zhang-1076590-unsplash.jpg", "Zhan", "Zhang", "Unsplash", "22-10-2018");
	$k[] = new Kitten("sereja-ris-1063131-unsplash.jpg", "Sereja", "Ris", "Unsplash", "2-11-2018");
	$k[] = new Kitten("jeb-buchman-1037998-unsplash.jpg", "Jeb", "Buchman", "Unsplash", "5-11-2018");

	// Secondly we generate a random number for chosing a random kitten from the array
	$r = Utilites::getRandomNum(0,(count($k)-1));

	// Thirdly we generate a response (in xml, json or html) the randomly chosen kitten in the array
	$response = new Response($k[$r]->get_kitten());

	// Finally we return the response 
	echo $response->output;

?>

