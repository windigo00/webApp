<?php

namespace App\Helper;

/**
 * Description of DebugSqlPanel
 *
 * @author KuBik
 */
class DebugSqlPanel extends \Nette\Object implements \Tracy\IBarPanel
{
	/** @var int */
	public $maxQueries = 100;

	/** @var int logged time */
	private $totalTime = 0;

	/** @var int */
	private $count = 0;

	/** @var array */
	private $queries = array();

	/** @var string */
	public $name;

	/** @var bool|string explain queries? */
	public $explain = TRUE;

	/** @var bool */
	public $disabled = FALSE;

	public function logQuery($q)
	{
		if ($this->disabled) {
			return;
		}
		$this->count++;
		$this->queries[] = $q;
	}

	public function getTab()
	{
		$name = $this->name;
		$count = $this->count;
		$totalTime = $this->totalTime;
		return '<span title="Nette\Database '.htmlSpecialChars($name, ENT_QUOTES, 'UTF-8').'">
<svg viewBox="0 0 2048 2048"><path fill="'.($count ? '#b079d6' : '#aaa').'" d="M1024 896q237 0 443-43t325-127v170q0 69-103 128t-280 93.5-385 34.5-385-34.5-280-93.5-103-128v-170q119 84 325 127t443 43zm0 768q237 0 443-43t325-127v170q0 69-103 128t-280 93.5-385 34.5-385-34.5-280-93.5-103-128v-170q119 84 325 127t443 43zm0-384q237 0 443-43t325-127v170q0 69-103 128t-280 93.5-385 34.5-385-34.5-280-93.5-103-128v-170q119 84 325 127t443 43zm0-1152q208 0 385 34.5t280 93.5 103 128v128q0 69-103 128t-280 93.5-385 34.5-385-34.5-280-93.5-103-128v-128q0-69 103-128t280-93.5 385-34.5z"/>
</svg><span class="tracy-label">'.($totalTime ? sprintf('%0.1f ms / ', $totalTime * 1000) : '') . $count.'</span>
</span>';
	}


	public function getPanel()
	{
		$this->disabled = TRUE;
		if (!$this->count) {
			return;
		}

		$name = $this->name;
		$count = $this->count;
		$totalTime = $this->totalTime;
		$queries = $this->queries;

		$ret = '<style class="tracy-debug">
	#tracy-debug td.nette-DbConnectionPanel-sql { background: white !important }
	#tracy-debug .nette-DbConnectionPanel-source { color: #BBB !important }
	#tracy-debug .nette-DbConnectionPanel-time { white-space: nowrap; }
</style>

<h1>Queries: '.$count.', '.
		($totalTime ? sprintf(', time: %0.3f ms', $totalTime * 1000) : '').', '.
				htmlSpecialChars($name, ENT_NOQUOTES, 'UTF-8').'</h1>

<div class="tracy-inner">
	<table>
		<tr><th>Time&nbsp;ms</th><th>SQL Query</th></tr>';
		foreach ($queries as $query) {
//			dump($query['sql']);
			$ret .= '<tr>
				<td class="nette-DbConnectionPanel-time">'.(sprintf('%0.3f ms', $query['executionMS'] * 1000)).'</td>
				<td class="nette-DbConnectionPanel-sql">
					'. \SqlFormatter::highlight(self::dumpSql($query['sql'],$query['params'])) .'
				</td>
				
			</tr>';
		}
		$ret .= '</table>';
		if (count($queries) < $count) $ret .= '<p>...and more</p>';
		$ret .= '</div>';
		return $ret;
	}
	
	/**
	 * Returns syntax highlighted SQL command.
	 * @param  string
	 * @return string
	 */
	public static function dumpSql($sql, array $params = NULL)
	{
		// parameters
		$sql = preg_replace_callback('#\?#', function () use ($params) {
			static $i = 0;
			if (!isset($params[$i])) {
				return '?';
			}
			$param = $params[$i++];
			if (is_string($param) && (preg_match('#[^\x09\x0A\x0D\x20-\x7E\xA0-\x{10FFFF}]#u', $param) || preg_last_error())) {
				return '"binary"';

			} elseif (is_string($param)) {
				$length = \Nette\Utils\Strings::length($param);
				$text = htmlspecialchars('\'' . $param . '\'', ENT_NOQUOTES, 'UTF-8');
				return $text;

			} elseif (is_array($param)) {
				return htmlspecialchars(implode(', ', $param), ENT_NOQUOTES, 'UTF-8');
			} elseif (is_resource($param)) {
				$type = get_resource_type($param);
				if ($type === 'stream') {
					$info = stream_get_meta_data($param);
				}
				return 'resource';
			} elseif (is_a($param, 'DateTime')) {
				return $param->format(DateTime::FORM_DATETIME_FORMAT);
			} else {
				return htmlspecialchars($param, ENT_NOQUOTES, 'UTF-8');
			}
		}, $sql);

		return trim($sql);
	}

}
