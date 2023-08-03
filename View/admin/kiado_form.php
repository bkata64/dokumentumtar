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
            <? $active = empty($publisher['id']) ? 'Új kiadó' : ''; include_once('menu.php'); ?>
            <div class="col-5 offset-3">
                <?= $object->msg->messages() ?>
                <?= $object->msg->getSessionMessage() ?>
                <h3 class="mx-2 text-center"><?= empty($publisher['id']) ? 'Új kiadó' : 'Kiadó módosítása' ?></h3>
                <form method="post" class="container-fluid" id="ujkiado_form">
                    <input type='hidden' name='id' value='<?= empty($publisher['id']) ? null : $publisher['id'] ?>'>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-1"><label for="name" class="col-form-label">Név:</label></div>
                                <div class="col-10"><input type="text" class="form-control" name="name" value='<?= empty($publisher['name']) ? '' : $publisher['name'] ?>'></div>
                            </div>
                        </div>                            
                        <div class="col-12 mt-2">
                            <button type="submit" id="submit" class="btn btn-info my-2">Ment</button>
                            <button type="reset" id="reset" class="btn btn-danger my-2" onclick="location.href='?archives/backend'">Mégse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>