<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
ini_set('display_errors',1);
load::sys_class('web');

class index extends web
{
    public function __construct()
    {
        global $_M;
        parent::__construct();
    }

    /**
     * 恢复栏目文件.
     */
    public function dorecover_column()
    {
        global $_M;
        $columnclass = load::mod_class('column/column_op', 'new');
        $columnclass->do_recover_column_files();
    }

}