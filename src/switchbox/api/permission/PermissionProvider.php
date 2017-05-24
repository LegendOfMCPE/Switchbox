<?php

namespace switchbox\api\permission;

use pocketmine\Server;
use switchbox\api\BaseProvider;

abstract class PermissionProvider extends BaseProvider {

	public function __construct(Server $server) {
		parent::__construct($server);
	}
}
