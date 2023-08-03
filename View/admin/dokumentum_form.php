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
            <? $active = empty($document['id']) ? 'Új dokumentum' : ''; include_once('menu.php'); ?>
            <div class="col-10">
                <?= $object->msg->messages() ?>
                <?= $object->msg->getSessionMessage() ?>
                <h3 class="mx-2 text-center"><?= empty($document['id']) ? 'Új dokumentum' : 'Dokumentum módosítása' ?></h3>
                <form method="post" class="container-fluid" id="ujdoksi_form" enctype="multipart/form-data">
                    <input type='hidden' name='id' value='<?= empty($document['id']) ? null : $document['id'] ?>'>
                    <input type='hidden' name='logo_url' value='<?= empty($document['logo_url']) ? null : $document['logo_url'] ?>'>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-4"><label for="title" class="col-form-label">Cím:</label></div>
                                <div class="col-7"><input type="text" class="form-control" name="title" value='<?= empty($document['title']) ? '' : $document['title'] ?>'></div>
                            </div>

                            <div class="row">
                                <div class="col-4"><label for="publisher_id" class="form-label">Kiadó:</label></div>
                                <div class="col-7">
                                    <select name="publisher_id" id="" class="form-select">
                                        <? foreach ($publishers as $publisher) { ?>
                                            <option value="<?= $publisher['id'] ?>" <?= !empty($document['publisher_id']) && $document['publisher_id'] == $publisher['id'] ? 'selected' : '' ?>><?= $publisher['name'] ?></option>                                            
                                        <? } ?> 
                                    </select>
                                </div>  
                            </div>

                            <div class="row">
                                <label class="col-4">Kategóriák:</label>
                                <div class="col-7">
                                    <? 
                                        $catArray = !empty($document['category_ids']) ? explode(', ', $document['category_ids']) : array();
                                        foreach ($categories as $category) { ?>
                                        <div class="form-check">
                                            <input type="checkbox" name="kategoria[<?= $category['id'] ?>]" id="kategoria[<?= $category['id'] ?>]" class="form-check-input" <?= in_array($category['id'], $catArray) ? 'checked' : '' ?>>
                                            <label for="kategoria[<?= $category['id'] ?>]" class="form-check-label"><?= $category['name'] ?></label>
                                        </div>                                        
                                    <? } ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4"><label for="short_text" class="col-form-label">Rövid szöveg:</label></div>
                                <div class="col-7"><textarea name="short_text" id="" cols="10" rows="5" class="form-control"><?= empty($document['short_text']) ? 'Rövid leírás' : $document['short_text'] ?></textarea></div>
                            </div>  

                            

                            <div class="row">
                                <div class="col-4"><label for="kep" class="form-label">Logo:</label>
                                <? if(!empty($document['logo_url'])) { ?>
                                    <img src='Sources/uploads/<?= $document['logo_url'] ?>' alt='<?= !empty($document['title']) ? $document['title'] : '' ?>' title='<?= !empty($document['title']) ? $document['title'] : '' ?>' class="img-fluid">
                                <? } ?>
                                </div>
                                <div class="col-7"><input type="file" name="kep" id="kep" class="form-control"></div>
                            </div>                            

                            <div class="row">
                                <div class="col-4"><label for="role_id" class="col-4 form-label">Jogosultság:</label></div>
                                <div class="col-7">
                                    <select name="role_id" id="" class="form-select">
                                        <? foreach ($roles as $role) { ?>
                                            <option value="<?= $role['id'] ?>" <?= !empty($document['role_id']) && $document['role_id'] == $role['id'] ? 'selected' : '' ?>><?= $role['name'] ?></option>                                            
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-2"><label for="content" class="form-label">Tartalom:</label></div>
                                <div class="col-9"><textarea name="content" id="" cols="60" rows="20" class="form-control"><?= empty($document['content']) ? 'Dokumentum tartalma...' : $document['content'] ?></textarea></div>
                            </div>
                        </div>
                        <div class="col-5 mt-2">
                            <button type="submit" name="submit" id="submit" class="btn btn-info m-2">Ment</button>
                            <button type="reset" name="reset" id="reset" class="btn btn-danger m-2" onclick="location.href='?archives/backend_doku'">Mégse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
