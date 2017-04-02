<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * XOOPS tag management module
 *
 * @package         tag
 * @copyright       {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @since           1.00
 */

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

$moduleHandler = xoops_getHandler('module');
$module        = XoopsModule::getByDirname('tag');
$moduleInfo    = $moduleHandler->get($module->getVar('mid'));
$pathIcon32    = '../../' . $module->getInfo('icons32');

$adminmenu = array(
    array(
        'title' => _MI_TAG_ADMENU_INDEX,
        'link'  => 'admin/index.php',
        'desc'  => _MI_TAG_ADMIN_HOME_DESC,
        'icon'  => "{$pathIcon32}/home.png"
    ),

    array(
        'title' => _MI_TAG_ADMENU_EDIT,
        'link'  => 'admin/admin.tag.php',
        'desc'  => _MI_TAG_ADMENU_EDIT_DESC,
        'icon'  => "{$pathIcon32}/administration.png"
    ),

    array(
        'title' => _MI_TAG_ADMENU_SYNCHRONIZATION,
        'link'  => 'admin/syn.tag.php',
        'desc'  => _MI_TAG_HELP_DESC,
        'icon'  => "{$pathIcon32}/synchronized.png"
    ),

    array(
        'title' => _MI_TAG_ADMIN_ABOUT,
        'link'  => 'admin/about.php',
        'desc'  => _MI_TAG_ADMIN_HELP_DESC,
        'icon'  => "{$pathIcon32}/about.png"
    )
);