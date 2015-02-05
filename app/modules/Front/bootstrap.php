<?php
/**
 * @var \Nette\Configurator $configurator
 */
$cfg = glob(__DIR__ . '/../../config/front/*.neon');
if (is_array($cfg))
	foreach ($cfg as $cfg_file) {
	
		$configurator->addConfig($cfg_file);
	}
