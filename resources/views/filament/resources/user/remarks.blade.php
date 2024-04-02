@php
    $remark = $getState('latestRemark');

    if ($remark !== null) {
        $remark = $remark->toArray();
        $status = $remark['status'];
        $classNames = 'bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500';
        /*if($status == 'received' || $status == 'deferred'){
            $classNames = 'bg-primary-100 text-primary-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-primary-700 dark:text-primary-300';
        }else if($status == 'scheduled'){
            $classNames = 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-700 dark:text-red-400 border border-red-500';
        }else if($status == 'interviewed'){
            $classNames = 'bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500';
        }else if($status == 'rejected'){
            $classNames = 'bg-danger-100 text-danger-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-danger-700 dark:text-danger-300';
        }else if($status == 'hired' || $status === 'intern'){
            $classNames = 'bg-success-100 text-success-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-success-700 dark:text-success-300';
        }*/
        echo '<span class="'.$classNames.'">'.ucfirst($status).'</span>';
    } else {
        echo '';
    }
@endphp

