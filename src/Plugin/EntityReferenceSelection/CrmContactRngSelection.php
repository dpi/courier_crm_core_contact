<?php

namespace Drupal\courier_crm_core_contact\Plugin\EntityReferenceSelection;

use Drupal\rng\Plugin\EntityReferenceSelection\RNGSelectionBase;

/**
 * Provides selection for CRM contacts registering for RNG events.
 *
 * @EntityReferenceSelection(
 *   id = "rng:register:crm_core_contact",
 *   label = @Translation("CRM Core contact selection"),
 *   entity_types = {"crm_core_individual"},
 *   group = "rng_register",
 *   provider = "courier_crm_core_contact",
 *   weight = 10
 * )
 */
class CrmContactRngSelection extends RNGSelectionBase {

  /**
   * {@inheritdoc}
   */
  protected function buildEntityQuery($match = NULL, $match_operator = 'CONTAINS') {
    $query = parent::buildEntityQuery($match, $match_operator);

    // User entity.
    if (isset($match)) {
      // @todo How to deal if user searches for concatenation of fields?
      $group = $query->orConditionGroup();
      $group->condition('name__title', $match, $match_operator);
      $group->condition('name__given', $match, $match_operator);
      $group->condition('name__middle', $match, $match_operator);
      $group->condition('name__family', $match, $match_operator);
      $group->condition('name__generational', $match, $match_operator);
      $group->condition('name__credentials', $match, $match_operator);
      $query->condition($group);
    }

    if ($this->currentUser->isAuthenticated()) {
      // Check permission to access any contacts
      $view_any_permission = 'view any ' . $this->entityType->id() . ' entity';
      if (!$this->currentUser->hasPermission($view_any_permission)) {
        // Select contacts owned by the user.
        $query->condition('uid', $this->currentUser->id(), '=');
      }
    }
    else {
      // Cancel the query.
      $query->condition($this->entityType->getKey('id'), NULL, 'IS NULL');
    }

    return $query;
  }

}
