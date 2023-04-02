<?php

declare(strict_types=1);

namespace Semisedlak\Bitmasking;

abstract class Bitmask
{
	private int $bitmask;

	private int $maxBits;

	/** @var array<int, bool> */
	private array $bits = [];

	public function __construct(int $bitmask = 0, int $maxBits = 10)
	{
		$this->bitmask = $bitmask;
		$this->maxBits = $maxBits;

		$this->parseBits();
	}

	private function parseBits(): self
	{
		for ($i = 0; $i < $this->maxBits; $i++) {
			$bit = 2 ** $i;
			$this->bits[$bit] = Utils::isEnabled($this->bitmask, $bit);
		}

		return $this;
	}

	/** @param array<int, bool> $bits */
	public function fillBits(array $bits): self
	{
		foreach ($bits as $bit => $value) {
			$this->set($bit, $value);
		}

		return $this;
	}

	/** @param array<int, bool> $bits */
	public function calculateBitmask(array $bits): int
	{
		$bitmap = 0;
		$index = 0;
		foreach ($bits as $bit => $enabled) {
			if ($enabled) {
				$bitmap += 2 ** $index;
			}
			$index++;
		}

		return $bitmap;
	}

	public function get(int $bit): bool
	{
		return $this->bits[$bit];
	}

	/** @return array<int, bool> */
	public function getAll(): array
	{
		return $this->bits;
	}

	public function set(int $bit, bool $value): self
	{
		$this->bitmask = Utils::set($this->bitmask, $bit, $value);
		$this->parseBits();

		return $this;
	}

	public function enable(int $bit): self
	{
		$this->bitmask = Utils::enable($this->bitmask, $bit);
		$this->parseBits();

		return $this;
	}

	public function disable(int $bit): self
	{
		$this->bitmask = Utils::disable($this->bitmask, $bit);
		$this->parseBits();

		return $this;
	}

	public function enableAll(): self
	{
		$this->bitmask = 2 ** $this->maxBits - 1;
		$this->parseBits();

		return $this;
	}

	public function disableAll(): self
	{
		$this->bitmask = 0;
		$this->parseBits();

		return $this;
	}

	public function isEnabled(int $bit): bool
	{
		return Utils::isEnabled($this->bitmask, $bit);
	}

	public function isDisabled(int $bit): bool
	{
		return Utils::isDisabled($this->bitmask, $bit);
	}

	public function getBitmask(): int
	{
		return $this->bitmask;
	}

	public function getMaxBits(): int
	{
		return $this->maxBits;
	}

	public function __toString(): string
	{
		return str_pad(decbin($this->bitmask), $this->maxBits, '0', STR_PAD_LEFT);
	}
}
