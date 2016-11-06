<?php

namespace App;

class Api
{

    private $method;
    private $model;
    private $token = "f2c524e4987f3b19bf8e5204bc4f7622";

    public function __construct(Database $model)
    {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        $this->model = $model;
    }

    public function getData($params)
    {
        if ((!isset($_REQUEST['token']) || $this->token != $_REQUEST['token']) && $this->method != 'GET') {
            $data = ['success' => 0, 'message' => 'Jeton invalide.'];
        } else {
			// On s'assure que les entrées sont valide Exemple : localhost:8000/{param[0]}/{param[1]}
            if (in_array($params[0], ['contacts', 'adresses'])) {
                switch ($this->method) {
                    case 'GET':
                        if (isset($params[1])) {
                            $data = $this->model->getOne($params[0], intval($params[1]));
                            if (!$data) $data = ['success' => 0, 'message' => ucfirst($params[0]) . ' non trouvé'];
                        } else {
                            $data = $this->model->getAll($params[0]);
                        }
                        break;
                    case 'POST':
                        if ($params[0] == 'contacts') {
                            if ($this->validation(['civilite', 'nom', 'prenom'])) {
                                $data = $this->model->insert('contacts', $_POST);
                            } else {
                                $data = ['success' => 0, 'message' => 'Les champs civilité, nom et prénom sont obligatoire.'];
                            }
                        } else {
                            if ($this->validation(['ville', 'code_postal', 'contact_id'])) {
                                $data = $this->model->insert('adresses', $_POST);
                            } else {
                                $data = ['success' => 0, 'message' => 'Les champs ville, code_postal et contact_id sont obligatoire.'];
                            }
                        }
                        break;
				    case 'PUT':
						parse_str(file_get_contents("php://input"),$put);
                        if ($params[0] == 'contacts') {
                                $rep = $this->model->update('contacts', $put, $params[1]);
                                if (!$rep) $data = ['success' => 0, 'message' => ucfirst($params[0]) . ' non trouvé'];
                             else {
                                $data = $rep;
                            }
                            
                        } else {
                                $rep = $this->model->update('adresses', $put, $params[1]);
								if (!$rep) $data = ['success' => 0, 'message' => ucfirst($params[0]) . ' non trouvé'];
                             else {
                                $data = $rep;
                            }
                            
                        }
                        break;
				    case 'DELETE':
                        if (isset($params[1])) {
                            
                             $rep = $this->model->delete($params[0], intval($params[1]));
						     if (!$rep) $data = ['success' => 0, 'message' => ucfirst($params[0]) . ' non trouvé'];
                             else {
                                $data = ['success' => 1, 'message' => ucfirst($params[0]) .' '. ucfirst($params[1]) . " Supprimé avec succes"];
                            }
                        } 
                        break;
                }
            }
        }
        if (isset($data)) exit($this->print_data($data));
		else exit("Paramètre invalide, essayez avec /contacts ou /adresses");
    }

	// Verifier si les champs obligatoire ne sont pas vide avant insertion
    private function validation($data)
    {
        $valide = true;
        foreach ($data as $d) {
            if (!key_exists($d, $_POST) || empty($_POST[$d])) {
                $valide = false;
                break;
            }
        }
        return $valide;
    }

	// Traitement de de l'affichage xml et json
    private function print_data($data){
        if(isset($_REQUEST['content_type']) && strtolower($_REQUEST['content_type']) == 'xml'){
            $xml = new \SimpleXMLElement('<entity/>');
            array_walk_recursive($data, function ($value, $key) use ($xml) {
                $xml->addChild($key, $value);
            });
            return $xml->asXML();
        }else{
            return json_encode($data);
        }
    }

}