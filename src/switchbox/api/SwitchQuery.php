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


class SwitchQuery {

	private $callback;
	private $trace;
	public $hasResult;

	protected function __construct(callable $callback = null) {
		if(isset($callback)) {
			$this->callback = $callback;
		}
		$this->trace = new \Exception;
	}

	/**
	 * Creators of SwitchQuery should either pass the $callback or override this method (optionally anonymously).
	 */
	public function handle() {
		if(isset($this->callback)) {
			$c = $this->callback;
			$c($this);
		} elseif($this->mustHandle()) {
			throw new \LogicException("Queried data from Switchbox but didn't check them, probably a typo in code?", 0, $this->trace);
		}
	}

	protected function mustHandle(): bool {
		return false;
	}

	/**
	 * @return bool
	 */
	public function hasResult(): bool {
		return $this->hasResult;
	}

	protected function throwNoResults() {
		if(!$this->hasResult) {
			throw new \InvalidStateException("No results yet");
		}
	}
}
