<?php

namespace Drupal\perf\Services;


use Drupal\Core\Session\AccountProxyInterface;

/**
 * Class PerfLazyBuilderService.
 */
class PerfLazyBuilderService  {

    protected $current_user;

  /**
   * Constructs a new PerfLazyBuilderService object.
   */
  public function __construct(AccountProxyInterface $current_user) {
    $this->current_user = $current_user;
  }

    /**
     * @return array
     */
    public function render() {

      $user = $this->current_user;
      return ['#markup' => t('Hello %name you are in the place' ,
                  [
                      '%name' => $user->getDisplayName(),
                  ]
      )];
  }

}
