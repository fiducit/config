<?php

declare(strict_types=1);

namespace FiducIT\Config;

class ConfigBuilderFactory implements ConfigBuilderFactoryInterface
{
	public function __construct(
		private readonly ?ConfigFactoryInterface $configFactory = null
	) {
	}

	public function create(array $entries): ConfigBuilderInterface
	{
		return new ConfigBuilder($entries, $this->configFactory ?? new ConfigFactory());
	}
}