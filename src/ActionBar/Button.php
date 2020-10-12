<?php


namespace Netlte\ActionBar;

use Nette\Utils\Html;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 *
 * @method onClick(Button $sender)
 */
class Button extends Action {

	/** @var \Closure[]|callable[]|array */
	public $onClick = [];

	/**
	 * Action constructor.
	 * @param string $caption
	 */
	public function __construct(string $caption) {
		parent::__construct();
		$this->setCaption($caption);
	}

	/**
	 * @throws \Nette\Application\UI\InvalidLinkException
	 */
	public function render() {

		$title = $this->getTitle() ?: (!empty($this->getCaption()) ? $this->getCaption() : NULL);
		$ajax = $this->isAjaxEnabled() ? 'ajax' : '';
		$attrs = [
			'href' => $this->link('click!'),
			'class' => "action {$ajax} btn btn-{$this->getSize()} btn-{$this->getColor()}",
			];

		if ($title) {
			$attrs['title'] = $title;
		}

		if ($this->getTarget()) {
			$attrs['target'] = $this->getTarget();
		}

		$action = Html::el('a', $attrs);
		$icon = $this->getIcon() ? Html::el('i', ['class' => self::$ICON_PREFIX . $this->getIcon()]) : '';
		$caption = Html::el('span')->setText(($this->getIcon() ? ' ' : '') . $this->getCaption());

		$action->addHtml($icon);
		$action->addHtml($caption);

		echo $action->render();
	}

	public function handleClick() {
		$this->onClick($this);
	}
}
