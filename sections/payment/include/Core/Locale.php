<?php
namespace Core;
class Locale {

    private static $instance;
    public static function Singleton(){
        if(!self::$instance){
            self::$instance = new self;
        }
        return self::$instance;
    }
    //prevent cloning...
    public function __clone(){}
    /**
     * The name of the currently loaded Locale
     * @var string
     */
    public $Locale = array();
    private $Splitting = true;
    private $DefaultGroup = 'Global';
    /**
     * Whether or not to record core translations
     * @var boolean
     */
    public $DeveloperMode = FALSE;
    public $LocaleLanguage = 'en';
    public $SavedDeveloperCalls = 0;
    public function __construct(){
    }
    public function setLocaleLanguage($x){
        $this->LocaleLanguage = $x;
        $this->Locale = [];
        $this->Load('Main', 'main.php');
    }
    /**
     * Load a locale definition file.
     *
     * @param string $Path The path to the locale.
     * @param boolean $Dynamic Whether this locale file should be the dynamic one.
     */
    public function Load($name, $fileName) {
        if(isset($this->Locale[$name])) return true; ///exists no need to add :|
        require(ROOT_PATH .'include'.DIRECTORY_SEPARATOR."Locale" .DIRECTORY_SEPARATOR. $this->LocaleLanguage . DIRECTORY_SEPARATOR . $fileName);
        $this->Locale[$name] =& $Definition;
    }

    public function Translate($base, $Code, $Default = FALSE) {
        if ($Default === FALSE)
            $Default = $Code;

        $Code = trim($Code);
        // Shortcut, get the whole config
        if ($Code == '.') return $this->Locale[$base];


        $Keys = explode('.', $Code);
        // If splitting is off, HANDLE IT
        if (!$this->Splitting) {
//         $FirstKey = GetValue(0, $Keys);
            $FirstKey = $Keys[0];
            if ($FirstKey == $this->DefaultGroup)
                $Keys = array(array_shift($Keys), implode('.',$Keys));
            else
                $Keys = array($Code);
        }
        $KeyCount = count($Keys);

        $Value = $this->Locale[$base];
        for ($i = 0; $i < $KeyCount; ++$i) {
            if (is_array($Value) && array_key_exists($Keys[$i], $Value)) {
                $Value = $Value[$Keys[$i]];
            } else {
                return $Default;
            }
        }
        return $Value;
    }
    public function Cleanup(){
        unset($this->Locale);
    }
}