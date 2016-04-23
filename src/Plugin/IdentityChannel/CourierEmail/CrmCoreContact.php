<?php

namespace Drupal\courier_crm_core_contact\Plugin\IdentityChannel\CourierEmail;

use Drupal\courier\Plugin\IdentityChannel\IdentityChannelPluginInterface;
use Drupal\courier\ChannelInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\courier\Exception\IdentityException;

/**
 * Supports core user entities.
 *
 * @IdentityChannel(
 *   id = "identity:crm_core_contact:courier_email",
 *   label = @Translation("CRM Core contact to courier_mail"),
 *   channel = "courier_email",
 *   identity = "crm_core_contact",
 *   weight = 10
 * )
 */
class CrmCoreContact implements IdentityChannelPluginInterface {

  /**
   * {@inheritdoc}
   *
   * @param \Drupal\courier\EmailInterface $message
   * @param \Drupal\crm_core_contact\ContactInterface $identity
   */
  public function applyIdentity(ChannelInterface &$message, EntityInterface $identity) {
    $message->setRecipientName($identity->label());

    $primary_email = NULL;
    try {
      $primary_email = $identity->getPrimaryEmail()->value;
      if (\Drupal::service('email.validator')->isValid($primary_email)) {
        $message->setEmailAddress($primary_email);
      }
      else {
        throw new IdentityException('Contact does not have an email address.');
      }
    }
    catch (\Exception $e) {
      throw new IdentityException('Contact does not have an email address.');
    }
  }

}
