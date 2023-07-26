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
            <div class="col-2" id="navigacio">
                <h2 class="mb-0 bg-secondary p-2">Menü</h2>
                <nav class="navbar pt-0">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link" href="listak.html" >Listák</a>                          
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="kategoria_form.html">Új kategória</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="kiado_form.html">Új kiadó</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dokumentumok.html">Dokumentumok</a>                            
                        </li>
                        <li class="nav-item text-end">                            
                            <a class="nav-link active" href="dokumentum_form.html">Új dokumentum</a>                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="felhasznalok.html">Felhasználók</a>                            
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="felhasznalo_form.html">Új felhasználó</a>
                        </li>
                        <li class="nav-item text-end">
                            <a class="nav-link" href="jogosultsag_form.html">Új jogosultság</a>
                        </li>
                    </ul>
                </nav>                  
            </div>
            <div class="col-10">
                <h3 class="mx-2 text-center">Új dokumentum</h3>
                <form action="action_page" method="post" class="container-fluid" id="ujdoksi_form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-4"><label for="cim" class="col-form-label">Cím:</label></div>
                                <div class="col-7"><input type="text" class="form-control" name="cim"></div>
                            </div>

                            <div class="row">
                                <div class="col-4"><label for="kiado" class="form-label">Kiadó:</label></div>
                                <div class="col-7">
                                    <select name="kiado" id="" class="form-select">
                                        <option value="">Ügyvezetés</option>
                                        <option value="">HR osztály</option>
                                        <option value="">Pénzügyi osztály</option>
                                    </select>
                                </div>  
                            </div>

                            <div class="row">
                                <label class="col-4">Kategóriák:</label>
                                <div class="col-7">
                                    <div class="form-check">
                                        <input type="checkbox" name="intezkedesi" id="intezkedesi" class="form-check-input" checked>
                                        <label for="intezkedesi" class="form-check-label">intézkedési terv</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="utasitas" id="utasitas" class="form-check-input">
                                        <label for="utasitas" class="form-check-label">utasitás</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="nyomtatvany" id="nyomtatvany" class="form-check-input">
                                        <label for="nyomtatvany" class="form-check-label">nyomtatvány</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4"><label for="rovidszoveg" class="col-form-label">Rövid szöveg:</label></div>
                                <div class="col-7"><textarea name="rovidszoveg" id="" cols="10" rows="5" class="form-control"></textarea></div>
                            </div>  

                            <div class="row">
                                <div class="col-4"><label for="feltoltes" class="form-label">Logo:</label></div>
                                <div class="col-7"><input type="file" name="feltoltes" id="" class="form-control"></div>
                            </div>
                            <!-- <button type="button" name="feltolt_btn" id="" class="btn btn-warning">Feltöltés</button> -->

                            <div class="row">
                                <div class="col-4"><label for="kiado" class="col-4 form-label">Jogosultság:</label></div>
                                <div class="col-7">
                                    <select name="kiado" id="" class="form-select">
                                        <option value="">munkavállaló</option>
                                        <option value="">HR asszisztens</option>
                                        <option value="">titkárnő</option>
                                        <option value="">admin</option>
                                    </select>
                                </div>
                            </div>

                            
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-2"><label for="tartalom" class="form-label">Tartalom:</label></div>
                                <div class="col-9"><textarea name="tartalom" id="" cols="60" rows="20" class="form-control"></textarea></div>
                            </div>
                        </div>
                        <div class="col-5 mt-2">
                            <button type="submit" name="submit" id="submit" class="btn btn-info m-2">Ment</button>
                            <button type="reset" name="reset" id="reset" class="btn btn-danger m-2" onclick="location.href='dokumentumok.html'">Mégse</button>
                        </div>
                    </div>
                </form>
            </div>
</body>
</html>
