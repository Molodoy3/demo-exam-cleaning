<?php

/** @var array $services */

?>

<section class="services">
    <div class="services__container">
        <h1>Управление заявки</h1>
        <div class="services__row">
            <?php foreach ($services as $service) { ?>
                <a href="/service/edit-status?id=<?=$service['service_id']?>" class="services__item">
                    <div class="services__image">
                        <img src="/public/img/<?=$service['service_id']?>.jpg" onerror="this.src='/public/img/default.png'" alt="Картинка">
                    </div>
                    <div class="services__content">
                        <div class="services__type"><?=$service['service_types_name']?></div>
                        <div class="services__datetime"><?=date('d.m.Y H:i', strtotime($service['datetime']))?></div>
                        <div class="services__status"><?=$service['service_statuses_name']?></div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</section>
