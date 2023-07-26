<? 
include_once('../php/Roles.php');
include_once('../php/Users.php');

$roles = new Roles();
$users = new Users();

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentumtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../js/admin_script.js"></script>
</head>
<body>
    <header class="container-fluid">       
        <div class="row p-3 bg-secondary">
            <h1 class="col-4 col-sm-7 col-lg-8 mb-0">Dokumentum tár - admin</h1>
            <div class="col-8 col-sm-5 col-lg-4">
                <span class="float-end">
                    <img src="" alt="avatar">
                    <span id="user">Felhasználó neve</span>
                    <a href="../index.html"><img src="../img/logout.png" alt="kilépés" title="kilépés"></a>
                </span>
                
            </div>            
        </div>          
    </header>
    <main class="container-fluid">
        <div class="row">
            <div class="col-6 col-md-2" id="navigacio">
                <h2 class="mb-0 bg-secondary p-2">Menü</h2>
                <nav class="navbar pt-0">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link" href="listak.php" >Listák</a>                          
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="kategoria_form.php">Új kategória</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="kiado_form.php">Új kiadó</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dokumentumok.php">Dokumentumok</a>                            
                        </li>
                        <li class="nav-item text-end">                            
                            <a class="nav-link" href="dokumentum_form.php">Új dokumentum</a>                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="felhasznalok.php">Felhasználók</a>                            
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="felhasznalo_form.php">Új felhasználó</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="jogosultsag_form.php">Új jogosultság</a>
                        </li>
                    </ul>
                </nav>
                  
            </div>
            <div class="col-md-7 col-lg-5">
                <h3>Felhasználók</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Név</th>
                        <th>Felhasználónév</th>
                        <th>Jogosultság</th>
                        <th class="text-center">Funkciók</th>
                    </tr>
                    <? foreach ($users->getUsers() as $key => $user) { ?>
                        <tr>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td class="functions">
                                <a href="felhasznalo_form.php?user=<?= $user['id'] ?>"><img src="../img/edit.png" alt="módosítás" title="módosítás"></a>
                                <a href="#" class="delete_rec" table="users" rec_id="<?= $user['id'] ?>"><img src="../img/delete.png" alt="törlés" title="törlés"></a>
                            </td>
                        </tr>
                    <? } ?>
                    <!-- <tr>
                        <td>János</td>
                        <td>janos</td>
                        <td>HR asszisztens</td>
                        <td class="functions">
                            <a href="#"><img src="../img/edit.png" alt="módosítás" title="módosítás"></a>
                            <a href="#"><img src="../img/delete.png" alt="törlés" title="törlés"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Tímea</td>
                        <td>timi</td>
                        <td>admin</td>
                        <td class="functions">
                            <a href="#"><img src="../img/edit.png" alt="módosítás" title="módosítás"></a>
                            <a href="#"><img src="../img/delete.png" alt="törlés" title="törlés"></a>
                        </td>
                    </tr> -->
                </table>
            </div>
            <div class="col-md-3 col-lg-5">
                <h3>Jogosultságok</h3>
                <table class="table table-striped">
                    <tr>
                        <th>Megnevezés</th>
                        <th class="text-center">Funkciók</th>
                    </tr>
                    <? foreach ($roles->getRoles() as $key => $role) { ?>
                        <tr>
                            <td><?= $role['name'] ?></td>
                            <td class="functions">
                                <a href="jogosultsag_form.php?role=<?= $role['id'] ?>"><img src="../img/edit.png" alt="módosítás" title="módosítás"></a>
                                <a href="#" class="delete_rec" table="roles" rec_id="<?= $role['id'] ?>"><img src="../img/delete.png" alt="törlés" title="törlés"></a>
                            </td>
                        </tr>
                    <? } ?>
                    <!-- <tr>
                        <td>HR asszisztens</td>
                        <td class="functions">
                            <a href="#"><img src="../img/edit.png" alt="módosítás" title="módosítás"></a>
                            <a href="#"><img src="../img/delete.png" alt="törlés" title="törlés"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>titkárnő</td>
                        <td class="functions">
                            <a href="#"><img src="../img/edit.png" alt="módosítás" title="módosítás"></a>
                            <a href="#"><img src="../img/delete.png" alt="törlés" title="törlés"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>admin</td>
                        <td class="functions">
                            <a href="#"><img src="../img/edit.png" alt="módosítás" title="módosítás"></a>
                            <a href="#"><img src="../img/delete.png" alt="törlés" title="törlés"></a>
                        </td>
                    </tr> -->
                </table>
            </div>
        </div>
    </main>
</body>
</html>