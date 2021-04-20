<?php declare(strict_types = 1);

namespace Netlte\ActionBar;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.holan.dev]
 *
 * @method onClick(Button $sender)
 */
class Button extends AbstractAction {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'button.latte';

	static public string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var \Closure[]|callable[]|array */
	public array $onClick = [];

	public function __construct(string $caption) {
		$this->setCaption($caption);
	}

	public function handleClick(): void {
		$this->onClick($this);
	}

	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}
}
