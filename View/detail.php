
<!-- <div class="row">
<div class="col-lg-5 offset-4 p-0" id="reszletek"> -->

        <header class="mr-0">               
            <h2 class="mb-3 bg-secondary p-2">Dokumentum részletes nézete</h2>
            <div class="row px-3">
                <div class="col-4">
                    
                        <img src='Sources/uploads/<?= $document['logo_url'] ?>' alt='<?= !empty($document['title']) ? $document['title'] : '' ?>' title='<?= !empty($document['title']) ? $document['title'] : '' ?>' class="img-fluid">
                              
                </div>
                <div class="col-8 text-end">
                    <?= $document['category'] ?>   
                </div>           
            </div>
        </header>
        <div class="p-4 mr-2">
            <h3><?= $document['title'] ?></h3>
            <p><?= $document['content'] ?></p>
            
            <p class="text-end" id="author"><?= $document['publisher'] ?></p>
        </div>
    <!-- </div>
</div> -->
