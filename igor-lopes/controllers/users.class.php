<?php
	class Users extends Connection{
		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			parent::__destruct();
		}

		const SEXES = [
			0 => "Feminino",
			1 => "Masculino",
			2 => "Trans Sexual"
		];

		public static function Sexes(): array {
			return self::SEXES;
		}

		public function List(): array {
			$select = "SELECT `id_user`, `user_name`, `user_date_birth`, `user_sex`, `user_created_at`
					FROM `users`
					ORDER BY `user_name` ASC";

			try{
				$stmt = $this->connection->prepare($select);
				$stmt->execute();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
			}
			catch(Exception $e){
				die("<h1>Falha ao listar usuários.</h1>");
			}

			return $result;
		}

		public function Delete(int $id = 0): void {
			if ($id) {
				$delete = "DELETE FROM `users`
						WHERE `id_user` = ?
						LIMIT 1";

				try{
					$stmt = $this->connection->prepare($delete);
					$stmt->bindValue(1, $id, PDO::PARAM_INT);
					$stmt->execute();
					$stmt->closeCursor();
				}
				catch(Exception $e){
					die("<h1>Falha ao deletar usuário.</h1>");
				}
			}
		}

		public function Create(String $name = '', String $birth = '', int $sex = -1): void {
			$name  = mb_strtoupper(trim($name));
			$birth = trim($birth);

			if (!empty($name) && !empty($birth) && $sex >= 0) {
				$insert = "INSERT INTO `users`(`user_name`, `user_date_birth`, `user_sex`, `user_created_at`, `user_updated_at`)
							VALUES (?, ?, ?, NOW(), NOW())";

				try{
					$stmt = $this->connection->prepare($insert);
					$stmt->bindValue(1, $name, PDO::PARAM_STR);
					$stmt->bindValue(2, $birth, PDO::PARAM_STR);
					$stmt->bindValue(3, $sex, PDO::PARAM_INT);
					$stmt->execute();
					$stmt->closeCursor();
				}
				catch(Exception $e){
					die("<h1>Falha ao cadastrar usuário.</h1>");
				}

				header('Location: /');
			}
		}

		public function Update(int $id = 0, String $name = '', String $birth = '', int $sex = -1): void {
			$name  = mb_strtoupper(trim($name));
			$birth = trim($birth);

			if ($id && !empty($name) && !empty($birth) && $sex >= 0) {
				$update = "UPDATE `users`
						SET `user_name` = ?, `user_date_birth` = ?, `user_sex` = ?, `user_updated_at` = NOW()
						WHERE `id_user` = ?
						LIMIT 1";

				try{
					$stmt = $this->connection->prepare($update);
					$stmt->bindValue(1, $name, PDO::PARAM_STR);
					$stmt->bindValue(2, $birth, PDO::PARAM_STR);
					$stmt->bindValue(3, $sex, PDO::PARAM_INT);
					$stmt->bindValue(4, $id, PDO::PARAM_INT);
					$stmt->execute();
					$stmt->closeCursor();
				}
				catch(Exception $e){
					die("<h1>Falha ao atualizar usuário.</h1>");
				}

				header('Location: /');
			}
		}

		public function Get_User(int $id = 0): array{
			$result = array();

			if ($id) {
				$select = "SELECT `user_name`, `user_date_birth`, `user_sex`
						FROM `users`
						WHERE `id_user` = ?
						LIMIT 1";

				try{
					$stmt = $this->connection->prepare($select);
					$stmt->bindValue(1, $id, PDO::PARAM_INT);
					$stmt->execute();
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
				}
				catch(Exception $e){
					die("<h1>Falha ao selecionar usuário.</h1>");
				}
			}

			return $result;
		}
	}