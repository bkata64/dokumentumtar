<? 
include_once('Application.php');

class Users extends Application {

    private $sql = array(
        'allUsers' => "SELECT u.id, u.name, username, password, r.name AS role FROM users u
                        LEFT JOIN roles r ON r.id = u.role_id" ,   
        'userById' => "SELECT u.id, u.name, username, password, r.name AS role FROM users u
                        LEFT JOIN roles r ON r.id = u.role_id WHERE id = {id}"
    );

    public function __construct() {
        parent::__construct();        
    }

    public function getUsers() {
        $users = $this->getResultList($this->sql['allUsers']);
        return $users;
    }

    public function getUserById($id) {
        if(!$this->isValidId($id)) {
            return array();
        }
        $params = array(
            '{id}' => $id
        );
        $user= $this->getSingleResult(strtr($this->sql['userById'], $params));
        return $user;
    }

    public function delete($id) {
        if(!$this->isValidId($id)) {
            return false;
        }
        $res = $this->deleteRekordById("users", $id);
        return $res;
    }
}


?>