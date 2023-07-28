<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Valid mya_deployment names
    |--------------------------------------------------------------------------
    |
    | The list of valid names of mya deployments
    |
    */
    'mya_deployments' => ['history', 'ops'],
    /*
    |--------------------------------------------------------------------------
    | Data Set Statuses
    |--------------------------------------------------------------------------
    |
    | The valid status values for a data set
    |   ACTIVE:    Receiving periodic updates
    |   DISABLED:  Periodic updating is paused
    |   NEW:       Data set has been created but has no data yet
    |   POPULATED: Data set has been populated
    |   QUEUED:    Data set has been queued for background data fetching
    */
    'data_set_statuses' => ['ACTIVE', 'DISABLED', 'NEW', 'POPULATED', 'QUEUED'],

    /*
    |--------------------------------------------------------------------------
    | Data Set Export Directory
    |--------------------------------------------------------------------------
    |
    | The relative name of the directory where data files will be stored by default
    |
    */
    'data_sets_export_dir' => 'data-sets',

    /*
    |--------------------------------------------------------------------------
    | Data Export Directory
    |--------------------------------------------------------------------------
    |
    | The relative name of the directory where data files will be stored by default
    |
    */
    'data_export_dir' => 'data',

];
