<?php

namespace Sumian\DingtalkErrorNotifier;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\StreamHandler;

class DingtalkRobotHandler extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        $channelName = config('notifier.ding_channel');
        $dingChannel = config("ding.{$channelName}");
        if ($dingChannel) {
            if (!empty($record['formatted'])) {
                $message = (string)$record['formatted'];
            } else {
                $message = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            }
            ding()->with($channelName)->text($message);
        }
    }
}
