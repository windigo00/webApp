<?php

namespace App\Modules\Shop\Presenters;

use Nette,
    App\Model
        ;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenterShop
{
	public function renderDefault()
	{
		
//		$this->template->setFile('1column.latte');
		$this->template->anyVariable = 'any value';
	}

}
