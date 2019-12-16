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
 * @package         XoopsModules\Tag
 * @copyright       {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @since           1.00
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * @param  array  $queryarray
 * @param  string $andor
 * @param  int    $limit
 * @param  int    $offset
 * @param  int    $userid
 * @param  string $sortby
 * @return array
 */
function &tag_search($queryarray, $andor, $limit, $offset, $userid, $sortby = 'tag_term ASC')
{
    $ret   = [];
    $count = is_array($queryarray) ? count($queryarray) : 0;
    if (0 >= $count) {
        return $ret;
    }
    $fields = ['tag_id', 'tag_term'];
    $tagHandler = \XoopsModules\Tag\Helper::getInstance()->getHandler('Tag');
    $criteria = new \CriteriaCompo();
    if ('exact' === $andor) {
        $criteria->add(new \Criteria('tag_term', $queryarray[0]));
        for ($i = 1; $i < $count; ++$i) {
            $criteria->add(new \Criteria('tag_term', $queryarray[$i]), $andor);
        }
    } else {
        $criteria->add(new \Criteria('tag_term', "%{$queryarray[0]}%", 'LIKE'));
        for ($i = 1; $i < $count; ++$i) {
            $criteria->add(new \Criteria('tag_term', "%{$queryarray[$i]}%", 'LIKE'), $andor);
        }
    }
    if ($sortby) {
        $sbArray = explode(' ', $sortby);
        if (0 < count($sbArray)) {
            $criteria->setSort($sbArray[0]);
            if (isset($sbArray[1])) {
                $criteria->order = $sbArray[1];
            }
        }
    }
    $tagObjArray = $tagHandler->getAll($criteria, $fields);
    foreach ($tagObjArray as $tagId => $tagObj) {
        $ret[] = [
            'link' => 'view.tag.php?tag=' . $tagId,
            'title' => $tagObj->getVar('tag_term')
        ];
    }

    return $ret;

    /*
    $sql   = 'SELECT tag_id, tag_term FROM ' . $GLOBALS['xoopsDB']->prefix('tag_tag');
    if ($count > 0) {
        if ('exact' === $andor) {
            $sql .= " WHERE tag_term = '{$queryarray[0]}'";
            for ($i = 1; $i < $count; ++$i) {
                $sql .= " {$andor} tag_term = '{$queryarray[$i]}'";
            }
        } else {
            $sql .= " WHERE tag_term LIKE '%{$queryarray[0]}%'";
            for ($i = 1; $i < $count; ++$i) {
                $sql .= " {$andor} tag_term LIKE '%{$queryarray[$i]}%'";
            }
        }
    } else {
        return $ret;
    }

    if ($sortby) {
        $sql .= " ORDER BY {$sortby}";
    }
    $result = $GLOBALS['xoopsDB']->query($sql, $limit, $offset);
    $i      = 0;
    while (false !== ($myrow = $GLOBALS['xoopsDB']->fetchArray($result))) {
        $ret[$i]['link']  = 'view.tag.php?tag=' . $myrow['tag_id'];
        $ret[$i]['title'] = $myrow['tag_term'];
        ++$i;
    }

    return $ret;
    */
}
