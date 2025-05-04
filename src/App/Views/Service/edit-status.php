<?php

/** @var array $service */
/** @var array $statuses */

?>

<section class="edit-status">
    <div class="edit-status__container">
        <h1>Редактирование статуса</h1>
        <h2 style="margin-bottom: 20px">Заявка <?= $service['service_id'] ?></h2>
        <h3 style="margin-bottom: 20px"><?= $service['service_types_name'] ?></h3>
        <form action="" method="post" class="form">
            <div class="form__item">
                <label for="service_status_id">Статус заявки</label>
                <select name="service_status_id" id="service_status_id">
                    <option selected value="">Без статуса</option>
                    <?php foreach ($statuses as $status) { ?>
                        <option
                            <?= $service['service_status_id'] === $status['service_statuse_id'] ? 'selected' : '' ?>
                            value="<?=$status['service_statuse_id']?>">
                            <?=$status['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="button">Сохранить</button>
        </form>
    </div>
</section>
