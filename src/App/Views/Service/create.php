<?php

use App\DTO\Service\CreateServiceDTO;

/** @var CreateServiceDTO $createServicePDO */
/** @var array $errors */

?>


<section class="form">
    <div class="form__container">
        <h1>Создание заявки</h1>
        <form action="" method="post">
            <div class="form__item">
                <label for="address">Введите свой адрес</label>
                <input name="address" id="address" type="text" value="<?= htmlspecialchars($createServicePDO->address) ?>">
                <?php if (isset($errors['address'])) {
                    foreach ($errors['address'] as $error) { ?>
                        <div class="error"><?= htmlspecialchars($error) ?></div>
                    <?php }} ?>
            </div>

            <button type="submit" class="button">Создать заявку</button>
        </form>
    </div>
</section>
