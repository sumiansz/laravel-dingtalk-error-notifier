<?php

namespace Sumian\DingtalkErrorNotifier;

use Monolog\Handler\StreamHandler;
use Monolog\Handler\AbstractProcessingHandler;

class DingtalkRobotHandler extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        $channelName = config('notifier.ding_channel');
        $dingChannel = config("ding.{$channelName}");
        if ($dingChannel) {
            ding()->with($channelName)->text(json_encode($record, JSON_UNESCAPED_UNICODE));
        }
    }
}
