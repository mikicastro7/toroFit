<?php
return array(
    // set your paypal credential
    'client_id' => 'ATfmrmOHIEb3zt4X2LN3RSimBikHAaSrIziytyfrF7D-gLWz8fBSifT5WKanzjq9nM9s8jp1G6jcDF-1',
    'secret' => 'EBQgKi3zIGgNH-CWtC8J_zHDlR7T-5UkDS6YRzXblX3eMjs9C0BQJDaKMay17McP4Acf0gFs1uZZinu2',

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
        'http.ConnectionTimeOut' => 30,

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
    ),
);