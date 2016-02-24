<?php

namespace App\Modules\Front\Presenters;

use App\Model\Document
        ;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends DocumentPresenter
{
	
	
	public function renderDefault()
	{
		$posts = Document::findAll();
		$this->template->posts = $posts;
	}

}
