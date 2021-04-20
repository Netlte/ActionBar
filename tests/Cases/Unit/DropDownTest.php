<?php declare(strict_types = 1);

namespace Netlte\ActionBar\Tests\Cases\Unit;

use Netlte\ActionBar\DropDown;
use Netlte\ActionBar\Tests\Helpers\PresenterFactory;
use Netlte\ActionBar\Tests\Helpers\TestingTemplateFactory;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class DropDownTest extends TestCase {

	/** @var DropDown|IComponent|null */
	private $dropdown;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->dropdown = $presenter->getComponent('dropdown');
	}

	public function testRender(): void {
		/** @var DropDown $dropdown */
		$dropdown = $this->dropdown;

		$dropdown->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$dropdown->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

	public function testItems(): void {
		/** @var DropDown $dropdown */
		$dropdown = $this->dropdown;

		Assert::equal(0, \count($dropdown->getItems()));
		$dropdown->addItem('test', 'Testing dropdown');
		Assert::equal(1, \count($dropdown->getItems()));

		Assert::equal('Testing dropdown', $dropdown->getItem('test'));
		Assert::equal('Test', $dropdown->getCaption());

		$dropdown->addItem('test2', 'Second Testing dropdown', 'test');
		Assert::equal(2, \count($dropdown->getItems()));

		// test insert before
		$items = $dropdown->getItems();
		$first = \reset($items);
		Assert::equal('Second Testing dropdown', $first);
	}

}

(new DropDownTest())->run();