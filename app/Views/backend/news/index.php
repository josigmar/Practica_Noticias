<section>
    <h2><?= esc($title) ?></h2>
    <?php if ($news_list !== []): ?>
        <?php foreach ($news_list as $news_item): ?>
            <h3><?= esc($news_item['title']) ?></h3>
            <div class="main">
                <?= esc($news_item['body']) ?>
            </div>
            <br>
            <div class="main">
                Categoría: <b><?= esc($news_item['category']) ?></b>
            </div>
            <a href="<?= base_url('backend/news/' . $news_item['slug']) ?>">View</a>
            <a href="<?= base_url('backend/news/update/' . $news_item['id']) ?>">Edit</a>
            <a href="<?= base_url('backend/news/del/' . $news_item['id']) ?>">Delete</a>
        <?php endforeach ?>
    <?php else: ?>
        <h3>No news</h3>
        <p>Unable to find any news for you.</p>
    <?php endif ?>
</section>