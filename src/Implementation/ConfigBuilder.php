<?php

declare(strict_types=1);

namespace FiducIT\Config;

class ConfigBuilder implements ConfigBuilderInterface
{
	private array $entries;
	private array $config = [];

	public function __construct(
		array $entries,
		private readonly ConfigFactoryInterface $configFactory
	) {
		/* Lower case array keys */
		$entries = array_change_key_case($entries, CASE_LOWER);

		$this->entries = $entries;
	}

	public function getFromEnv(?string $prefix): static
	{
		/* Get env variables */
		$array = getenv();

		if (is_string($prefix) && $prefix !== "") {
			/* Lower case prefix */
			$prefix = strtolower($prefix);

			/* Lower case array keys */
			$array = array_change_key_case($array, CASE_LOWER);

			/* Only keep item with prefix */
			$array = array_filter($array, fn($key): bool => str_starts_with($key, $prefix), ARRAY_FILTER_USE_KEY);

			/* Get keys */
			$keys = array_keys($array);

			/* Remove prefix */
			$keys = array_map(fn($key) => substr($key, strlen($prefix)), $keys);

			/* Replace old keys with new ones */
			$array = array_combine($keys, $array);
		}

		/* Just run getFromArray() with the env array. It will work. */
		return $this->getFromArray($array);
	}

	public function getFromArray(array $array): static
	{
		/* Only keep items that are typed ?string */
		$array = array_filter($array, fn($value): bool => is_string($value) || $value === null);

		/* Lower case array keys */
		$array = array_change_key_case($array, CASE_LOWER);

		/* Reduce to defined entries */
		$array = array_intersect_key($array, $this->entries);

		/* Merge with $this->config by overwriting */
		$array = array_replace($this->config, $array);

		/* Remove any null or empty items */
		$array = array_filter($array, fn($value): bool => $value !== null && $value !== "");

		/* Push array */
		$this->config = $array;

		return $this;
	}

	public function build(): ConfigInterface
	{
		/* Todo: Throw exception when required option not set. */

		return $this->configFactory->create($this->config);
	}
}