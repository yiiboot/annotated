<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Attributed;

use Attribute;
use Generator;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

/**
 * the attribute loader
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:47
 */
final class AttributedLoader
{

    private bool $loaded = false;

    private array|string $paths;

    /**
     * @var array<string, AttributedHandlerInterface>
     */
    private array $handlers = [];

    public function __construct(array|string $paths, array $handlers)
    {
        $this->paths = $paths;
        $this->addHandler(...$handlers);
    }

    public function load(): void
    {
        if ($this->loaded) {
            return;
        }

        if (empty($this->handlers)) {
            return;
        }

        if (empty($this->paths)) {
            return;
        }

        foreach ($this->getTargets() as $class) {

            foreach ($this->handlers as $handler) {

                if (!$handler->support($class)) {
                    continue;
                }

                $target = $handler->getTarget();
                $attribute = $handler->getAttribute();
                $targetAll = $target & Attribute::TARGET_ALL;

                $items = [];

                if ($targetAll || $target & Attribute::TARGET_CLASS) {
                    foreach (AttributedHelper::findClasses($class, $attribute) as $AttributedClass) {
                        $items[] = $AttributedClass;
                    }
                }
                if ($targetAll || $target & Attribute::TARGET_METHOD) {
                    foreach (AttributedHelper::findMethods($class, $attribute) as $AttributedMethod) {
                        $items[] = $AttributedMethod;
                    }
                }
                if ($targetAll || $target & Attribute::TARGET_PROPERTY) {
                    foreach (AttributedHelper::findProperties($class, $attribute) as $AttributedProperty) {
                        $items[] = $AttributedProperty;
                    }
                }

                if ($items) {
                    $handler->handle($items);
                }
            }
        }

        foreach ($this->handlers as $handler) {
            $handler->flush();
        }

        $this->loaded = true;
    }

    protected function addHandler(AttributedHandlerInterface ...$handlers): void
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->getAttribute()] = $handler;
        }
    }

    protected function removeHandler(string $attribute): void
    {
        unset($this->handlers[$attribute]);
    }

    protected function hasHandler(string $attribute): bool
    {
        return isset($this->handlers[$attribute]);
    }

    /**
     * @return Generator|ReflectionClass[]
     */
    private function getTargets(): Generator
    {
        $finder = Finder::create()->in($this->paths)->ignoreVCS(true)->name('*.php');

        foreach ($finder->getIterator() as $file) {
            if ($file->isFile()) {
                $class = $this->findClass($file);
                if ($class) {
                    try {
                        yield new ReflectionClass($class);
                    } catch (\Throwable $e) {
                    }
                }
            }
        }
    }

    /**
     * Returns the full class name for the first class in the file.
     */
    protected function findClass(string $file): string|false
    {
        $class = false;
        $namespace = false;
        $tokens = token_get_all(file_get_contents($file));

        if (1 === \count($tokens) && \T_INLINE_HTML === $tokens[0][0]) {
            throw new \InvalidArgumentException(sprintf('The file "%s" does not contain PHP code. Did you forgot to add the "<?php" start tag at the beginning of the file?', $file));
        }

        $nsTokens = [\T_NS_SEPARATOR => true, \T_STRING => true];
        if (\defined('T_NAME_QUALIFIED')) {
            $nsTokens[\T_NAME_QUALIFIED] = true;
        }
        for ($i = 0; isset($tokens[$i]); ++$i) {
            $token = $tokens[$i];
            if (!isset($token[1])) {
                continue;
            }

            if (true === $class && \T_STRING === $token[0]) {
                return $namespace . '\\' . $token[1];
            }

            if (true === $namespace && isset($nsTokens[$token[0]])) {
                $namespace = $token[1];
                while (isset($tokens[++$i][1], $nsTokens[$tokens[$i][0]])) {
                    $namespace .= $tokens[$i][1];
                }
                $token = $tokens[$i];
            }

            if (\T_CLASS === $token[0]) {
                // Skip usage of ::class constant and anonymous classes
                $skipClassToken = false;
                for ($j = $i - 1; $j > 0; --$j) {
                    if (!isset($tokens[$j][1])) {
                        if ('(' === $tokens[$j] || ',' === $tokens[$j]) {
                            $skipClassToken = true;
                        }
                        break;
                    }

                    if (\T_DOUBLE_COLON === $tokens[$j][0] || \T_NEW === $tokens[$j][0]) {
                        $skipClassToken = true;
                        break;
                    } elseif (!\in_array($tokens[$j][0], [\T_WHITESPACE, \T_DOC_COMMENT, \T_COMMENT])) {
                        break;
                    }
                }

                if (!$skipClassToken) {
                    $class = true;
                }
            }

            if (\T_NAMESPACE === $token[0]) {
                $namespace = true;
            }
        }

        return false;
    }
}
