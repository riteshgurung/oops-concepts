<?php
/**
 * @file
 *   File to respond to events.
 */

namespace Drupal\di\EventSubscriber;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DiSubscriber implements EventSubscriberInterface {

  /**
   * DiSubscriber constructor.
   * @param AccountProxyInterface $user
   * @param LoggerChannelFactoryInterface $logger
   * @param CurrentPathStack $current_path
   */
  public function __construct(AccountProxyInterface $user, LoggerChannelFactoryInterface $logger, CurrentPathStack $current_path) {
    $this->user = $user;
    $this->logger = $logger;
    $this->current_path = $current_path;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('getCurrentUserDetails');
    return $events;
  }

  /**
   * Function to get details of the current user.
   */
  public function getCurrentUserDetails() {

    // Log only for authenticated users.
    if ($this->user->isAuthenticated()) {
      $message = '';
      $roles = implode(', ', $this->user->getRoles());

      // Format message.
      $message .= 'User %user with role(s) %roles accessed page %page.';

      // Log a DB message.
      $this->logger->get('di')->notice($message, array(
        '%user' => $this->user->getDisplayName(),
        '%roles' => $roles,
        '%page' => $this->current_path->getPath()
      ));
    }
  }
}
