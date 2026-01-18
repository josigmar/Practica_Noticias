<main class="container">
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic">
                <?= $headingNews['title'] ?>
            </h1>
            <p>
                <?= $headingNews['body'] ?>
            </p>
            <p class="lead mb-0">
                <a href="#" class="text-body-emphasis fw-bold">Continue reading...</a>
            </p>
        </div>
    </div>
    <div class="row mb-2">
        <?php if ($lastestNews !== []): ?>
            <?php foreach ($lastestNews as $last_news_item): ?>
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary-emphasis"></strong>
                            <h3 class="mb-0"><?= esc($last_news_item['title']) ?></h3>
                            <div class="mb-1 text-body-secondary"><?= esc($last_news_item['category']) ?></div>
                            <p class="mb-auto">
                                <?= esc($last_news_item['body']) ?>
                            </p>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="<?= base_url('assets/img/') . $last_news_item['image'] ?>" class="bd-placeholder-img card-img-right" width="200" height="250" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <h3>No news</h3>
            <p>Unable to find any news for you.</p>
        <?php endif ?>
    </div>
    <div class="row g-5">
        <div class="col-md-8">
            <?php if ($news_list !== []): ?>
                <?php foreach ($news_list as $news_item): ?>
                    <article class="blog-post">
                        <h2 class="display-5 link-body-emphasis mb-1"><?= esc($news_item['title']) ?></h2>
                        <p class="blog-post-meta">
                            <a href="<?= base_url('category/' . $news_item['id_category']) ?>">
                                <b><?= esc($news_item['category']) ?></b>
                            </a>                  
                        </p>
                        <p><?= esc($news_item['body']) ?></p>
                        <hr />
                    </article>
                <?php endforeach ?>
            <?php else: ?>
                <h3>No news</h3>
                <p>Unable to find any news for you.</p>
            <?php endif ?>
        </div>
    </div>
</main>        