<?php

namespace switchbox\permission;

use switchbox\api\permission\PermissionProvider;
use switchbox\Loader;

class PurePermsSwitch extends PermissionProvider {

	public function __construct(Loader $loader) {
		parent::__construct($loader);
	}
}