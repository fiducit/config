<?php

declare(strict_types=1);

namespace FiducIT\Config;

interface ConfigInterface
{
	/**
	 * Get Value of Option.
	 * @param string $option Options are case-insensitive.
	 * @param bool $required Throws Exception if Value is null or doesn't exist.
	 * @return ?string Returns also null when Option doesn't exist.
	 */
	public function get(string $option, bool $required = false): ?string;
}