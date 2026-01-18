<section>
    <?php if (! empty($user) && is_array($user)): ?>
        <h3><?= esc($user['username']) ?></h3>
        <?php $session = session(); ?>
        <?= "Bienvenid@ " . $session->get('user') ?>
    <?php else: ?>
        <h3>No users</h3>
        <p>Unable to find any user for you.</p>
    <?php endif ?>
</section>