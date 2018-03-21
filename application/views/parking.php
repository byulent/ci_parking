<?php
#defined('BASEPATH') OR exit('No direct script access allowed');
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
    <title>Сейчас на парковке</title>
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
                <li class="nav-item active">
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
            <h1>Сейчас на парковке</h1>
            <form class="form-inline mb-3" method="post" action="<?=base_url().'parking/park'?>">
                <select class="form-control mr-3 custom-select" name="full_name" onchange="location='/ci_parking/parking/'+this.value">
                    <option selected>ФИО</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?=$client['id']?>" <?=isset($selected['client']) && $selected['client'] ==
                        $client['id'] ? 'selected' : ''?>><?=$client['full_name']?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-control mr-3 custom-select" name="car">
                    <option selected>Автомобиль</option>
                    <?php foreach ($cars as $car): ?>
                        <option value="<?=$car['id']?>"><?=$car['label'].' '.$car['model'].' ('.$car['reg_plate'].')'?></option>
                    <?php endforeach; ?>
                </select>
                <button class="form-control btn-primary">Въехал</button>
            </form>
            <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Автомобиль</th>
                        <th scope="col">Госномер</th>
                        <th scope="col">Выехал</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parked as $car) : ?>
                        <tr>
                            <th scope="row"><?= ++$i ?></th>
                            <td><?= $car['full_name'] ?></td>
                            <td><?= $car['label'].' '.$car['model'] ?></td>
                            <td><?= $car['reg_plate'] ?></td>
                            <td><?= anchor(base_url().'parking/unpark/'.$car['id'],'Выехал', array('class' => 'btn btn-primary', 'role' => 'button'))?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
            <?= $this->pagination->create_links() ?>
        </div>
    </div>
</div>
</main>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
</body>
</html>
