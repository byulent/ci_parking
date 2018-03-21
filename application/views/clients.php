<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.03.18
 * Time: 22:40
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
    <title>Все клиенты</title>
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
                  <li class="nav-item active">
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
                <h1>Все клиенты</h1>
                  <form class="form-inline mb-3">
                      <?= anchor(base_url().'clients/add','Добавить', array('class' => 'btn btn-primary', 'role' => 'button'))?>
                  </form>
                  <div class="table-responsive-sm">
                      <table class="table table-bordered">
                          <thead>
                          <tr>
                              <th scope="col">№</th>
                              <th scope="col">ФИО</th>
                              <th scope="col">Автомобиль</th>
                              <th scope="col">Госномер</th>
                              <th scope="col">Редактировать</th>
                              <th scope="col">Удалить</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($cars as $car) : ?>
                          <tr>
                              <th scope="row"><?= ++$i ?></th>
                              <td><?= $car['full_name'] ?></td>
                              <td><?= $car['label'].' '.$car['model'] ?></td>
                              <td><?= $car['reg_plate'] ?></td>
                              <td><?= anchor(base_url().'clients/edit/'.$car['client_id'],'<i class="fas fa-pencil-alt"></i>', array('class' => 'btn btn-primary', 'role' => 'button'))?></td>
    <!--                          <td><button type="button" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> </button></td>-->
                              <td><?= anchor(base_url().'clients/delete/'.$car['id'],'<i class="fas fa-times"></i>', array('class' => 'btn btn-danger', 'role' => 'button'))?></td>
                          </tr>
                          <?php endforeach; ?>
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