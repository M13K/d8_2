<?php

namespace Drupal\perf\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'PerfBlock' block.
 *
 * @Block(
 *  id = "perf_block",
 *  admin_label = @Translation("Perf block"),
 * )
 */
class PerfBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
        '#create_placeholder' => TRUE,
        '#lazy_builder' => [
            'perf.lazy_builder:render',
            [],
        ]
    ];
  }

}
