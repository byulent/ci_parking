<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.03.18
 * Time: 22:41
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php echo link_tag('css/bootstrap.min.css'); ?>
    <?php echo link_tag('css/fontawesome-all.min.css'); ?>
    <?php echo link_tag('css/styles.css'); ?>
    <title>Клиент</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Онлайн-парковка</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>">Клиенты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url().'parking' ?>">Парковка</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
<div class="container">
    <div class="row">
        <div class="col">
            <div id="client-form-wrapper">
                <?= validation_errors('<div class="alert alert-danger alert-dismissible mt-3" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>') ?>
                <h1>Клиент</h1>
                <form class="client" method="post" action="<?= isset($id) ? base_url().'clients/save_client/'.$id : base_url().'clients/add_client' ?>">
                    <div class="row">
                        <div class="form-group col-6">
                            <input type="text" class="form-control mb-3" id="full_name" name="full_name" placeholder="ФИО" <?= isset($full_name) ? 'value="'.$full_name.'"' : 'value="'.set_value('full_name').'"' ?>>
                            <select class="custom-select form-control mb-3" id="gender" name="gender" title="Пол">
                                <option <?= !isset($gender) ? 'selected' : '' ?>>Пол</option>
                                <option id="male" value="0" <?= isset($gender) && $gender == 0 ? 'selected' : set_select('gender','0') ?>>Мужской</option>
                                <option id="female" value="1" <?= isset($gender) && $gender == 1 ? 'selected' : set_select('gender','1') ?>>Женский</option>
                            </select>
                            <input type="text" class="form-control mb-3" id="address" name="address" placeholder="Адрес" <?= isset($address) ? 'value="'.$address.'"' : "" ?>>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Телефон" <?= isset($phone) ? 'value="'.$phone.'"' : "" ?>>
                        </div>
                        <div class="col-3 align-self-end">
                            <button class="form-control btn-primary mb-3">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php if (isset($id)): ?>
            <div id="cars-form-wrapper">
                <h1>Автомобили</h1>
                <form id="cars" method="post" action="<?= base_url().'clients/save_cars/'.$id; ?>">
                    <div class="row">
                        <div class="col-6">
                            <?php if (isset($cars)): ?>
                            <?php foreach ($cars as $car): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <input type="text" class="form-control mb-3" name="car[<?= $car['id']?>][label]" value="<?= $car['label']?>" placeholder="Марка">
                                    <input type="text" class="form-control mb-3" name="car[<?= $car['id']?>][model]" value="<?= $car['model']?>" placeholder="Модель">
                                    <input type="text" class="form-control mb-3" name="car[<?= $car['id']?>][reg_plate]" value="<?= $car['reg_plate']?>" placeholder="Гос. номер">
                                    <label>Цвет</label>
                                    <input type="color" class="form-control" name="car[<?= $car['id']?>][color]" value="<?= $car['color']?>" placeholder="Цвет">
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <input type="text" class="form-control mb-3" name="new_car[label]" placeholder="Марка">
                                    <input type="text" class="form-control mb-3" name="new_car[model]" placeholder="Модель">
                                    <input type="text" class="form-control mb-3" name="new_car[reg_plate]" placeholder="Гос. номер">
                                    <label>Цвет</label>
                                    <input type="color" class="form-control" name="new_car[color]" placeholder="Цвет">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 align-self-end">
                            <button class="form-control btn-primary mb-3" id="save-cars">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</main>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    <?=isset($id) ? 'var client_id = '.$id : ''?>
</script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/script.js"></script>
</body>
</html>
