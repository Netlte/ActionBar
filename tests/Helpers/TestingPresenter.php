<?php declare(strict_types = 1);

namespace Netlte\ActionBar\Tests\Helpers;

use Netlte\ActionBar\ActionBar;
use Netlte\ActionBar\Button;
use Netlte\ActionBar\DropDown;
use Nette\Application\UI\Presenter;

final class TestingPresenter extends Presenter {

	protected function createComponentButton(): Button {
		return new Button('Test');
	}

	protected function createComponentDropdown(): DropDown {
		return new DropDown('Test');
	}

	protected function createComponentActionbar(): ActionBar {
		return new ActionBar();
	}

}