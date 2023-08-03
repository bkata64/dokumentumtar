<? 
include_once('AppController.php');

class Archives extends AppController {
    public function __construct() {
        parent::__construct();
        $this->setAllowedMethods(array('index', 'detail', 'searchDocuments', 'allDocuments'));
    }

    public function index() {
        $this->useModels(array('Documents'));
        $this->template = 'frontend';

        $documents = $this->Documents->getDocuments();
        
        $this->set('documents', $documents);
    }

    public function detail() {
        if(isset($_POST['document'])) {
            $this->useModels(array('Documents'));
            $this->template = 'detail';

            $document = $this->Documents->getDocumentById(intval($_POST['document']));
            $this->set('document', $document);
        }
    }    

    public function searchDocuments() {
        if(isset($_POST['title']) || isset($_POST['cat'])) {
            $this->useModels(array('Documents'));
            $this->template = 'table_view';
            
            $documents = $this->Documents->getDocumentsFilter($_POST['title'], $_POST['cat']);
            $this->set('documents', $documents);            
        }
    }

    public function adminSearchDocuments() {
        if(isset($_POST['title']) || isset($_POST['cat'])) {
            $this->useModels(array('Documents'));
            $this->template = 'admin/admin_table_view';
            
            $documents = $this->Documents->getDocumentsFilter($_POST['title'], $_POST['cat']);
            $this->set('documents', $documents);            
        }
    }

    public function allDocuments() {
        $this->useModels(array('Documents'));
        $this->template = 'table_view';

        $documents = $this->Documents->getDocuments();
        
        $this->set('documents', $documents);
    } 

    public function adminAllDocuments() {
        $this->useModels(array('Documents'));
        $this->template = 'admin/admin_table_view';

        $documents = $this->Documents->getDocuments();
        
        $this->set('documents', $documents);
    }

    public function backend() {
        $this->useModels(array('Categories', 'Publishers'));
        $this->template = 'admin/listak';

        $categories = $this->Categories->getCategories();
        $publishers = $this->Publishers->getPublishers();

        $this->set('categories', $categories);
        $this->set('publishers', $publishers);

    }

    public function backend_doku() {
        $this->useModels(array('Documents'));
        $this->template = 'admin/dokumentumok';

        $documents = $this->Documents->getDocuments();

        $this->set('documents', $documents);
    }

    public function backend_user() {
        $this->useModels(array('Users', 'Roles'));
        $this->template = 'admin/felhasznalok';

        $users = $this->Users->getUsers();
        $roles = $this->Roles->getRoles();

        $this->set('users', $users);
        $this->set('roles', $roles);

    }

    public function category() {
        $this->useModels(array('Categories'));
        $this->template = 'admin/kategoria_form';

        $id = $this->getId();

        if(isset($_POST['name'])) {
            $id = $this->Categories->save($_POST);
            if(!empty($id)) {
                $this->msg->setSessionMessage('A mentés sikeres.');
                $url = '?archives/category/' . $id;        
                header("Location: $url");
                exit;
            } else {
                $this->msg->setSessionMessage('A mentés sikertelen!');
            }
        }

        $category = array();
        if(!empty($id)) {
            $category = $this->Categories->getCategoryById($id);            
        }

        $this->set('category', $category);
    }

    public function publisher() {
        $this->useModels(array('Publishers'));
        $this->template = 'admin/kiado_form';
        
        $id = $this->getId();
        if(isset($_POST['name'])) {
            $id = $this->Publishers->save($_POST);
            if(!empty($id)) {
                $this->msg->setSessionMessage('A mentés sikeres.');
                $url = '?archives/publisher/' . $id;        
                header("Location: $url");
                exit;
            } else {
                $this->msg->setSessionMessage('A mentés sikertelen!');
            }
        }

        $publisher = array();
        if(!empty($id)) {
            $publisher = $this->Publishers->getPublisherById($id);            
        }

        $this->set('publisher', $publisher);
    }

    public function document() {
        $this->useModels(array('Categories', 'Publishers', 'Roles', 'Documents'));
        $this->template = 'admin/dokumentum_form';

        $getKey = array_keys($_GET);
        $urlSegments = explode("/", $getKey[0]);
        $id = isset($urlSegments[2]) ? intval($urlSegments[2]) : null;

        if(isset($_POST['title'])) {
            if(isset($_POST['kep'])){
                $_POST['logo_url'] = $this->Documents->document['logo_url'];
            };
            $id = $this->Documents->save($_POST);    
            if(!empty($id)) {
                $this->msg->setSessionMessage('A mentés sikeres.');
                $url = '?archives/document/' . $id;        
                header("Location: $url");
                exit;
            } else {
                $this->msg->setSessionMessage('A mentés sikertelen!');
            }
            
        }
       

        $publishers = $this->Publishers->getPublishers();
        $categories = $this->Categories->getCategories();
        $roles = $this->Roles->getRoles();

        $this->set('categories', $categories);
        $this->set('publishers', $publishers);
        $this->set('roles', $roles);

        $document = array();
        if(!empty($id)) {
            $document = $this->Documents->getDocumentById($id);            
        }

        $this->set('document', $document);
        
    }

