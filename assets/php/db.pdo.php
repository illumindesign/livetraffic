/*
  Global Database Connection
*/

// DATABASE ACCESS INFORMATION ====================================================================
$db_host = 'localhost'; #CHANGE THIS TO YOUR CONFIGURATION
$db_db   = ''; #CHANGE THIS TO YOUR CONFIGURATION
$db_user = ''; #CHANGE THIS TO YOUR CONFIGURATION
$db_pass = ''; #CHANGE THIS TO YOUR CONFIGURATION
$charset = 'utf8'; #CHANGE THIS TO YOUR CONFIGURATION (if applicable)
$driver = 'mysql'; #CHANGE THIS TO YOUR CONFIGURATION (if applicable)

// DATABASE =======================================================================================
$dsn = "$driver:host=$db_host;dbname=$db_db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try{
    $db_connection = new PDO($dsn, $db_user, $db_pass, $opt);
} catch (PDOException $E) {
    die('<h1 style="text-align:center;">Cannot connect to database! Please check your database info.</h1>');
}
