<?php

/**
 * The `PHPUnit_Framework_TestCase` class  was added in PHPUnit v2.0 and
 * removed in PHPUnit v6.0, where it was replaced by the namespaced
 * `\PHPUnit\Framework\TestCase`.
 *
 * In order to allow developers to migrate their code before PHPUnit v6 was
 * released a "Forward Compatibility Layer" was added to PHPUnit v4.8 and v5.4
 * which also contained the `PHPUnit\Framework\TestCase` class.
 *
 * This means that for projects that use an older version of PHPUnit, the
 * namespaced class is not available and for newer projects the "underscored"
 * version is missing.
 *
 * This file makes sure that `\PHPUnit\Framework\TestCase` always exist.
 */
namespace PHPUnit\Framework {
    if (class_exists('\\PHPUnit\\Framework\\TestCase') === false
        && class_exists('\\PHPUnit_Framework_TestCase') === true
    ) {
        abstract class TestCase extends \PHPUnit_Framework_TestCase {}
    }
}

/*EOF*/
