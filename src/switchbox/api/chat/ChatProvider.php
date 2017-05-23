<?php

namespace switchbox\api\economy;

use switchbox\api\BaseProvider;
use switchbox\Loader;

abstract class ChatProvider extends BaseProvider {

	public function __construct(Loader $loader) {
		parent::__construct($loader);
	}
}