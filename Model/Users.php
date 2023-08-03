<? 
include_once('Application.php');

class Users extends Application {

    private $sql = array(
        'allUsers' => "SELECT u.id, u.name, username, password, u.role_id, r.name AS role, avatar FROM users u
                        LEFT JOIN roles r ON r.id = u.role_id WHERE u.active=1" ,   
        'userById' => "SELECT u.id, u.name, username, password, u.role_id, r.name AS role, avatar FROM users u
                        LEFT JOIN roles r ON r.id = u.role_id WHERE u.id = {id} and u.active = 1",
        'userByUsername' => "SELECT u.id, u.name, username, password, u.role_id, r.name AS role, avatar FROM users u
                        LEFT JOIN roles r ON r.id = u.role_id WHERE u.username = '{username}' and u.active = 1"
    );

    private $messages = array();

    protected $table = 'users';
    protected $fields = array('id', 'name', 'username', 'password', 'role_id', 'avatar');

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

    public function getUser($username) {
        if(!is_string($username))  {
            $this->messages[] = 'A felhasználó név csak szöveg lehet!';
            return false;
        }    
        if(strlen($username) > 50) {
            $this->messages[] = 'A felhasználó név hossza nem haladhatja meg az 50 karaktert!';
            return false;
        }

        echo htmlspecialchars($username);

        $params = array(
            '{username}' => htmlspecialchars($username)
        );
        $user= $this->getSingleResult(strtr($this->sql['userByUsername'], $params));
        return $user;
    }

    public function delete($id) {
        if(!$this->isValidId($id)) {
            return false;
        }
        $res = $this->deleteRekordById("users", $id);
        return $res;
    }

    public function save($user) {
        if(!$this->validation($user)) {
           $this->writeLog("\nA kapott adatsor invalid! <br>".implode('<br>', $this->messages));
           $this->msg->setSessionMessage('A form kitöltése nem megfelelő! <br>'.implode('<br>', $this->messages));            
           return null;
       } 
       $user['password'] = md5($user['password']);
       if(isset($user['id']) && !empty($user['id'])) {
           if($this->isValidId(intval($user['id']))) {
               $this->id = intval($user['id']); 
               $filename = $this->fileUpload();

                if($filename) {
                    $user['avatar'] = $filename;
                }                                          
               $res = $this->modify($user);               
           } else {
               $this->writeLog("\nA kapott id invalid: {$user['id']}");
               $this->msg->setSessionMessage("\nA kapott id invalid: {$user['id']}");
           }
       } else { 
            $filename = $this->fileUpload();
            $user['avatar'] = $filename ? $filename : '';          
            $res = $this->create($user);  
            if($res) {
                $this->id = $this->getLastInsertedId();                                       
            }  
       }      
        
       return $this->id;
   }

   /** override */
   protected function validation($data) {
    if(!isset($data['name']) || empty($data['name']) || $data['name'] == null) {
        $this->messages[] = 'A név mező kitöltése kötelező!';
        return false;
    }

    if(!is_string($data['name']))  {
        $this->messages[] = 'A név csak szöveg lehet!';
        return false;
    }

    if(strlen($data['name']) > 50) {
        $this->messages[] = 'A név hossza nem haladhatja meg az 50 karaktert!';
        return false;
    }

    if(!isset($data['username']) || empty($data['username']) || $data['username'] == null) {
        $this->messages[] = 'A felhasználó név mező kitöltése kötelező!';
        return false;
    }

    if(!is_string($data['username']))  {
        $this->messages[] = 'A felhasználó név csak szöveg lehet!';
        return false;
    }

    if(strlen($data['username']) > 50) {
        $this->messages[] = 'A felhasználó név hossza nem haladhatja meg az 50 karaktert!';
        return false;
    }

    if(!isset($data['password']) || empty($data['password']) || $data['password'] == null) {
        $this->messages[] = 'A jelszó mező kitöltése kötelező!';
        return false;
    }

    if(!is_string($data['password']))  {
        $this->messages[] = 'A jelszó csak szöveg lehet!';
        return false;
    }

    if(strlen($data['password']) > 50 || strlen($data['password']) < 8) {
        $this->messages[] = 'A jelszó hossza 8 és 20 között legyen!';
        return false;
    }

    if(!is_numeric($data['role_id'])) {
        $this->messages[] = 'A jogosultság azonosítója nem szám típusú!';
        return false;
    } else {
        $jog = intval($data['role_id']);
        if(!$this->existingRekordById('roles', $jog)) {
            $this->messages[] = 'Nincs ilyen jogosultság!';
            return false;
        }
    }    

    return true;
   }

   private function fileUpload() {
    echo $_FILES['kep']['tmp_name'];
    if(isset($_FILES) && !empty($_FILES['kep']['tmp_name'])) {
       $targetDir = "Sources/uploads/";
       $targetFile = $targetDir . basename($_FILES['kep']['name']);

       $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

       $check = getimagesize($_FILES['kep']['tmp_name']);
       if($check !== false) {
            if(file_exists($targetFile)) {
                $this->msg->setSessionMessage('A fájl már létezik!');
                return false;
            }

            if($_FILES['kep']['size'] > 500000) {
                $this->msg->setSessionMessage('A fájl túl nagy!');
                return false;
            }

            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
                $this->msg->setSessionMessage('A megengedett képformátumok: JPG, JPEG, PNG vagy GIF.');
                return false;
            }

            if(move_uploaded_file($_FILES['kep']['tmp_name'], $targetFile)) {
                $filename = basename($_FILES['kep']['name']);
                return $filename;
            } else {
                $this->msg->setSessionMessage('A fájl áthelyezése sikertelen!');
                return false;
            }

       } else {
        $this->msg->setSessionMessage('A feltöltött fájl nem kép!');
        return false;
       }
    }
    return false;
    }   

    public function setSid($id, $sid=null) {  
        if($sid)  {    
            return ($this->execute('UPDATE users SET sid = "' . $sid . '" WHERE id = ' . $id));
        } else {
            return ($this->execute('UPDATE users SET sid = null WHERE id = ' . $id));
        }
    }

}


?>