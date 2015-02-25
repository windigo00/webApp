<?php

namespace App\Modules\Shop\Presenters;

use Nette,
    App\Model
        ;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BaseShopPresenter
{
	public function renderDefault()
	{
		$this->template->title = 'aaaaaaa';
//		$this->template->setFile('1column.latte');
		$this->template->anyVariable = 'any value';
	}

}
