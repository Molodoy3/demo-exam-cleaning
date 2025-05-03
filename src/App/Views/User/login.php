<?php

use App\DTO\User\LoginDTO;
/** @var LoginDTO $loginDTO */

?>

<section>
    <form action="" method="post" class="form">
        <div class="form__container">
            <div class="form__item">
                <label for="login">Логин</label>
                <input value="<?= $loginDTO->login ?>" type="text" id="login" placeholder="Введите логин" name="login">
            </div>
            <div class="form__item">
                <label for="password">Пароль</label>
                <input value="<?= $loginDTO->password ?>" type="password" id="password" placeholder="Введите пароль" name="password">
            </div>

            <?php if(isset($errors['common'])) {
                foreach ($errors['common'] as $error) { ?>
                    <span class="error"><?= $error ?></span>
                <?php }} ?>

            <button style="margin-top: 15px" class="button" type="submit">Войти</button>
        </div>

    </form>
</section>
