<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FcfVendor\Monolog\Handler;

use FcfVendor\RollbarNotifier;
use Exception;
use FcfVendor\Monolog\Logger;
/**
 * Sends errors to Rollbar
 *
 * If the context data contains a `payload` key, that is used as an array
 * of payload options to RollbarNotifier's report_message/report_exception methods.
 *
 * Rollbar's context info will contain the context + extra keys from the log record
 * merged, and then on top of that a few keys:
 *
 *  - level (rollbar level name)
 *  - monolog_level (monolog level name, raw level, as rollbar only has 5 but monolog 8)
 *  - channel
 *  - datetime (unix timestamp)
 *
 * @author Paul Statezny <paulstatezny@gmail.com>
 */
class RollbarHandler extends \FcfVendor\Monolog\Handler\AbstractProcessingHandler
{
    /**
     * Rollbar notifier
     *
     * @var RollbarNotifier
     */
    protected $rollbarNotifier;
    protected $levelMap = array(\FcfVendor\Monolog\Logger::DEBUG => 'debug', \FcfVendor\Monolog\Logger::INFO => 'info', \FcfVendor\Monolog\Logger::NOTICE => 'info', \FcfVendor\Monolog\Logger::WARNING => 'warning', \FcfVendor\Monolog\Logger::ERROR => 'error', \FcfVendor\Monolog\Logger::CRITICAL => 'critical', \FcfVendor\Monolog\Logger::ALERT => 'critical', \FcfVendor\Monolog\Logger::EMERGENCY => 'critical');
    /**
     * Records whether any log records have been added since the last flush of the rollbar notifier
     *
     * @var bool
     */
    private $hasRecords = \false;
    protected $initialized = \false;
    /**
     * @param RollbarNotifier $rollbarNotifier RollbarNotifier object constructed with valid token
     * @param int             $level           The minimum logging level at which this handler will be triggered
     * @param bool            $bubble          Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(\FcfVendor\RollbarNotifier $rollbarNotifier, $level = \FcfVendor\Monolog\Logger::ERROR, $bubble = \true)
    {
        $this->rollbarNotifier = $rollbarNotifier;
        parent::__construct($level, $bubble);
    }
    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        if (!$this->initialized) {
            // __destructor() doesn't get called on Fatal errors
            \register_shutdown_function(array($this, 'close'));
            $this->initialized = \true;
        }
        $context = $record['context'];
        $payload = array();
        if (isset($context['payload'])) {
            $payload = $context['payload'];
            unset($context['payload']);
        }
        $context = \array_merge($context, $record['extra'], array('level' => $this->levelMap[$record['level']], 'monolog_level' => $record['level_name'], 'channel' => $record['channel'], 'datetime' => $record['datetime']->format('U')));
        if (isset($context['exception']) && $context['exception'] instanceof \Exception) {
            $payload['level'] = $context['level'];
            $exception = $context['exception'];
            unset($context['exception']);
            $this->rollbarNotifier->report_exception($exception, $context, $payload);
        } else {
            $this->rollbarNotifier->report_message($record['message'], $context['level'], $context, $payload);
        }
        $this->hasRecords = \true;
    }
    public function flush()
    {
        if ($this->hasRecords) {
            $this->rollbarNotifier->flush();
            $this->hasRecords = \false;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function close()
    {
        $this->flush();
    }
    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->flush();
        parent::reset();
    }
}