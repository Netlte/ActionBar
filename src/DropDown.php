<?php declare(strict_types = 1);

namespace Netlte\ActionBar;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.holan.dev]
 *
 * @method onSelect(DropDown $sender, $item)
 */
class DropDown extends AbstractAction {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'dropdown.latte';

	static public string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var \Closure[]|callable[]|array */
	public array $onSelect = [];

	/** @var string[]  */
	private array $items = [];


	public function __construct(?string $caption = null) {
		$this->setCaption($caption);
	}

	public function handleSelect(string $item): void {
		$this->onSelect($this, $item);
	}

	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	public function addItem(string $name, string $caption, ?string $insertBefore = null): DropDown {

		if ($insertBefore === null || !isset($this->items[$insertBefore])) {
			$this->items[$name] = $caption;
			return $this;
		}

		$tmp = [];
		foreach ($this->items as $k => $v) {
			if ($k === $insertBefore) $tmp[$name] = $caption;
			$tmp[$k] = $v;
		}

		$this->items = $tmp;


		return $this;
	}

	public function removeItem(string $name): DropDown {
		if (!isset($this->items[$name])) {
			return $this;
		}

		unset($this->items[$name]);

		return $this;
	}

	public function getItem(string $name): ?string {
		return $this->items[$name] ?? null;
	}

	/**
	 * @return string[]
	 */
	public function getItems(): array {
		return $this->items;
	}

}