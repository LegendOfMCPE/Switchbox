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

use switchbox\api\permission\PermissionProvider;
use switchbox\Switchbox;

class PurePermsSwitch extends PermissionProvider {

	public function __construct(Switchbox $loader) {
		parent::__construct($loader->getServer());
	}
}
