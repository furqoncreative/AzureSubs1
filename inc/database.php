<?php
class Database
{
    private static $dbName = 'db_submission';
    private static $dbHost = 'furqonmysql.mysql.database.azure.com';
    private static $dbUsername = 'furqoncreative@furqonmysql';
    private static $dbUserPassword = 'Smknsitur4j473';
    private static $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::MYSQL_ATTR_SSL_CA => 'https://github.com/furqoncreative/AzureSubs1/blob/master/inc/BaltimoreCyberTrustRoot.crt.pem',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
    );
    private static $cont = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if (null === self::$cont) {
            try {
                


                self::$cont =  new PDO('mysql:host='.self::$dbHost.'; dbname='.self::$dbName, self::$dbUsername, self::$dbUserPassword, self::$options);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}