<?php

use Semisedlak\Bitmasking\Bitmask;

class UserTypeBitmask extends Bitmask
{
	public const ADMIN = 1 << 0; // or simply 1
	public const VERIFIED = 1 << 1; // or simply 2
	public const BANNED = 1 << 2; // or simply 4

	public static function getItems()
	{
		return [
			static::ADMIN    => 'Admin',
			static::VERIFIED => 'Verified',
			static::BANNED   => 'Banned',
		];
	}
}
