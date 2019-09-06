<?php
	class Connection{
		protected function __construct(){
			$br_server   = 'localhost';
			$br_user     = 'user';
			$br_password = 'password';
			$br_database = 'database';

			try{
				$this->connection = new PDO("mysql:host={$br_server}; dbname={$br_database}", $br_user, $br_password);
			}
			catch(Exception $e){
				die("Erro ao conectar com o banco de dados");
			}
		}

		protected function __destruct() {
			$this->connection = null;
		}
	}