<? 

include_once('../php/Documents.php');
include_once('../php/Categories.php');
include_once('../php/Publishers.php');
include_once('../php/Roles.php');
include_once('../php/Users.php');

switch ($_GET['t']) {
    case 'documents':
        $documents = new Documents();
        $res = $documents->delete(intval($_GET['id']));
        if(!$res) {
            echo "hiba a dokumentum törlése során, id: " . $_GET['id'];
        } else {
            header("Location: ../admin/dokumentumok.php");
        }       
        break;
    case 'categories':
        $categories = new Categories();
        $res = $categories->delete(intval($_GET['id']));
        if(!$res) {
            echo "hiba a kategória törlése során, id: " . $_GET['id'];
        } else {
            header("Location: ../admin/listak.php");
        }
        break;
    case 'publishers':
        $publishers = new Publishers();
        $res = $publishers->delete(intval($_GET['id']));
        if(!$res) {
            echo "hiba a kiadó törlése során, id: " . $_GET['id'];
        } else {
            header("Location: ../admin/listak.php");
        }
        break;
    case 'roles':
        $roles = new Roles();
        $res = $roles->delete(intval($_GET['id']));
        if(!$res) {
            echo "hiba a jogosultság törlése során, id: " . $_GET['id'];
        } else {
            header("Location: ../admin/felhasznalok.php");
        }
        break;
    case 'users':
        $users = new Users();
        $res = $users->delete(intval($_GET['id']));
        if(!$res) {
            echo "hiba a felhasználó törlése során, id: " . $_GET['id'];
        } else {
            header("Location: ../admin/felhasznalok.php");
        }
        break;
        
    
    default:
        # code...
        break;
}

// if($res) {
//     header("Location: ../admin/dokumentumok.php");
// }


?>