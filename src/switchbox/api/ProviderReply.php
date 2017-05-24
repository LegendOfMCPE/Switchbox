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

namespace switchbox\api;

class ProviderReply {

	private $value;

	public function __construct($value) {
		$this->value = $value;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}
}
