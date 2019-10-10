<?php
function export($data, $captions, $type='xls', $filename, $sheet_name='sheet1')
{
    if (!in_array($type, ['xls', 'csv'])) {
        $type = 'xls';
    }
    
    $fn = $filename.'-'.date('Y-m-d_H-i-s');
    
    \Excel::create($fn, function ($excel) use ($data, $captions,$sheet_name) {
        $excel->sheet($sheet_name, function ($sheet) use ($data, $captions) {
            $sheet->fromArray($data, null, 'A1', false, false);
            $sheet->prependRow(1, $captions);
            $sheet->freezeFirstRow();
        });

    })->export($type);
}

function isNoneAuthorizeAction($actionName)
{
    $noneAuthorizeActions = config("constants.NONE_AUTHORIZE_ACTIONS");
    $actionArray = explode('.', $actionName);
    $key = $actionArray[0];
    if (count($actionArray) > 1)
        $actionAllItem = $key.".*";
    else
        $actionAllItem = null;
    return in_array($actionName, $noneAuthorizeActions) || in_array($actionAllItem, $noneAuthorizeActions);

    
}