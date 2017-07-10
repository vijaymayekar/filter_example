<?php

namespace Drupal\filter_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Controller routines for Theme example routes.
 */
class FilterExampleController extends ControllerBase
{

  /**
   * Constructs a simple page.
   *
   */
  public function getContent()
  {

    return array(
      '#markup' => '<p>' . $this->t('This example provides two filters.') . '</p><p>' . $this->t('Foo Filter replaces "foo" with a configurable replacement.') . '</p><p>' . $this->t('Time Tag replaces the string
    "&lt;time /&gt;" with the current time.') . '</p><p>' . $this->t('To use these filters, go to <a href=":link">admin/config/content/formats</a> and
    configure an input format, or create a new one.', array(':link' => Url::fromRoute('filter.admin_overview')->toString())) . '</p>'
    );
  }

}

