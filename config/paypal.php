<?php


return [


    /** set your paypal credential **/
    'client_id' =>'Aeqlb3fKMaDYdErYGLYQvWm9d3XG8xg-D7OsopiujCEWtqfYShgz4P4MoPNtM7gCPM5FH4f7hh-tvFPf',
    'secret' => 'ENG8wYVGSAAWuNfGusoPOC0mbgEy-6Ox0p3_euhLoOQbf3sPrefjLRMqhjgD8iSn4RCw1dK42w1yaAXR',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 1000,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    )


    ];