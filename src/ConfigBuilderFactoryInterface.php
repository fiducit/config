<?php

declare(strict_types=1);

namespace FiducIT\Config;

interface ConfigBuilderFactoryInterface
{
	public function create(array $entries): ConfigBuilderInterface;
}