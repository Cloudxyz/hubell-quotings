<?php
if (! function_exists('current_user')) {
    function current_user()
    {
        return auth()->user();
    }
}

if (! function_exists('check_auth')) {
    function check_auth()
    {
        if(auth()->user()){
            return auth()->user()->id;
        }else{
            return null;
        }
    }
}

if (!function_exists('generateColumnsRoles')) {
    function generateColumnsRoles($array, $number, $user = false, $show = false)
    {
        $count = 1;
        $html = "<div class='row'>";
        foreach ($array as $index => $item){
            $upperWord = ucwords($item->name);
            if ($count % $number == 1){
                $html .= "<div class='col-sm'>";          
            }
            
            if(!$show){
                $html .= '<div class="form-check">';
                if($user){
                    $checked = ($user->hasRole($item->name)) ? "checked" : "";
                }else{
                    $checked = "";
                }
                $html .= <<<"EOT"
                            <input class="form-check-input" type="checkbox" name="roles[]"
                                id="role_$index" value="$item->name" $checked>
                        EOT;
            }else{
                $html .= '<div>';
                $html .= '<i class="bi bi-check-square-fill text-primary"></i>';
            }
            $html .= <<<"EOT"
                        <label class="form-check-label" for="role_$index">
                            $upperWord
                        </label>
                    EOT;
            $html .= '</div>';
            if ($count % $number == 0) {
                $html .= "</div>";
            }
            $count++;
        }
        if ($count % $number != 1) {
            $html .= "</div>";
        }
        $html .= "</div>";
        return $html;
    }
}

if (!function_exists('getSubString')) {
    function getSubString($text, $length = 50){
        $text = trim($text);
        if(strlen($text) > $length){
            $text = substr($text, 0, $length);
            $text = substr($text, 0, strrpos($text, ' '));
            $text .= '...';
        }
        return $text;
    }
}

if (!function_exists('getStatusSolicitation')) {
    function getStatusSolicitation($status){
        $statusName = App\Models\StatusSolicitation::find($status)->name;
        switch ($status) {
            case 1:
                $badge = 'primary';
                break;
            case 2:
                $badge = 'warning';
                break;
            case 3:
                $badge = 'success';
                break;
            case 4:
                $badge = 'danger';
                break;
            default:
                $badge = 'danger';
                break;
        }

        $response = '<span class="badge bg-'.$badge.'">'.$statusName.'</span>';
        return $response;
    }
}

if (!function_exists('getAuditClean')) {
    function getAuditClean($values){
        $response = [];
        foreach ($values as $ix => $value){
            $ix = str_replace('_', ' ', $ix);
            switch ($ix) {
                case 'status':
                    $response[] = ucwords($ix).': '.getStatusSolicitation($value).'<br />';
                    break;
                case 'divorce id':
                    $response[] = 'Divorce: '.getTypeDivorce($value).'<br />';
                    break;
                default:
                    $response[] = ucwords($ix).': '.$value.'<br />';
                    break;
            }
        }
        return $response;
    }
}