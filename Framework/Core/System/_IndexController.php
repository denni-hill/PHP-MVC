<?php

/**
 * Class _IndexController
 * all the IndexControllers (root controllers of each app) should extend this class. It already extends Base_Controller class and realises function to route requests inside the app,
 * so you can override ProcessApp method in your IndexController and make your app more flexible.
 */
abstract class _IndexController extends Base_Controller
{
    public function ProcessApp(_IndexController $controllerObj, $app_info)
    {
        $methodName = "Index";
        if (count($app_info["UriParts"]) == 0)
            $app_info["ControllerName"] = "Index";
        else $app_info["ControllerName"] = array_shift($app_info["UriParts"]);

        if (strtolower($app_info["ControllerName"]) == "api") {
            $methodName = "ApiIndex";
            if (count($app_info["UriParts"]) == 0)
                $app_info["ControllerName"] = "Index";
            else $app_info["ControllerName"] = array_shift($app_info["UriParts"]);
        }

        define("ACTIVE_VIEW", $app_info["ControllerName"]);
        $app_info["ControllerName"] .= "Controller";

        if(strtolower($app_info["ControllerName"]) == "indexcontroller")
        {
            if(method_exists($controllerObj, $methodName))
            {
                $controllerObj->$methodName($app_info);
            }
            else moveTo('/404/');
        }
        else
        {
            if(file_exists(ACTIVE_APP_DIR . '/' . $app_info["ControllerName"] . ".php"))
            {
                require(ACTIVE_APP_DIR . '/' . $app_info["ControllerName"] . ".php");
                $controllerObj = new $app_info["ControllerName"]();
                if(method_exists($controllerObj, $methodName))
                {
                    $controllerObj->$methodName($app_info);
                }
                else moveTo('/404/');
            }
            else moveTo('/404/');
        }
    }
}