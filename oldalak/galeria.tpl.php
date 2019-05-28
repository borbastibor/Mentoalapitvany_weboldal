<h2 class="gallery">Videó galéria</h2>
<div class="mediabox2">
    <video width="320" height="240" controls>
        <source src="videok/ambulancecar001.mp4" type="video/mp4">
        Az ön böngészője nem támogatja a beágyazott videókat!
    </video>
    <video width="320" height="240" controls>
        <source src="videok/ambulancecar002.mp4" type="video/mp4">
        Az ön böngészője nem támogatja a beágyazott videókat!
    </video>
    <video width="320" height="240" controls>
        <source src="videok/ambulancecar003.mp4" type="video/mp4">
        Az ön böngészője nem támogatja a beágyazott videókat!
    </video>
</div>
<br>
<h2 class="gallery">Kép galéria</h2>
<div class="mediabox2">
    <?php
        $lines = file('kepek/kepek.txt');
        foreach ($lines as $line_num => $line) { ?>
            <div class="mediabox2item">
                <a target="_blank" href="<?php echo('kepek/' . $line); ?>"><img class="gallery" src="<?php echo('kepek/' . $line); ?>"></a>
            </div>
        <?php }
    ?>
</div>
<hr>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        Válassz egy képet:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input class="searchbutton" type="submit" name="kepfeltoltes" value="Feltöltés">
    </form>
</div>