    public function role() {
        $this->useModels(array('Roles'));
        $this->template = 'admin/jogosultsag_form';

        $id = $this->getId();

        if(isset($_POST['name'])) {
            $id = $this->Roles->save($_POST);
            if(!empty($id)) {
                $this->msg->setSessionMessage('A mentés sikeres.');
                $url = '?archives/role/' . $id;        
                header("Location: $url");
                exit;
            } else {
                $this->msg->setSessionMessage('A mentés sikertelen!');
            }
        }

        $role = array();
        if(!empty($id)) {
            $role = $this->Roles->getRoleById($id);            
        }

        $this->set('role', $role);
    }

    public function user() {
        $this->useModels(array('Users', 'Roles'));
        $this->template = 'admin/felhasznalo_form';

        $id = $this->getId();
        if(isset($_POST['name'])) {
            $id = $this->Users->save($_POST);
            if(!empty($id)) {
                $this->msg->setSessionMessage('A mentés sikeres.');
                $url = '?archives/user/' . $id;        
                header("Location: $url");
                exit;
            } else {
                $this->msg->setSessionMessage('A mentés sikertelen!');
            }
        }

        $roles = $this->Roles->getRoles();
        $this->set('roles', $roles);

        $user = array();
        if(!empty($id)) {
            $user = $this->Users->getUserById($id);            
        }

        $this->set('user', $user);
    }

    public function deleteDocuments() {
        $this->useModels(array('Documents'));
        $getKey = array_keys($_GET);
        $urlSegments = explode('/', $getKey[0]);
        $table = isset($urlSegments[2]) ? $urlSegments[2] : null;
        $id = isset($urlSegments[3]) ? intval($urlSegments[3]) : null;

        $res = $this->{$table}->delete($id);

        if($res) {
            header("Location: ?archives/backend_doku/");
        } else {
            echo "Hiba a rekord törlésekor!";
        }
    }

    public function deleteCategories() {
        $this->useModels(array('Categories'));
        $getKey = array_keys($_GET);
        $urlSegments = explode('/', $getKey[0]);
        $table = isset($urlSegments[2]) ? $urlSegments[2] : null;
        $id = isset($urlSegments[3]) ? intval($urlSegments[3]) : null;

        $res = $this->{$table}->delete($id);

        if($res) {
            header("Location: ?archives/backend/");
        } else {
            echo "Hiba a rekord törlésekor!";
        }
    }

    public function deletePublishers() {
        $this->useModels(array('Publishers'));
        $getKey = array_keys($_GET);
        $urlSegments = explode('/', $getKey[0]);
        $table = isset($urlSegments[2]) ? $urlSegments[2] : null;
        $id = isset($urlSegments[3]) ? intval($urlSegments[3]) : null;

        $res = $this->{$table}->delete($id);

        if($res) {
            header("Location: ?archives/backend/");
        } else {
            echo "Hiba a rekord törlésekor!";
        }
    }

    public function deleteRoles() {
        $this->useModels(array('Roles'));
        $getKey = array_keys($_GET);
        $urlSegments = explode('/', $getKey[0]);
        $table = isset($urlSegments[2]) ? $urlSegments[2] : null;
        $id = isset($urlSegments[3]) ? intval($urlSegments[3]) : null;

        $res = $this->{$table}->delete($id);

        if($res) {
            header("Location: ?archives/backend_user/");
        } else {
            echo "Hiba a rekord törlésekor!";
        }
    }

    public function deleteUsers() {
        $this->useModels(array('Users'));
        $getKey = array_keys($_GET);
        $urlSegments = explode('/', $getKey[0]);
        $table = isset($urlSegments[2]) ? $urlSegments[2] : null;
        $id = isset($urlSegments[3]) ? intval($urlSegments[3]) : null;

        $res = $this->{$table}->delete($id);

        if($res) {
            header("Location: ?archives/backend_user/");
        } else {
            echo "Hiba a rekord törlésekor!";
        }
    }

    private function getId() {
        $getKey = array_keys($_GET);
        $urlSegments = explode("/", $getKey[0]);
        $id = isset($urlSegments[2]) ? intval($urlSegments[2]) : null;
        return $id;
    }
}




?>