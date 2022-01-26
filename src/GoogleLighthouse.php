<?php

declare(strict_types=1);

namespace Logiek\GoogleLighthouse;

use Logiek\GoogleLighthouse\Exceptions\AuditFailedException;
use Logiek\GoogleLighthouse\Exceptions\InvalidFormatException;
use Symfony\Component\Process\Process;

class GoogleLighthouse
{
    private array $categories = [];

    private array $options;

    public function __construct()
    {
        $this->options = config('google-lighthouse.options');
        $this->setOption('--chrome-flags', "'" . config('google-lighthouse.flags') . "'");
    }

    public function performance(bool $enable = true): GoogleLighthouse
    {
        $this->setCategory('performance', $enable);

        return $this;
    }

    public function pwa(bool $enable = true): GoogleLighthouse
    {
        $this->setCategory('pwa', $enable);

        return $this;
    }

    public function bestPractices(bool $enable = true): GoogleLighthouse
    {
        $this->setCategory('best-practices', $enable);

        return $this;
    }

    public function accessibility(bool $enable = true): GoogleLighthouse
    {
        $this->setCategory('accessibility', $enable);

        return $this;
    }

    public function seo(bool $enable = true): GoogleLighthouse
    {
        $this->setCategory('seo', $enable);

        return $this;
    }

    /**
     * @throws InvalidFormatException
     */
    public function setOutput(string $path, null|string|array $formats = null): GoogleLighthouse
    {
        if (is_null($formats)) {
            $formats = [pathinfo($path, PATHINFO_EXTENSION)];
        } elseif (!is_array($formats)) {
            $formats = [$formats];
        }

        foreach ($formats as $format) {
            if (!in_array($format, config('google-lighthouse.formats'), true)) {
                throw new InvalidFormatException();
            }
        }

        $this->setOption('--output-path', $path);
        $this->setOption('--output', "'" . implode(',', $formats) . "'");

        return $this;
    }

    public function setOption(string $option, ?string $value = null): GoogleLighthouse
    {
        $existingOptionIndex = array_search($option, $this->options, true);

        if ($existingOptionIndex) {
            $this->options[$existingOptionIndex] = $option;

            return $this;
        }

        if (is_null($value)) {
            $this->options[] = $option;
        } else {
            $this->options[$option] = $value;
        }

        return $this;
    }

    /**
     * @throws AuditFailedException
     */
    public function audit(string $url): string
    {
        $process = Process::fromShellCommandline($this->getCommand($url));

        $process
            ->setTimeout(config('google-lighthouse.timeout'))
            ->run();

        if (!$process->isSuccessful()) {
            throw new AuditFailedException();
        }

        return $process->getOutput();
    }

    private function setCategory(string $category, bool $enable): GoogleLighthouse
    {
        $existingCategoryIndex = array_search($category, $this->categories, true);

        if ($existingCategoryIndex) {
            if (!$enable) {
                unset($this->categories[$existingCategoryIndex]);
            }
        } elseif ($enable) {
            $this->categories[] = $category;
        }

        return $this;
    }

    private function getCommand(string $url): string
    {
        if (!empty($this->categories)) {
            $this->setOption('--only-categories', "'" . implode(',', $this->categories) . "'");
        }

        return implode(' ', array_filter(array_merge([
            config('google-lighthouse.paths.node'),
            config('google-lighthouse.paths.lighthouse'),
            $url,
        ], $this->processOptions())));
    }

    private function processOptions(): array
    {
        return array_map(function ($value, $option) {
            return is_numeric($option) ? $value : "$option=$value";
        }, $this->options, array_keys($this->options));
    }
}
