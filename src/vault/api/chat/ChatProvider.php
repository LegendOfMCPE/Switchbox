<?php

namespace vault\api\chat;

use vault\api\BaseProvider;
use vault\Loader;

abstract class ChatProvider extends BaseProvider {

	public function __construct(Loader $loader) {
		parent::__construct($loader);
	}
}