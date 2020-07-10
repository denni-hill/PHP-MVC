<?php

class IndexController extends _IndexController implements iController, iApi
{

    public function Index(array $app_info)
    {
        echo "Hello, World!<br>";
        echo "Try /Home/api or /Home/api/Index to call ApiIndex function!";
    }

    public function ApiIndex(array $app_info = array())
    {
        $response = new AjaxResponder();
        $response->AddArgument("Greeting", "Hello, World!");
        $response->AddArgument("Advices", [
            "Try /Home or /Home/Index to call Index function!",
            "Use AjaxResponder only to handle ajax requests!"
        ]);
        $response->AddArgument("App info contents", $app_info);
        $jsonResponse = $response->GetJsonServerAnswer();

        echo "Check your console!";
        echo "<script>console.log($jsonResponse)</script>";
    }
}
