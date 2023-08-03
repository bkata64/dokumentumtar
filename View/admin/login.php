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
</head>
<body>    
    <? include_once('View/header.php'); ?>
    <main class="container-fluid">
        <div class="row">            
            <div class="col-12">                
                <?= $object->msg->getSessionMessage() ?>
                <h3 class="mx-2 text-center" id='logintitle'>Bejelentkezés</h3>
                <form method="post" class="container-fluid" id="ujdoksi_form" enctype="multipart/form-data">                    
                    <div class="row">
                        <div class="col-lg-6 offset-3">
                            <div class="row">
                                <div class="col-4 my-1"><label for="username" class="col-form-label">Felhasználó név:</label></div>
                                <div class="col-7 my-1"><input type="text" class="form-control" name="username" ></div>
                                <div class="col-4 my-1"><label for="password" class="col-form-label">Jelszó:</label></div>
                                <div class="col-7 my-1"><input type="password" class="form-control" name="password" ></div>
                                <div class="col-10 mt-2">
                                    <button type="submit" id="submit" class="btn btn-info m-0">Belépés</button>
                                    <button type="reset" id="reset" class="btn btn-danger m-2" onclick="location.href='?archives/index'">Mégse</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
<body>
</html>