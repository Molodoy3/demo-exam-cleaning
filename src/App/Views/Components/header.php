<header class="header">
    <div class="header__container">
        <a href="/" class="header__logo">Всё не сам</a>
        <nav class="header__menu">
            <ul>
                <li><a href="/">Главная</a></li>

                <?php if (empty($_SESSION)) { ?>
                    <li><a href="/register">Зарегистрироваться</a></li>
                    <li><a href="/login">Войти</a></li>
                <?php } else { ?>
                    <li><a href="/services">Мои заявки</a></li>
                    <?php if ($_SESSION['is_admin']) { ?>
                        <li><a href="/service/manager">Управление заявками</a></li>
                    <?php } ?>
                    <li><a href="/service/create">Создать заявку</a></li>
                    <li><a href="/logout">Выйти</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>