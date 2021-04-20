<?php declare(strict_types = 1);

namespace Netlte\ActionBar\Tests\Cases\Unit;

use Netlte\ActionBar\ActionBar;
use Netlte\ActionBar\Button;
use Netlte\ActionBar\DropDown;
use Netlte\ActionBar\Exceptions\InvalidArgumentException;
use Netlte\ActionBar\Tests\Helpers\PresenterFactory;
use Netlte\ActionBar\Tests\Helpers\TestingTemplateFactory;
use Netlte\UI\AbstractControl;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class ActionBarTest extends TestCase {

	/** @var ActionBar|IComponent|null */
	private $actionbar;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->actionbar = $presenter->getComponent('actionbar');
	}

	public function testRender(): void {
		/** @var ActionBar $actionbar */
		$actionbar = $this->actionbar;

		$actionbar->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$actionbar->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

	public function testComponents(): void {
		/** @var ActionBar $actionbar */
		$actionbar = $this->actionbar;

		$component = new class extends AbstractControl {};

		$fn = function() use ($actionbar, $component): void {
			$actionbar->addComponent($component, 'test');
		};

		Assert::exception($fn, InvalidArgumentException::class);

		$button = function() use ($actionbar): void {
			$actionbar->addComponent(new Button('test'), 'button');
		};

		$dropdown = function() use ($actionbar): void {
			$actionbar->addComponent(new DropDown('test'), 'dropdown');
		};

		Assert::noError($button);
		Assert::noError($dropdown);
	}

}

(new ActionBarTest())->run();