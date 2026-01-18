<?php if ($categories !== []): ?>
    <?php foreach ($categories as $categories_item): ?>
        <li class="menu-item hidden">
            <a href="<?= base_url('/' . $categories_item['id']) ?>">
                <?= esc($categories_item['category']) ?>
            </a>
        </li>
    <?php endforeach ?>
<?php endif ?>