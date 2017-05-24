<?php

namespace switchbox\api\permission;

use switchbox\api\BaseProvider;
use switchbox\Loader;

abstract class PermissionProvider extends BaseProvider {

	public function __construct(Loader $loader) {
		parent::__construct($loader);
	}
}
