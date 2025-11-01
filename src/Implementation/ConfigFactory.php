<?php

declare(strict_types=1);

namespace FiducIT\Config;

class ConfigFactory implements ConfigFactoryInterface
{
	public static function create(array $config): ConfigInterface
	{
		return new Config($config);
	}
}