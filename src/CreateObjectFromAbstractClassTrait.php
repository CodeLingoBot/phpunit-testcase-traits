<?php
/**
 * Copyright (C) 2017  Potherca
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Potherca\PhpUnit;

use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * It can be desirable to create test code for a class that has abstract methods.
 * This traits offers a convenient method for creating a concrete object whose
 * methods can be called and, thus, be tested.
 *
 * This is done using PHPUnit's mock capabilities.
 *
 * One important thing to look out for is that, for this to work, the constructor
 * of the abstract class (if present) will NOT be executed.
 *
 * Example usage:
 *
 *    abstract class AbstractExample
 *    {
 *        abstract public function getName();
 *
 *        public function sayName()
 *        {
 *            return $this->getName();
 *        }
 *    }
 *
 *    class AbstractExampleTest extends PHPUnit\Framework\TestCase
 *    {
 *        use \Potherca\PhpUnit\CreateObjectFromAbstractClassTrait;
 *
 *        const MOCK_VALUE = 'mock-value';
 *
 *        public function testAbstractMethod()
 *        {
 *            $example = $this->createObjectFromAbstractClass(AbstractExample::class);
 *
 *            $example->method('getName')->willReturn(self::MOCK_VALUE);
 *
 *            $expected = self::MOCK_VALUE;
 *            $actual = $example->sayName();
 *
 *            $this->assertEquals($expected, $actual);
 *        }
 *    }
 *
 * @method fail($message)
 * @method \PHPUnit_Framework_MockObject_MockBuilder getMockBuilder($className)
 *
 */
trait CreateObjectFromAbstractClassTrait
{
    ////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\

    use \Potherca\PhpUnit\Traits\CreateClassForTraitTrait;

    /** @var string */
    private $class;

    //////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\

    private function getTraitShimClass()
    {
        if ($this->class === null) {
            $this->class = $this->createClassForTrait(__TRAIT__);
        }

        return $this->class;
    }

    //////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    /**
     * @param $className
     *
     * @return MockObject
     *
     * @throws \PHPUnit_Framework_AssertionFailedError|\PHPUnit\Framework\AssertionFailedError
     */
    final public function createObjectFromAbstractClass($className)
    {
        return call_user_func_array([$this->getTraitShimClass(), __FUNCTION__], func_get_args());
    }
}

/*EOF*/
