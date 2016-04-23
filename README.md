Provides integration between Courier and CRM Core Contact.

Copyright (C) 2016 Daniel Phin (@dpi)

# License

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

# Configuration

## Courier CRM Core Contact

 1. Enable the module.
 2. Go to Administration » Configuration » Communication
    (/admin/config/communication/courier)
 3. Click 'CRM Core Contact' vertical tab.
 4. Enable the channel by checking the 'Enabled' checkbox
 5. Save the form.

## CRM Core

_Note: as of this writing (April 2016) the contact type primary field
configuration is broken. Go to https://www.drupal.org/node/2711935 to fix._

 1. Go to  Administration » Structure » CRM Core
    (/admin/structure/crm-core/contact-types)
 2. Click 'Edit' on a contact type.
 3. Ensure a 'Primary email field' is configured. If not, then add an email
    field from the 'Manage fields' tab. Then return to configure the primary
    email field.

## RNG

_Optional integration with [RNG](https://drupal.org/project/rng) allows you to
register for RNG events._

 1. Go to Administration » Configuration » RNG (/admin/config/rng/registrant)
 2. Enable the 'CRM Core Contact' checkbox.
 3. Save the form.
