<?php


namespace Netlte\ActionBar;

use Holabs\UI\BaseControl;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
abstract class Action extends BaseControl {

	const SIZE_XS = 'xs';

	const SIZE_SM = 'sm';

	const SIZE_MD = 'md';

	const SIZE_LG = 'lg';

	const TARGET_BLANK = '_blank';

	const TARGET_PARENT = '_parent';

	const TARGET_SELF = '_self';

	const TARGET_TOP = '_top';

	const DEFAULT_ICON_PREFIX = 'fa fa-';

	const DEFAULT_COLOR_CLASS = 'default';

	const DEFAULT_SIZE = self::SIZE_XS;

	/** @var string */
	public static $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var string|null */
	protected $caption = NULL;

	/** @var string|null */
	protected $icon = NULL;

	/** @var string|null */
	protected $target = NULL;

	/** @var string|null */
	protected $title = NULL;

	/** @var string */
	protected $size = self::DEFAULT_SIZE;

	/** @var string */
	protected $color = self::DEFAULT_COLOR_CLASS;

	/** @var bool */
	protected $ajax = FALSE;

	protected $disabled = FALSE;

	/**
	 * @return string
	 */
	public function getCaption(): string {
		return $this->caption;
	}

	/**
	 * @return null|string
	 */
	public function getIcon(): ?string {
		return $this->icon;
	}

	/**
	 * @return null|string
	 */
	public function getTarget(): ?string {
		return $this->target;
	}

	/**
	 * @return null|string
	 */
	public function getTitle(): ?string {
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getSize(): string {
		return $this->size;
	}

	/**
	 * @return null|string
	 */
	public function getColor(): string {
		return $this->color;
	}

	/**
	 * @return bool
	 */
	public function isAjaxEnabled() {
		return $this->ajax;
	}

	/**
	 * @return bool
	 */
	public function isDisabled(): bool {
		return $this->disabled;
	}

	/**
	 * @param string $caption
	 * @return self
	 */
	public function setCaption(string $caption): self {
		$this->caption = $caption;

		return $this;
	}

	/**
	 * @param null|string $icon
	 * @return self
	 */
	public function setIcon(string $icon = NULL): self {
		$this->icon = $icon;

		return $this;
	}

	/**
	 * @param null|string $target
	 * @return Action
	 */
	public function setTarget(?string $target): self {
		$this->target = $target;

		return $this;
	}

	/**
	 * @param null|string $title
	 * @return self
	 */
	public function setTitle(string $title = NULL): self {
		$this->title = $title;

		return $this;
	}

	/**
	 * @param string $size
	 * @return self
	 */
	public function setSize(string $size = self::DEFAULT_SIZE): self {
		$this->size = $size;

		return $this;
	}

	/**
	 * @param string $color
	 * @return self
	 */
	public function setColor(string $color = self::DEFAULT_COLOR_CLASS): self {
		$this->color = $color;

		return $this;
	}

	/**
	 * @param bool $enable
	 * @return self
	 */
	public function enableAjax(bool $enable = TRUE): self {
		$this->ajax = $enable;

		return $this;
	}

	/**
	 * @param bool $disabled
	 * @return self
	 */
	public function setDisabled(bool $disabled = TRUE): self {
		$this->disabled = $disabled;

		return $this;
	}

}