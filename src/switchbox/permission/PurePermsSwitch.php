<?php

/*
 *
 * Switchbox
 *
 * Copyright (C) 2017 LegendsOfMCPE Team
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
*/

namespace switchbox\permission;

use PurePerms\PurePerms;
use switchbox\api\permission\PermissionProvider;

class PurePermsSwitch extends PermissionProvider {

	public function __construct(PurePerms $plugin) {
		parent::__construct($plugin->getServer());
	}
}
