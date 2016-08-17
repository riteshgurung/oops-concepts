<?php
/**
 * @file
 * Contains \Drupal\di\Controller\UserInfo class.
 */
namespace Drupal\di\Controller;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\di\Version\DrupalVersion;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserInfoController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('di.drupal_version'),
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(DrupalVersion $drupalVersion, AccountProxyInterface $currentUser) {
    $this->drupalVersion = $drupalVersion;
    $this->currentUser = $currentUser;
  }

  /**
   * Function to render current user with Drupal Version.
   *
   * TODO: theme this function the D8 way - twigs.
   */
  public function render() {
    $output = '';

    // Check if this is authenticated or anonymous user.
    if ($this->currentUser->isAuthenticated()) {
      $output .= '<strong>Name </strong>: ' . $this->currentUser->getAccountName();
      $output .= '<br />';
      $output .= '<strong>Email </strong>: ' . $this->currentUser->getEmail();
      $output .= '<br />';
      $output .= '<strong>Roles </strong>: ' . implode(', ', $this->currentUser->getRoles());
      $output .= '<br />';
      $output .= '<strong>Version </strong>: ' . $this->drupalVersion->getDrupalVersion();
      $output .= '<br />';
    }
    else {
      $output .= $this->t('This is an anonymous user using Drupal version @version', array('@version' => $this->drupalVersion->getDrupalVersion()));
    }

    return array(
      '#markup' => $output
    );
  }
}
