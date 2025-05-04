<?php

use App\DTO\Service\CreateServiceDTO;

/** @var CreateServiceDTO $createServicePDO */
/** @var array $errors */
/** @var array $serviceTypes */
/** @var array $payloadTypes */

?>


<section class="form">
    <div class="form__container">
        <h1>Создание заявки</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form__item">
                <label for="service_type_id">Выберите тип услуги</label>
                <select name="service_type_id" id="service_type_id">
                    <option value="" selected>-</option>
                    <?php foreach ($serviceTypes as $serviceType) { ?>
                        <option
                            <?= $createServicePDO->service_type_id === $serviceType['service_type_id'] ? 'selected' : '' ?>
                            value="<?=$serviceType['service_type_id']?>">
                            <?=$serviceType['name']?>
                        </option>
                     <?php } ?>
                </select>
                <?php if (isset($errors['service_type_id'])) {
                    foreach ($errors['service_type_id'] as $error) { ?>
                        <div class="error"><?= htmlspecialchars($error) ?></div>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="address">Введите свой адрес</label>
                <input name="address" id="address" type="text" value="<?= htmlspecialchars($createServicePDO->address) ?>">
                <?php if (isset($errors['address'])) {
                    foreach ($errors['address'] as $error) { ?>
                        <div class="error"><?= htmlspecialchars($error) ?></div>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="contact">Введите свои контакты (телефон или почта)</label>
                <input name="contact" id="contact" type="text" value="<?= htmlspecialchars($createServicePDO->contact) ?>">
                <?php if (isset($errors['contact'])) {
                    foreach ($errors['contact'] as $error) { ?>
                        <div class="error"><?= htmlspecialchars($error) ?></div>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="datetime">Укажите дату и время</label>
                <input name="datetime" id="datetime" type="datetime-local" value="<?= htmlspecialchars($createServicePDO->datetime) ?>">
                <?php if (isset($errors['datetime'])) {
                    foreach ($errors['datetime'] as $error) { ?>
                        <div class="error"><?= htmlspecialchars($error) ?></div>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="paylooad_type_id">Выберите тип оплаты</label>
                <select name="paylooad_type_id" id="service_type_id">
                    <?php foreach ($payloadTypes as $payloadType) { ?>
                        <option
                            <?= $createServicePDO->paylooad_type_id === $payloadType['paylooad_type_id'] ? 'selected' : '' ?>
                            value="<?=$payloadType['paylooad_type_id']?>">
                            <?=$payloadType['name']?></option>
                    <?php } ?>
                </select>
                <?php if (isset($errors['paylooad_type_id'])) {
                    foreach ($errors['paylooad_type_id'] as $error) { ?>
                        <div class="error"><?= htmlspecialchars($error) ?></div>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="image">Загрузите картинку</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>

            <button type="submit" class="button">Создать заявку</button>
        </form>
    </div>
</section>
