<?php


namespace Netlte;

use Netlte\ActionBar\Button;
use Netlte\ActionBar\DropDown;
use Nette\ComponentModel\Container;
use Nette\ComponentModel\IComponent;
use Nette\InvalidArgumentException;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class ActionBar extends Container {

	/**
	 * @param Button|IComponent $component
	 * @param string                  $name
	 * @param string|null             $insertBefore
	 * @return ActionBar|Container
	 */
	public function addComponent(IComponent $component, $name, $insertBefore = NULL) {

		if (!$component instanceof Button && !$component instanceof DropDown) {
			throw new InvalidArgumentException(
				sprintf(
					'Method %s expect argument 1 as %s or %s, %s given',
					__METHOD__,
					Button::class,
					DropDown::class,
					get_class($component)
				)
			);
		}

		return parent::addComponent($component, $name, $insertBefore);
	}

	/**
	 * @param string      $name
	 * @param string      $caption
	 * @param string|null $icon
	 * @param string|null $title
	 * @param string|null $size
	 * @param string|null $color
	 * @param bool        $ajax
	 * @param string|null $insertBefore
	 * @return Button
	 */
	public function addButton(
		string $name,
		string $caption,
		string $icon = NULL,
		string $title = NULL,
		string $size = NULL,
		string $color = NULL,
		bool $ajax = FALSE,
		string $insertBefore = NULL
	): Button {

		$button = new Button($caption);
		$button->setIcon($icon);
		$button->setTitle($title);
		$button->enableAjax($ajax);

		if ($size) {
			$button->setSize($size);
		}

		if ($color) {
			$button->setColor($color);
		}

		$this->addComponent($button, $name, $insertBefore);

		return $button;
	}

	/**
	 * @param string      $name
	 * @param string      $caption
	 * @param string|null $icon
	 * @param string|null $title
	 * @param string|null $size
	 * @param string|null $color
	 * @param bool        $ajax
	 * @param string|null $insertBefore
	 * @return DropDown
	 */
	public function addDropDown(
		string $name,
		string $caption = NULL,
		string $icon = NULL,
		string $title = NULL,
		string $size = NULL,
		string $color = NULL,
		bool $ajax = FALSE,
		string $insertBefore = NULL
	): DropDown {

		$dropDown = new DropDown($caption);
		$dropDown->setIcon($icon);
		$dropDown->setTitle($title);
		$dropDown->enableAjax($ajax);

		if ($size) {
			$dropDown->setSize($size);
		}

		if ($color) {
			$dropDown->setColor($color);
		}

		$this->addComponent($dropDown, $name, $insertBefore);

		return $dropDown;
	}

	/**
	 * @param string $name
	 * @param bool   $throw
	 * @return Button|DropDown|null
	 */
	public function getAction(string $name, bool  $throw = TRUE) {
		return parent::getComponent($name, $throw);
	}

	public function render() {
		foreach ($this->getComponents() as $button) {
			$button->render();
		}
	}


}