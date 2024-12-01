<?php

if (!function_exists('merge')) {
    function merge($arrays)
    {
        $result = [];

        foreach ($arrays as $array) {
            if ($array !== null) {
                if (gettype($array) !== 'string') {
                    foreach ($array as $key => $value) {
                        if (is_integer($key)) {
                            $result[] = $value;
                        } elseif (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                            $result[$key] = merge([$result[$key], $value]);
                        } else {
                            $result[$key] = $value;
                        }
                    }
                } else {
                    $result[count($result)] = $array;
                }
            }
        }

        return join(" ", $result);
    }
}

if (!function_exists('uncamelize')) {
    function uncamelize($camel, $splitter = "_")
    {
        $camel = preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', $splitter . '$0', $camel));
        return strtolower($camel);
    }
}

if (! function_exists('isRole')) {
    function isRole($role)
    {
        switch ($role) {
            case 'super_admin':
                return (auth()->user()->active === 1) ? true : false;
                break;

            case 'admin':
                return (auth()->user()->active === 0) ? true : false;
                break;

            default:
                return false;
                break;
        }
    }
}

if (! function_exists('checkRoles')) {
    function checkRoles($roles)
    {
        if (isRole('super_admin')) {
            return true;
        }

        foreach($roles as $role) {
            if (isRole($role)) {
                return true;
            }
        }

        return false;
    }
}
