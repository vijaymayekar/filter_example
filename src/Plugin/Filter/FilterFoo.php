<?php

namespace Drupal\filter_example\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to replace "foo".
 *
 * When used in combination with the filter_align filter, this must run last.
 *
 * @Filter(
 *   id = "filter_foo",
 *   title = @Translation("Foo Filter (example)"),
 *   description = @Translation("Every instance of 'foo' in the input text will be replaced with a preconfigured replacement."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 *   settings = {
 *     "filter_example_foo" = "bar"
 *   }
 * )
 */
class FilterFoo extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['filter_example_foo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Substitution string'),
      '#default_value' => $this->settings['filter_example_foo'],
      '#description' => $this->t('The string to substitute for "foo" everywhere in the text.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $replace = $this->settings['filter_example_foo'];
    $new_text = str_replace('foo', $replace, $text);
    return new FilterProcessResult($new_text);
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    $replacement = $this->settings['filter_example_foo'];
    if (!$long) {
      // This string will be shown in the content add/edit form.
      return $this->t('<em>foo</em> replaced with %replacement.', array('%replacement' => $replacement));
    }
    else {
      return $this->t('Every instance of "foo" in the input text will be replaced with a configurable value. You can configure this value and put whatever you want there. The replacement value is "%replacement".', array('%replacement' => $replacement));
    }
  }

}