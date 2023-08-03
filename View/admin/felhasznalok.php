<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentumtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="Sources/css/style.css">
    <link rel="stylesheet" href="Sources/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="Sources/js/script.js"></script>
    <script src="Sources/js/admin_script.js"></script>
</head>
<body>
    <!-- <header class="container-fluid">       
        <div class="row p-3 bg-secondary">
            <h1 class="col-4 col-sm-7 col-lg-8 mb-0">Dokumentum tár - admin</h1>
            <div class="col-8 col-sm-5 col-lg-4">
                <span class="float-end"> 
                    <? 
                        if(!empty($_SESSION['user'])) { ?> 
                            <img src='Sources/uploads/<?= ($_SESSION['user']['avatar']) ?>' class='userimg'  alt='<?= $_SESSION['user']['name'] ?>' title='<?= $_SESSION['user']['name'] ?>'>
                            <span id="user"><?= $_SESSION['user']['name'] ?></span>
                            <a href="?userhandler/logout"><img src="Sources/img/logout.png" alt="kilépés" title="kilépés"></a>
                        <? } else { ?> 
                            <span id="user">Nincs bejelentkezve...</span>
                            <a href="?userhandler/login"><img src="Sources/img/login.png" alt="belépés" title="belépés"></a>
                        <?}
                    ?> 
                </span>   
            </div>            
        </div>          
    </header> -->
    <? include_once('View/header.php'); ?>
    <main class="container-fluid">
        <div class="row">
            <!-- <div class="col-6 col-md-2" id="navigacio">
                <h2 class="mb-0 bg-secondary p-2">Menü</h2>
                <nav class="navbar pt-0">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link" href="?archives/backend/" >Listák</a>                          
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="?archives/category">Új kategória</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="?archives/publisher">Új kiadó</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?archives/backend_doku/">Dokumentumok</a>                            
                        </li>
                        <li class="nav-item text-end">                            
                            <a class="nav-link" href="?archives/document">Új dokumentum</a>                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="?archives/backend_user/">Felhasználók</a>                            
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="?archives/user">Új felhasználó</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="?archives/role">Új jogosultság</a>
                        </li>
                    </ul>
                </nav>
                  
            </div> -->
            <? $active = "Felhasználók"; include_once('menu.php'); ?>
            <div class="col-md-7 col-lg-5">
                <h3>Felhasználók</h3>
                <button type="button" onclick="location.href='?archives/user';">Új felhasználó</button>
                <table class="table table-striped">
                    <tr>
                        <th>Név</th>
                        <th>Felhasználónév</th>
                        <th>Jogosultság</th>
                        <th class="text-center">Funkciók</th>
                    </tr>
                    <? foreach ($users as $key => $user) { ?>
                        <tr>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td class="functions">
                                <a href="?archives/user/<?= $user['id'] ?>"><img src="Sources/img/edit.png" alt="módosítás" title="módosítás"></a>
                                <a href="#" class="delete_rec" table="Users" rec_id="<?= $user['id'] ?>"><img src="Sources/img/delete.png" alt="törlés" title="törlés"></a>
                            </td>
                        </tr>
                    <? } ?>                    
                </table>
            </div>
            <div class="col-md-3 col-lg-5">
                <h3>Jogosultságok</h3>
                <button type="button" onclick="location.href='?archives/role';">Új jogosultság</button>
                <table class="table table-striped">
                    <tr>
                        <th>Megnevezés</th>
                        <th class="text-center">Funkciók</th>
                    </tr>
                    <? foreach ($roles as $key => $role) { ?>
                        <tr>
                            <td><?= $role['name'] ?></td>
                            <td class="functions">
                                <a href="?archives/role/<?= $role['id'] ?>"><img src="Sources/img/edit.png" alt="módosítás" title="módosítás"></a>
                                <a href="#" class="delete_rec" table="Roles" rec_id="<?= $role['id'] ?>"><img src="Sources/img/delete.png" alt="törlés" title="törlés"></a>
                            </td>
                        </tr>
                    <? } ?>                    
                </table>
            </div>
        </div>
    </main>
</body>
</html>