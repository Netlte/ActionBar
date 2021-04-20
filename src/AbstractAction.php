<?php declare(strict_types = 1);

namespace Netlte\ActionBar;

use Netlte\UI\AbstractControl;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2017, Tomáš Holan [www.holan.dev]
 */
abstract class AbstractAction extends AbstractControl {

	public const SIZE_XS = 'xs';

	public const SIZE_SM = 'sm';

	public const SIZE_MD = 'md';

	public const SIZE_LG = 'lg';

	public const TARGET_BLANK = '_blank';

	public const TARGET_PARENT = '_parent';

	public const TARGET_SELF = '_self';

	public const TARGET_TOP = '_top';

	public const DEFAULT_ICON_PREFIX = 'fa fa-';

	public const DEFAULT_COLOR_CLASS = 'default';

	public const DEFAULT_SIZE = self::SIZE_XS;

	public static string $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	protected ?string $caption = null;

	protected ?string $icon = null;

	protected ?string $target = null;

	protected ?string $title = null;

	protected string $size = self::DEFAULT_SIZE;

	protected string $color = self::DEFAULT_COLOR_CLASS;

	protected bool $ajax = false;

	protected bool $disabled = false;

	public function getCaption(): ?string {
		return $this->caption;
	}

	public function getIcon(bool $withPrefix = false): ?string {
		return $withPrefix && $this->icon !== null ? self::$ICON_PREFIX . $this->icon : $this->icon;
	}

	public function getTarget(): ?string {
		return $this->target;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function getSize(): string {
		return $this->size;
	}

	public function getColor(): string {
		return $this->color;
	}

	public function isAjaxEnabled(): bool {
		return $this->ajax;
	}

	public function isDisabled(): bool {
		return $this->disabled;
	}

	public function setCaption(?string $caption): self {
		$this->caption = $caption;

		return $this;
	}

	public function setIcon(?string $icon = null): self {
		$this->icon = $icon;

		return $this;
	}

	public function setTarget(?string $target): self {
		$this->target = $target;

		return $this;
	}

	public function setTitle(?string $title = null): self {
		$this->title = $title;

		return $this;
	}

	public function setSize(string $size = self::DEFAULT_SIZE): self {
		$this->size = $size;

		return $this;
	}

	public function setColor(string $color = self::DEFAULT_COLOR_CLASS): self {
		$this->color = $color;

		return $this;
	}

	public function enableAjax(bool $enable = true): self {
		$this->ajax = $enable;

		return $this;
	}

	public function setDisabled(bool $disabled = true): self {
		$this->disabled = $disabled;

		return $this;
	}

}