<section>
    <h2><?= esc($news['title']) ?></h2>
    <p><?= esc($news['body']) ?></p>
    <p>Categoría: <?= esc($news['category']) ?></p>
    <img src="<?= base_url('assets/img/' . $news['image']) ?>" width="300">
    <p>
        <a href="<?= base_url('/') ?>">
            Volver al listado de noticias
        </a>
    </p>    
</section>