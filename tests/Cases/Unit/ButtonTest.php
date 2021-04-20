<?php declare(strict_types = 1);

namespace Netlte\ActionBar\Tests\Cases\Unit;

use Netlte\ActionBar\Button;
use Netlte\ActionBar\Tests\Helpers\PresenterFactory;
use Netlte\ActionBar\Tests\Helpers\TestingTemplateFactory;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class ButtonTest extends TestCase {

	/** @var Button|IComponent|null */
	private $button;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->button = $presenter->getComponent('button');
	}

	public function testRender(): void {
		/** @var Button $button */
		$button = $this->button;

		$button->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$button->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

}

(new ButtonTest())->run();