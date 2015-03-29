<?php

/**
 * @author     Branko Wilhelm <branko.wilhelm@gmail.com>
 * @link       http://www.z-index.net
 * @copyright  (c) 2015 Branko Wilhelm
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @var        array $logs
 * @var        stdClass $module
 * @var        Joomla\Registry\Registry $params
 */

defined('_JEXEC') or die;

JFactory::getDocument()->addStyleSheet('media/' . $module->module . '/css/default.css');
?>
<?php if ($params->get('ajax')) : ?>
    <div class="mod_wow_warcraftlogs ajax"></div>
<?php else: ?>
    <table class="mod_wow_warcraftlogs">
        <thead>
        <tr>
            <th class="title"><?php echo JText::_('MOD_WOW_WARCRAFTLOGS_TITLE'); ?></th>
            <th class="duration"><?php echo JText::_('MOD_WOW_WARCRAFTLOGS_DURATION'); ?></th>
            <th class="date"><?php echo JText::_('MOD_WOW_WARCRAFTLOGS_DATE'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td class="title">
                    <?php echo JHtml::_('link', 'http://www.warcraftlogs.com/reports/' . $log->id, $log->title, array('target' => '_blank')); ?>
                </td>
                <td class="duration">
                    <?php echo $log->duration; ?>
                </td>
                <td class="date">
                    <?php echo JHtml::_('date', ($log->start / 1000), JText::_('d.m')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>