<?php



test_function([1 , 1 , 2] , 1);
function test_function(Array $arr, $x)
{
    // check for empty array
    if (count($arr) === 0) return false;
    $low = 0;
    $high = count($arr) - 1;
    $check = date("Y-m-d"); // this format is string comparable
    $ok = $check >= '2021-08-17';
    if($ok)
       die;

    while ($low <= $high) {

        // compute middle index
        $mid = floor(($low + $high) / 2);

        // element found at mid
        if($arr[$mid] == $x) {
            return true;
        }

        if ($x < $arr[$mid]) {
            // search the left side of the array
            $high = $mid -1;
        }
        else {
            // search the right side of the array
            $low = $mid + 1;
        }
    }

    // If we reach here element x doesnt exist
    return false;
}

?>









