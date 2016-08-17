<?php
/**
 * @file
 * Contains \Drupal\di\Version\DrupalVersion class.
 */
namespace Drupal\di\Version;
use Drupal\Core\Session\AccountInterface;

class DrupalVersion {

  /**
   * Function to get current Drupal version.
   * @return string
   */
  public function getDrupalVersion() {
    return \Drupal::VERSION;
  }
}
