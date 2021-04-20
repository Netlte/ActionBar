<?php declare(strict_types = 1);

namespace Netlte\ActionBar;

use Netlte\ActionBar\Exceptions\InvalidArgumentException;
use Netlte\UI\AbstractControl;
use Nette\ComponentModel\IComponent;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.holan.dev]
 */
class ActionBar extends AbstractControl {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'actionbar.latte';

	static public string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/**
	 * @param Button|DropDown|IComponent $component
	 * @return static
	 */
	public function addComponent(IComponent $component, ?string $name, ?string $insertBefore = null) {

		if (!$component instanceof Button && !$component instanceof DropDown) {
			throw new InvalidArgumentException(
				\sprintf(
					'Method %s expect argument 1 as %s or %s, %s given',
					__METHOD__,
					Button::class,
					DropDown::class,
					\get_class($component)
				)
			);
		}

		return parent::addComponent($component, $name, $insertBefore);
	}

	public function addButton(
		string $name,
		string $caption,
		?string $icon = null,
		?string $title = null,
		?string $size = null,
		?string $color = null,
		bool $ajax = false,
		?string $insertBefore = null
	): Button {

		$button = new Button($caption);
		$button->setIcon($icon);
		$button->setTitle($title);
		$button->enableAjax($ajax);

		$button->setSize($size ?? Button::DEFAULT_SIZE);
		$button->setColor($color ?? Button::DEFAULT_COLOR_CLASS);

		$button->setTranslator($this->getTranslator());

		$this->addComponent($button, $name, $insertBefore);

		return $button;
	}

	public function addDropDown(
		string $name,
		?string $caption = null,
		?string $icon = null,
		?string $title = null,
		?string $size = null,
		?string $color = null,
		bool $ajax = false,
		?string $insertBefore = null
	): DropDown {

		$dropDown = new DropDown($caption);
		$dropDown->setIcon($icon);
		$dropDown->setTitle($title);
		$dropDown->enableAjax($ajax);

		$dropDown->setSize($size ?? DropDown::DEFAULT_SIZE);
		$dropDown->setColor($color ?? DropDown::DEFAULT_COLOR_CLASS);

		$dropDown->setTranslator($this->getTranslator());

		$this->addComponent($dropDown, $name, $insertBefore);

		return $dropDown;
	}

	/**
	 * @return Button|DropDown|IComponent|null
	 */
	public function getAction(string $name, bool $throw = true): ?IComponent {
		return parent::getComponent($name, $throw);
	}

	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}


}