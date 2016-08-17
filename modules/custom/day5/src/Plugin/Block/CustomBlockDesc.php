<?php
/**
 * @file
 * Contains Drupal\day5\Plugin\Block\CustomBlockDesc.
 */

namespace Drupal\day5\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Custom block definition in D8.
 *
 * @Block(
 *   id = "custom_block_desc",
 *   admin_label = @Translation("GJ Custom Block"),
 *   category = @Translation("GJ")
 * )
 */
class CustomBlockDesc extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => '<div>This is a custom block</div>',
    );
  }
}
