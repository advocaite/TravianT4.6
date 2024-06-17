<?php
namespace Core;
use PDO;

class DB extends PDO {
	private static $instance;
	public function __construct() {
		global $indexConfig;
		$options = [];
		$dsn = 	'mysql:charset=utf8mb4;host=' . $indexConfig['db']['host'] . ';dbname=' . $indexConfig['db']['name'];
		parent::__construct( $dsn, $indexConfig['db']['user'], $indexConfig['db']['pass'], $options );
		$this->exec("set names utf8mb4");
	}
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
}