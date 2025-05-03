<?php

use App\DTO\User\RegisterDTO;
/** @var RegisterDTO $registerDTO */

?>

<section>
    <form action="" method="post" class="form">
        <div class="form__container">
            <div class="form__item">
                <label for="full_name">ФИО</label>
                <input value="<?= $registerDTO->full_name ?>" type="text" id="full_name" placeholder="Введите ФИО" name="full_name">
                <?php if(isset($errors['full_name'])) {
                    foreach ($errors['full_name'] as $error) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="login">Логин</label>
                <input value="<?= $registerDTO->login ?>" type="text" id="login" placeholder="Введите логин" name="login">
                <?php if(isset($errors['login'])) {
                    foreach ($errors['login'] as $error) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="email">Почта</label>
                <input value="<?= $registerDTO->email ?>" type="text" id="email" placeholder="Введите почту" name="email">
                <?php if(isset($errors['email'])) {
                    foreach ($errors['email'] as $error) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="telephone">Телефон</label>
                <input value="<?= $registerDTO->telephone ?>" type="text" id="telephone" placeholder="Введите телефон" name="telephone">
                <?php if(isset($errors['telephone'])) {
                    foreach ($errors['telephone'] as $error) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="password">Пароль</label>
                <input value="<?= $registerDTO->password ?>" type="password" id="password" placeholder="Введите пароль" name="password">
                <?php if(isset($errors['password'])) {
                    foreach ($errors['password'] as $error) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php }} ?>
            </div>
            <div class="form__item">
                <label for="password_confirmation">Подтверждение пароля</label>
                <input value="<?= $registerDTO->password_confirmation ?>" type="password" id="password_confirmation" placeholder="Введите пароль повторно" name="password_confirmation">
                <?php if(isset($errors['password_confirmation'])) {
                    foreach ($errors['password_confirmation'] as $error) { ?>
                        <span class="error"><?= $error ?></span>
                    <?php }} ?>
            </div>

            <button class="button" type="submit">Зарегистрироваться</button>
        </div>

    </form>
</section>
