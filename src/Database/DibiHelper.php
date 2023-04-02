<?php

declare(strict_types=1);

namespace Semisedlak\Bitmasking\Database;

class DibiHelper
{
	/**
	 * @param string $field
	 * @param array<int> $bits
	 * @return array{string, int}
	 */
	public static function queryAllEnabled(string $field, array $bits): array
	{
		$bit = array_sum($bits);

		return ["$field & %i = %i", $bit, $bit];
	}

	/**
	 * @param string $field
	 * @param int $bit
	 * @return array{string, int}
	 */
	public static function queryEnabled(string $field, int $bit): array
	{
		return self::queryAllEnabled($field, [$bit]);
	}

	/**
	 * @param string $field
	 * @param array<int> $bits
	 * @return array<string>
	 */
	public static function queryAllDisabled(string $field, array $bits): array
	{
		$op = implode('|', $bits);

		return ["$field & (%sql) = 0", $op];
	}

	/**
	 * @param string $field
	 * @param int $bit
	 * @return array<string>
	 */
	public static function queryDisabled(string $field, int $bit): array
	{
		return self::queryAllDisabled($field, [$bit]);
	}

	/**
	 * @param string $field
	 * @param array<int> $bits
	 * @return array<string>
	 */
	public static function querySomeEnabled(string $field, array $bits): array
	{
		$op = implode('|', $bits);

		return ["$field & (%sql) > 0", $op];
	}

	/**
	 * @param string $field
	 * @param array<int> $bits
	 * @return array<int, int|string>
	 */
	public static function querySomeDisabled(string $field, array $bits): array
	{
		$parts = $params = [];
		foreach ($bits as $bit) {
			$parts[] = "($field & %i) = 0";
			$params[] = $bit;
		}

		return ['(' . implode(' OR ', $parts) . ')', ...$params];
	}
}
