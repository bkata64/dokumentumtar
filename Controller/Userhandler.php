<? 
include_once('AppController.php');

Class UserHandler extends AppController {
    public function __construct() {
        parent::__construct();
        $this->setAllowedMethods(array('login', 'logout', 'execute'));
    }

    public function login() {
        $this->template = 'admin/login';
        if(isset($_POST['username']) && isset($_POST['password'])) {           
            $this->useModels(array('Users'));    
            $user = $this->Users->getUser($_POST['username']); 
            $this->set('user', $user);       

            if(strtolower($_POST['username']) == strtolower($user['username'])
            && substr(md5($_POST['password']), 0, 20)  == $user['password']) {
                $_SESSION['user'] = $user;
                $this->Users->setSid($user['id'], session_id());
                header('Location: ?archives/index');
                exit;
            } else {                
                $this->msg->setSessionMessage('Helytelen felhasználónév vagy jelszó!');
            }
        }
    }

    public function logout() {  
        debug($_SESSION['user']['id']);
        $this->useModels(array('Users'));
        $this->Users->setSid(intval($_SESSION['user']['id']));
        $_SESSION['user'] = null;
        header('Location: ?archives');
        exit;
    }
}

?>