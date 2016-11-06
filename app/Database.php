<?php
namespace App;

class Database
{

    private $dbname = "testapi";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbhost = "localhost";

    private $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host={$this->dbhost};dbname={$this->dbname};charset=utf8", $this->dbuser, $this->dbpass);
    }

    public function getAll($table)
    {
        return $this->db->query("SELECT * FROM {$table}")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOne($table, $id)
    {
        $data = $this->db->query("SELECT * FROM {$table} WHERE id = {$id} LIMIT 1 ")->fetch(\PDO::FETCH_ASSOC);
		
		// Au cas ou le contact a plusieur adresses
        if ($data && $table == 'contacts') {
            $data['adresses'] = $this->db->query("SELECT * FROM adresses WHERE contact_id = {$id}")->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function insert($table, $data)
    {
        if ($table == 'contacts') {
            $sql = "INSERT INTO {$table} (civilite, nom, prenom, date_naissance, date_creation, date_modification) VALUES (:civilite, :nom, :prenom, :date_naissance, :date_creation, :date_modification)";
            $query = $this->db->prepare($sql);
            $date = date('Y-m-d H:i:s');
            $query->execute([
                ':civilite' => $data['civilite'],
                ':nom' => $data['nom'],
                ':prenom' => $data['prenom'],
                ':date_naissance' => (isset($data['date_naissance'])) ? date('Y-m-d', strtotime($data['date_naissance'])) : NULL,
                ':date_creation' => $date,
                ':date_modification' => $date,
            ]);
            return ['success' => 1, 'message' => 'Contact ajouté avec succés', 'id' => $this->db->lastInsertId()];
        } else {
            $sql = "INSERT INTO {$table} (contact_id, rue, code_postal, ville, date_creation, date_modification) VALUES (:contact_id , :rue, :code_postal, :ville, :date_creation, :date_modification)";
            $query = $this->db->prepare($sql);
            $date = date('Y-m-d H:i:s');
            $query->execute([
                ':contact_id' => $data['contact_id'],
                ':rue' => (isset($data['rue'])) ? $data['rue'] : NULL,
                ':code_postal' => $data['code_postal'],
                ':ville' => $data['ville'],
                ':date_creation' => $date,
                ':date_modification' => $date,
            ]);
            return ['success' => 1, 'message' => "Adresse ajouté avec succés", 'id' => $this->db->lastInsertId()];
        }

    }
	
	public function update($table, $data, $id)
    {
		if ($this->getOne($table, $id)){
			if ($table == 'contacts') {
				$sql = "UPDATE {$table} SET 
				civilite= :civilite, nom= :nom, prenom= :prenom, date_naissance= :date_naissance, date_modification= :date_modification
				WHERE id= :id";
				$query = $this->db->prepare($sql);
				$date = date('Y-m-d H:i:s');
				$query->execute([
					':civilite' => $data['civilite'],
					':nom' => $data['nom'],
					':prenom' => $data['prenom'],
					':date_naissance' => (isset($data['date_naissance'])) ? date('Y-m-d', strtotime($data['date_naissance'])) : NULL,
					':date_modification' => $date,
					':id' => $id,
					
				]);
				return ['success' => 1, 'message' => 'Contact modifié avec succés', 'id' => $id];
			} else {
				$sql = "UPDATE {$table} 
				SET rue= :rue, code_postal= :code_postal, ville= :ville, date_modification= :date_modification
				WHERE id= :id";
				$query = $this->db->prepare($sql);
				$date = date('Y-m-d H:i:s');
				$query->execute([
					':rue' => (isset($data['rue'])) ? $data['rue'] : NULL,
					':code_postal' => $data['code_postal'],
					':ville' => $data['ville'],
					':date_modification' => $date,
					':id' => $id,
				]);
				return ['success' => 1, 'message' => 'Adresse modifié avec succés', 'id' => $id];
			}
			
		}   
		else{
			return false;
		}

    }
	
	public function delete($table, $id)
    {
        
			if ($this->getOne($table, $id)){
				$sql = "DELETE FROM {$table} 
				WHERE id= :id";
				$query = $this->db->prepare($sql);
				$data = $query->execute([
				':id' => $id,
					
				]);
				 return true;
			}
			else return false;
        

    }

}