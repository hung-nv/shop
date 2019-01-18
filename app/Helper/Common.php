<?php
function getAllParentsCategory($data, $category_id, &$result)
{
    foreach ($data as $k => $v) {
        if ($v['id'] == $category_id) {
            $result[] = $v['id'];
            unset($data[$k]);
//            if ($v['parent_id'] == null) {
//                break;
//            }
            getAllParentsCategory($data, $v['parent_id'], $result);
        } else {
            continue;
        }
    }
}

function renderDataWithClass($content, $class)
{
    $content = nl2br($content);
    $data = explode('<br />', $content);
    $item = [];
    foreach ($data as $i) {
        $item[] = '<p class="' . $class . '">' . $i . '</p>';
    }
    $text = implode('', $item);
    return $text;
}

?>