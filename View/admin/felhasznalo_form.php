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
</head>
<body>    
    <? include_once('View/header.php'); ?>
    <main class="container-fluid">
        <div class="row">            
            <? $active = empty($user['id']) ? 'Új felhasználó' : ''; include_once('menu.php'); ?>
            <div class="col-5 offset-2">
                <?= $object->msg->messages() ?>
                <?= $object->msg->getSessionMessage() ?>
                <h3 class="mx-2 text-center"><?= empty($user['id']) ? 'Új felhasználó' : 'Felhasználó módosítása' ?></h3>
                <form method="post" class="container-fluid" id="ujfelhasznalo_form"  enctype="multipart/form-data">
                    <input type='hidden' name='id' value='<?= empty($user['id']) ? null : $user['id'] ?>'>
                    <input type='hidden' name='avatar' value='<?= empty($user['avatar']) ? null : $user['avatar'] ?>'>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4"><label for="name" class="col-form-label">Név:</label></div>
                                <div class="col-7"><input type="text" class="form-control mt-2" name="name" value='<?= empty($user['name']) ? '' : $user['name'] ?>'></div>
                                <div class="col-4"><label for="username" class="col-form-label">Felhasználó név:</label></div>
                                <div class="col-7"><input type="text" class="form-control mt-2" name="username" value='<?= empty($user['username']) ? '' : $user['username'] ?>'></div>
                                <div class="col-4"><label for="password" class="col-form-label">Jelszó:</label></div>
                                <div class="col-7"><input type="password" class="form-control mt-2" name="password" minlength="8" value=''></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label for="role_id" class="col-4 form-label">Jogosultság:</label></div>
                                <div class="col-7">
                                    <select name="role_id" id="role_id" class="form-select">
                                        <? foreach ($roles as $role) { ?>
                                            <option value="<?= $role['id'] ?>" <?= (!empty($user['role_id']) && $user['role_id'] == $role['id']) ? 'selected' : '' ?>><?= $role['name'] ?></option>                                            
                                        <? } ?>                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label for="kep" class="form-label">Avatar:</label>
                                <? if(!empty($user['avatar'])) { ?>
                                    <img src='Sources/uploads/<?= $user['avatar'] ?>' alt='<?= !empty($user['name']) ? $user['name'] : '' ?>' title='<?= !empty($user['name']) ? $user['name'] : '' ?>' class="img-fluid">
                                <? } ?>
                                </div>
                                <div class="col-7"><input type="file" name="kep" id="kep" class="form-control"></div>
                            </div>   
                        </div>                            
                        <div class="col-12 mt-2">
                            <button type="submit" id="submit" class="btn btn-info my-2">Ment</button>
                            <button type="reset" id="reset" class="btn btn-danger my-2" onclick="location.href='?archives/backend_user'">Mégse</button>
                        </div>
                    </div>
                </form>
            </div>
    </main>
</body>
</html>