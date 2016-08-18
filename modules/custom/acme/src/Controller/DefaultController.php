<?php

namespace Drupal\acme\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Drupal\node\Entity\Node;
use Drupal\image\Plugin\Field\FieldType\ImageItem;

class DefaultController extends ControllerBase {
  public function hello($name) {
    // the {name} in the route gets captured as $name variable
    // in the function called
    // $this->userList();
    // $this->nodeList();
    return [
      '#theme' => 'hello_page',
      '#data' => array('name' => $name,'greetings' => $this->getGreetings(), 'user' => $this->userList()),
      '#item' => array('href' => '/', 'caption' => $name . ' phone number'),
      '#attached' => [
        'library' => [
          'acme/acme-styles', //include our custom library for this response
        ]
      ]
    ];
  }

  private function getGreetings() {
    $salutations = array(
    "Adab",
    "Ahoj",
    "An-nyeong-ha-se-yo",
    "Apa khabar",
    "Barev Dzez",
    "Buenos días",
    "Bula Vinaka",
    "Chào",
    "Ciao",
    "Dia Duit",
    "Hallo",
    "Hallå",
    "Halló",
    "Halo",
    "Haye",
    "Hei",
    "Hej",
    "Hello",
    "Helo",
    "Hola",
    "Kamusta",
    "Konnichiwa",
    "Merhaba",
    "Mingalarba",
    "Namaskar",
    "Namaste",
    "Olá",
    "Pryvit",
    "Pryvitannie",
    "Përshëndetje",
    "Salam",
    "Salut",
    "Sat Sri Akal",
    "Sholem aleikhem",
    "Sveiki",
    "Szia",
    "Tere",
    "Zdraveĭte",
    "Zdravo" );
    $salutation = $salutations[rand(0, count($salutations) - 1)];
    return $salutation;
  }

  private function userList() {
    $result = array();
    $user_storage = \Drupal::entityManager()->getStorage('user');
    $query = \Drupal::entityQuery('user')
    ->condition('status', 1);
    $data = $query->execute();
    $user_data = $user_storage->loadMultiple(array_keys($data));
    foreach($user_data as $user) {
        $result[] = $user->getAccountName();
    }
    return $result;
  }

  private function nodeList() {
    $node_storage = \Drupal::entityManager()->getStorage('node');
    $query = \Drupal::entityQuery('node')
    ->condition('status', 1);
    $data = $query->execute();
    print_r($data);
    $node_data = $node_storage->loadMultiple(array_keys($data));
    foreach($node_data as $node) {
        // echo '<pre>',print_r($node);
        echo '<pre>',print_r($node->uri());
    }

    die();
  }
}
