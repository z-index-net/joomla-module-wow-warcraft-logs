<?php

/**
 * @author     Branko Wilhelm <branko.wilhelm@gmail.com>
 * @link       http://www.z-index.net
 * @copyright  (c) 2015 Branko Wilhelm
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

class ModWoWWarcraftLogsHelper extends WoWModuleAbstract
{
    protected function getInternalData()
    {
        try
        {
            if (!$this->params->module->get('public_api_key'))
            {
                return JText::_('MOD_WOW_WARCRAFTLOGS_API_KEY_MISSING');
            }

            $result = WoW::getInstance()->getAdapter('WarcraftLogs')->getData($this->params->module->get('public_api_key'));
        } catch (Exception $e)
        {
            return $e->getMessage();
        }

        $result->body = array_slice(array_reverse($result->body), 0, $this->params->module->get('raids', 10));

        foreach ($result->body as $log)
        {
            $log->duration = $this->duration($log->end - $log->start);
        }

        return $result->body;
    }

    private function duration($msec)
    {
        $hour = (int)($msec / 1000 / 60 / 60);
        $msec = $msec - $hour * 60 * 60 * 1000;
        $min = (int)($msec / 1000 / 60);
        $msec = $msec - $min * 60 * 1000;
        $sec = (int)($msec / 1000);

        return $hour . ':' . $min;
    }
}