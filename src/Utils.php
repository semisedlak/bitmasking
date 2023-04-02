<?php

declare(strict_types=1);

namespace Semisedlak\Bitmasking;

class Utils
{
	public static function set(int $bitmask, int $bit, bool $value): int
	{
		if ($value) {
			$bitmask |= $bit;
		} else {
			$bitmask &= ~$bit;
		}

		return $bitmask;
	}

	public static function enable(int $bitmask, int $bit): int
	{
		return self::set($bitmask, $bit, true);
	}

	public static function isEnabled(int $bitmask, int $bit): bool
	{
		return ($bitmask & $bit) === $bit;
	}

	public static function disable(int $bitmask, int $bit): int
	{
		return self::set($bitmask, $bit, false);
	}

	public static function isDisabled(int $bitmask, int $bit): bool
	{
		return ($bitmask & $bit) !== $bit;
	}
}
