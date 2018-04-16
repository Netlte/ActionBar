<?php


namespace Netlte\ActionBar;

use Holabs\Utils\ArrayHash;
use Nette\Utils\Html;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 *
 * @method onSelect(DropDown $sender, $item)
 */
class DropDown extends Action {

	/** @var \Closure[]|callable[]|array */
	public $onSelect = [];

	/** @var ArrayHash */
	private $items;

	/**
	 * Action constructor.
	 * @param string|null $caption
	 */
	public function __construct(string $caption = NULL) {
		parent::__construct();
		$this->setCaption($caption);
		$this->items = new ArrayHash();
	}

	/**
	 * @throws \Nette\Application\UI\InvalidLinkException
	 */
	public function render() {

		$action = Html::el('div', ['class' => 'action btn-group']);

		$class = "btn btn-{$this->getSize()} btn-{$this->getColor()}";
		$cattrs = [
			'type'          => 'button',
			'class'         => $class . ' dropdown-toggle' . ($this->isDisabled() ? " disabled" : ''),
			'data-toggle'   => 'dropdown',
			'aria-expanded' => 'false',
		];

		if ($this->getTitle()) {
			$cattrs['title'] = $this->getTitle();
		}

		$caret = Html::el('button', $cattrs);

		if ($this->getCaption()) {
			$caret->setText($this->getCaption() . ' ');
		}

		$caret->addHtml(Html::el('span', ['class' => 'caret']));
		$caret->addHtml(Html::el('span', ['class' => 'sr-only'])->setText('Toggle Dropdown'));

		$name = NULL;

		if (!$this->getCaption()) {
			foreach ($this->items as $name => $caption) {
				break;
			}

			$tmpa = [
				'class' => $this->isAjaxEnabled() ? 'ajax ' : '' . $class
			];

			if ($this->isDisabled()) {
				$tmpa['type'] = 'button';
			} else {
				$tmpa['href'] = $this->link('select!', ['item' => $name]);
			}

			$tmp = Html::el($this->isDisabled() ? 'button' : 'a', $tmpa);

			$action->addHtml($tmp);
		}

		$action->addHtml($caret);

		if (!$this->isDisabled()) {
			$list = Html::el(
				'ul',
				[
					'class' => 'dropdown-menu',
					'role'  => 'menu'
				]
			);

			foreach ($this->items as $n => $c) {
				if ($n === $name) {
					continue;
				}
				$tmp = Html::el('li');
				$a = Html::el(
					'a',
					[
						'href'  => $this->link('select!', ['item' => $n]),
						'class' => $this->isAjaxEnabled() ? 'ajax ' : '' . $class
					]
				);
				$a->setText($c);
				$tmp->setHtml($a);
				$list->addHtml($tmp);
			}


			$action->addHtml($list);
		}

		echo $action->render();
	}

	public function handleSelect(string $item) {
		$this->onSelect($this, $item);
	}

	/**
	 * @param string      $name
	 * @param string      $caption
	 * @param string|null $insertBefore
	 * @return DropDown
	 */
	public function addItem(string $name, string $caption, string $insertBefore = NULL): DropDown {

		if ($insertBefore !== NULL && $this->items->offsetExists($insertBefore)) {
			$tmp = new ArrayHash();
			foreach ($this->items as $k => $v) {
				if ($k === $insertBefore) {
					$tmp->offsetSet($name, $caption);
				}
				$tmp->offsetSet($k, $v);
			}
			$this->items = $tmp;
		} else {
			$this->items->offsetSet($name, $caption);
		}


		return $this;
	}

	/**
	 * @param string $name
	 * @return DropDown
	 */
	public function removeItem(string $name): DropDown {
		if (!$this->items->offsetExists($name)) {
			return $this;
		}

		$this->items->offsetUnset($name);

		return $this;
	}

	/**
	 * @param string $name
	 * @return null|string
	 */
	public function getItem(string $name): ?string {
		return $this->items->offsetGetExists($name);
	}

}