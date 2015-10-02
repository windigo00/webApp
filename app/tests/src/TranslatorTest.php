<?php

namespace App\Model\Test;

use App\Model\Translator;
/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-03-17 at 11:01:45.
 */
class TranslatorTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Translator
	 */
	protected $object;

	protected $strings;


	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = Translator::get();
		$this->strings = array();
		$this->strings['en_GB'] = 'Attribute with the same code already exists';
		$this->strings['de_DE'] = 'Die Eigenschaft ist mit dem gleichen Code bereits vorhanden';
		$this->strings['cs_CZ'] = 'Atribut s tímto kódem již existuje';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
	
	/**
	 * @covers App\Model\Translator::get
	 * @todo   Implement testGet().
	 */
	public function testGet() {
		$this->assertInstanceOf('\App\Model\Translator', $this->object);
	}
	/**
	 * @covers App\Model\Translator::getLang
	 * @todo   Implement testGetLang().
	 */
	public function testGetLang() {
		$code = 'cs_CZ';
		$this->assertTrue($this->object->getLang() === $code);
	}

	
	/**
	 * @covers App\Model\Translator::translate
	 * @depends testGetLang
	 */
	public function testTranslate()
	{
		$in = $this->strings['en_GB'];
		$out = $this->strings['cs_CZ'];
		$this->assertEquals($out, $this->object->translate($in));
	}

	/**
	 * @covers App\Model\Translator::setLang
	 * @depends testGetLang
	 * @depends testTranslate
	 * @todo   Implement testSetLang().
	 */
	public function testSetExistingLang() {
		$code = 'de_DE';
		$in = $this->strings['en_GB'];
		$out = $this->strings[$code];
		$this->assertTrue($this->object->setLang($code));
		$this->assertTrue($this->object->getLang() === $code);
		$this->assertEquals($out, $this->object->translate($in));
	}
	/**
	 * @covers App\Model\Translator::setLang
	 * @depends testGetLang
	 */
	public function testSetNotExistingLang() {
		$code = 'qh_QH';
		$this->assertFalse($this->object->setLang($code));
		$this->assertFalse($this->object->getLang() === $code);
	}
}
