<?php

namespace test;

class TestLibrary
{
    protected function success(): bool
    {
        $debugTrace    = debug_backtrace();
        $fileShortName = $this->getCallerFileName($debugTrace);
        $functionName  = $this->getCallerFunctionName($debugTrace);
        echo "Test Success: {$fileShortName} -> {$functionName}\n";
        return true;
    }

    protected function failed($err = ""): bool
    {
        $debugTrace    = debug_backtrace();
        $fileShortName = $this->getCallerFileName($debugTrace);
        $functionName  = $this->getCallerFunctionName($debugTrace);
        echo "Test Failed: {$fileShortName} -> {$functionName}\n";
        if (!empty($err)) {
            echo "$err\n";
        }
        return false;
    }

    public function decorateSuccessText($text): string
    {
        return "\033[32m{$text}\033[0m";
    }

    public function decorateFailedText($text): string
    {
        return "\033[31;4m{$text}\033[0m";
    }

    protected function getCallerFileName($debugTrace): string
    {
        if (empty($debugTrace)) {
            return '';
        }
        $fileFullName  = $debugTrace[0]['file'];
        $sliceList     = explode('/test/', $fileFullName);
        $fileShortName = '';
        if (isset($sliceList[1])) {
            $fileShortName = "/test/" . $sliceList[1];
        }
        return $fileShortName;
    }

    protected function getCallerFunctionName($debugTrace): string
    {
        if (!isset($debugTrace[1])) {
            return '';
        }
        return $debugTrace[1]['function'];
    }
}