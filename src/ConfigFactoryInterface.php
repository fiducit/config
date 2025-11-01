<?php

declare(strict_types=1);

namespace FiducIT\Config;

interface ConfigFactoryInterface
{
	public static function create(array $config): ConfigInterface;
}