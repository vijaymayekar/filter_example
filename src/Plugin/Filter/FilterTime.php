<?php

namespace Drupal\filter_example\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;

/**
 * Provides a filter to replace "foo".
 *
 * When used in combination with the filter_align filter, this must run last.
 *
 * @Filter(
 *   id = "filter_time",
 *   title = @Translation("Time Tag (example)"),
 *   description = @Translation("Every instance of the special &lt;time /&gt; tag will be replaced with the current date and time in the user's specified time zone."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class FilterTime extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function prepare($text, $langcode) {
    return preg_replace('!&lt;time ?/&gt;!', '[filter-example-time]', $text);
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $new_text = str_replace('[filter-example-time]', '<em>' . format_date(time()) . '</em>', $text);
    return new FilterProcessResult($new_text);
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return $this->t('<em>&lt;time /&gt;</em> is replaced with the current time.');
  }

}