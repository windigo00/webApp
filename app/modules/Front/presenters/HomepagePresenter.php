<?php

namespace App\Modules\Front\Presenters;

use Nette,
    App\Model
        ;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BaseFrontPresenter
{
	public function renderDefault()
	{
//		$this->template->setFile('1column.latte');
		$this->template->anyVariable = 'any value';
	}

}
