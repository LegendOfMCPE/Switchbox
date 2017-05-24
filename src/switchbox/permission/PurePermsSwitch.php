<?php

namespace switchbox\permission;

use switchbox\api\permission\PermissionProvider;
use PurePerms\PurePerms;

class PurePermsSwitch extends PermissionProvider {

	public function __construct(PurePerms $plugin) {
		parent::__construct($plugin->getServer());
	}
}
