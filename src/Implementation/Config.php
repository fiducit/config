<?php

declare(strict_types=1);

namespace FiducIT\Config;

use \Exception;

class Config implements ConfigInterface
{
	private array $config;

	public function __construct(array $config)
	{
		/* Lower case array keys */
		$config = array_change_key_case($config, CASE_LOWER);

		/* Remove all elements where value is not string or is empty*/
		$config = array_filter($config, fn($value): bool => is_string($value) && $value !== "");

		$this->config = $config;
	}

	public function get(string $option, bool $required = false): ?string
	{
		/* Lower case option */
		$option = strtolower($option);

		if (!array_key_exists($option, $this->config)) {
			if ($required) {
				throw new Exception();
			} else {
				return null;
			}
		}

		return $this->config[$option];
	}
}