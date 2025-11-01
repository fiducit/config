<?php

declare(strict_types=1);

namespace FiducIT\Config;

interface ConfigBuilderInterface
{
	/**
	 * Get Values from Environment Variables, replacing previously set values. Env-Keys are case-insensitive. Empty environment variables are set as null.
	 * @param ?string $prefix Prefix of Environment Variables
	 * 
	 * @return static
	 */
	public function getFromEnv(?string $prefix): static;

	/**
	 * Get Values from Array, replacing previously set values. Options are case-insensitive. Empty strings are set as null.
	 * @param array $array Syntax: [ Option: string => Value: ?string, ... ]
	 * 
	 * @return static
	 */
	public function getFromArray(array $array): static;

	/**
	 * Build ConfigInterface object. Throws Exception if required Option is null or not set.
	 * 
	 * @return ConfigInterface
	 */
	public function build(): ConfigInterface;
}