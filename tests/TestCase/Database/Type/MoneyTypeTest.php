<?php
namespace Gourmet\Money\Test\TestCase\Database\Type;

use Cake\Database\Type;
use Cake\TestSuite\TestCase;
use Gourmet\Money\Database\Type\MoneyType;
use Gourmet\Money\I18n\Money;
use SebastianBergmann\Money\USD;

class MoneyTypeTest extends TestCase
{

    protected $_originalMap = [];

    public function setUp()
    {
        parent::setUp();
        $this->type = Type::build('money');
        $this->driver = $this->getMock('Cake\Database\Driver');
        $this->_originalLocale = Money::$defaultLocale;
        $this->_originalMap = Type::map();
    }

    public function tearDown()
    {
        parent::tearDown();
        Money::$defaultLocale = $this->_originalLocale;
        Type::map($this->_originalMap);
    }

    public function testToPHP()
    {
        $this->assertNull($this->type->toPHP(null, $this->driver));

        $result = $this->type->toPHP(json_encode(['amount' => 1234, 'currency' => 'eur']), $this->driver);
        $this->assertInstanceOf('Gourmet\Money\I18n\Money', $result);
        $this->assertSame(1234, $result->getAmount());
    }

    public function testtoDatabase()
    {
        $expected = json_encode(['amount' => 123400, 'currency' => 'USD']);
        $result = $this->type->toDatabase('1234', $this->driver);
        $this->assertEquals($expected, $result);

        $result = $this->type->toDatabase(new USD(123400), $this->driver);
        $this->assertEquals($expected, $result);
    }

    public function marshalProvider()
    {
        return [
            [false, null],
            [true, null],
            [null, null],
            ['', null],
            [123400, new Money(123400, 'USD')],
            [-123400, new Money(-123400, 'USD')],
            ['12.34', new Money(1234, 'USD')],
            ['-12.34', new Money(-1234, 'USD')],
        ];
    }

    /**
     * @dataProvider marshalProvider
     */
    public function testMarshal($value, $expected)
    {
        $result = $this->type->marshal($value);
        if (is_object($expected)) {
            $this->assertEquals($expected, $result);
        } else {
            $this->assertSame($expected, $result);
        }
    }
}
