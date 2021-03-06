<?php

namespace House;

class Response {
	
	protected $body = array();
	protected $code = 200;
	protected $head = array();

	public function code($code = null) {
		if (is_numeric($code)) {
			$this->code = $code;
		}
		return $this;
	}

	public function flush() {
		$this->body = array();
		return $this;
	}

	public function getCode() {
		return $this->code;
	}

	public function header($header) {
		$this->head[] = $header;
		return $this;
	}

	public function write($toStringable) {
		$this->body[] = $toStringable;
		return $this;
	}

	public function body($iterable) {
		$this->body = $iterable;
	}

	public function respond() {

		// Requires PHP >= 5.4
		http_response_code($this->code);

		// Additional headers
		foreach ($this->head as $header) {
			header($header);
		}

		// Write the body
		foreach ($this->body as $toStringable) {
			echo $toStringable;
		}
	}
}

?>