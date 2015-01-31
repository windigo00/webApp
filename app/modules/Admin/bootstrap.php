<?php
/**
 * @var \Nette\Configurator $configurator
 */
$cfg = glob(__DIR__ . '/../../config/admin/*.neon');

if (is_array($cfg))
	foreach ($cfg as $cfg_file) {
		$configurator->addConfig($cfg_file);
	}
//$configurator->addConfig(__DIR__ . '/../../config/admin/settings.db.neon');
