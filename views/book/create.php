<div class="container">
    <main>
        <form action="router.php?r=book/store" method="post" class="needs-validation row justify-content-center">
            <div class="row gy-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome livro</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="book-isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" required>
                </div>
                <div class="col-md-6">
                    <label for="genre_id">Genre:</label><br>
                    <select name="genre_id">
                        <?php foreach($genres as $genre){?>
                        <option value="<?= $genre->id?>"> <?= $genre->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button class="w-100 btn btn-primary btn-lg" type="submit">go</button>
        </form>
    </main>
</div>