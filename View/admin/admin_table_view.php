<table class="table table-striped">
    <tr>
        <th>Cím</th>
        <th>Kategóriák</th>
        <th>Kiadta</th>
        <th>Rövid szöveg</th>
        <th>Jogosultság</th>
        <th class="text-center">Funkciók</th>
    </tr>
    <? foreach ($documents as $key => $document) { ?>
        <tr>
            <td><?= $document['title'] ?></td>
            <td><?= $document['category'] ?></td>
            <td><?= $document['publisher'] ?></td>
            <td><?= $document['short_text'] ?></td>
            <td><?= $document['role'] ?></td>
            <td class="functions">
                <a href="?archives/document/<?= $document['id'] ?>"><img src="Sources/img/edit.png" alt="módosítás" title="módosítás"></a>
                <a href="#" class="delete_rec" table="Documents" rec_id="<?= $document['id'] ?>"><img src="Sources/img/delete.png" alt="törlés" title="törlés"></a>
            </td>
            
        </tr>
    <? } ?>              
</table>           
