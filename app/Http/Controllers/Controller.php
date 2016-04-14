<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="mycine.com",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="API Mycine.com ",
 *         description="Voici l'API permettant de récupérer des informations d'une base de données d'oeuvres cinématographique.",
 *         termsOfService="http://helloreverb.com/terms/",
 *         @SWG\Contact(
 *             email="apiteam@wordnik.com"
 *         ),
 *         @SWG\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="Find out more about Swagger",
 *         url="http://swagger.io"
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
}
