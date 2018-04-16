Netlte/ActionBar
===============

Component that able you create stylish buttons and dropdowns

Installation
------------

**Requirements:**
 - php 5.6+
 - [nette/component-model](https://github.com/nette/component-model)
 - [nette/utils](https://github.com/nette/utils)
 - [holabs/ui](https://github.com/holabs/ui)
 - [holabs/utils](https://github.com/holabs/utils)
 
```sh
composer require netlte/actionbar
```


Using
-----
Your **SignPresenter** now can looks like this:

```php
<?php 

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/actionbar
 * @copyright    Copyright © 2018, Tomáš Holan [www.tomasholan.cz]
 */
class SignPresenter extends BasePresenter
{


	public function actionDefault() {
	}


	/**
	 * @return \Netlte\ActionBar 
 	 */
	protected function createComponentBar()
	{
		$bar = new \Netlte\ActionBar();
		$button = $bar->addButton(
			'test',
			'Testing button',
			'trash',
			NULL,
			\Netlte\ActionBar\Action::SIZE_LG,
			'success',
			TRUE,
			NULL
			);
		
		$button->onClick[] = function(\Netlte\ActionBar\Button $sender) {
			// Do your jobs ...
		};

		return $bar;
	}
}
```


```latte
{block content}
{control bar}
{*

...

 *}
```