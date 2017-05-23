<?php

namespace switchbox\api;

use switchbox\Loader;

class EmptySwitch extends BaseProvider {

	protected $empty = true;

	public function __construct(Loader $loader) {
		parent::__construct($loader);
	}
}