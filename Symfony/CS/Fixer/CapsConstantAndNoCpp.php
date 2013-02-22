<?php

/*
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\CS\Fixer;

use Symfony\CS\FixerInterface;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class CapsConstantAndNoCpp implements FixerInterface
{
    public function fix(\SplFileInfo $file, $content)
    {
        // [Structure] elseif, not else if
        $content = str_replace(' && ',  ' AND ', $content);
        $content = str_replace(' and ', ' AND ', $content);
        $content = str_replace(' || ',  ' OR ',  $content);
        $content = str_replace(' or ',  ' OR ',  $content);

        $content = str_replace(' null', ' NULL',  $content);
        $content = str_replace(' true',  ' TRUE',  $content);
        $content = str_replace(' false', ' FALSE',  $content);

        return $content;
    }

    public function getLevel()
    {
        return FixerInterface::PSR2_LEVEL;
    }

    public function getPriority()
    {
        return -20;
    }

    public function supports(\SplFileInfo $file)
    {
        return 'php' == pathinfo($file->getFilename(), PATHINFO_EXTENSION);
    }

    public function getName()
    {
        return 'caps';
    }

    public function getDescription()
    {
        return 'Replaces || with OR, && with AND, and capitalizes AND, OR.';
    }
}