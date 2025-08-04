<?php

namespace App\classes;


use DebugBar\JavascriptRenderer;
use DebugBar\StandardDebugBar;

class debugBarSingletonSettings{
    public string $baseUrl {
        get {return $this->baseUrl;}
    }
    public function __construct(string $baseUrl = "http://localhost:8000/Resources"){
        $this->baseUrl = $baseUrl;
    }
}
class DebugBarSingleton
{
    protected static $_debugbar= null;
    protected static debugBarSingletonSettings $_settings ;

    protected static JavascriptRenderer  $_jsRenderer;

    public static function getJsRenderer(): JavascriptRenderer
    {
        return self::$_jsRenderer;
    }
    public function __construct(?debugBarSingletonSettings $settings){
        self::$_settings = empty($settings) ?  new debugBarSingletonSettings() : $settings;

    }

    public static function getDebugBar(?debugBarSingletonSettings $settings= null): StandardDebugBar{
        self::$_settings = empty($settings) ?  new debugBarSingletonSettings() : $settings;
        if(empty(self::$_debugbar)){
            self::$_debugbar = new StandardDebugBar();
             self::$_jsRenderer= self::$_debugbar->getJavascriptRenderer(self::$_settings->baseUrl,);
        }
        return self::$_debugbar;
    }

}