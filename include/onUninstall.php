<?php
function xoops_module_uninstall_tad_book3(&$module)
{
    global $xoopsDB;

    $date = date("Ymd");

    rename(XOOPS_ROOT_PATH . "/uploads/tad_book3", XOOPS_ROOT_PATH . "/uploads/tad_book3_bak_{$date}");

    return true;
}

function delete_directory($dirname)
{
    if (is_dir($dirname)) {
        $dir_handle = opendir($dirname);
    }

    if (!$dir_handle) {
        return false;
    }

    while ($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname . "/" . $file)) {
                unlink($dirname . "/" . $file);
            } else {
                delete_directory($dirname . '/' . $file);
            }

        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}

//�����ؿ�
function full_copy($source = "", $target = "")
{
    if (is_dir($source)) {
        @mkdir($target);
        $d = dir($source);
        while (false !== ($entry = $d->read())) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            $Entry = $source . '/' . $entry;
            if (is_dir($Entry)) {
                full_copy($Entry, $target . '/' . $entry);
                continue;
            }
            copy($Entry, $target . '/' . $entry);
        }
        $d->close();
    } else {
        copy($source, $target);
    }
}
