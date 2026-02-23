<?php
/**
 * Picha App is un application where user can upload pictures 
 * for printing and will be deliverd to there location
 *
 * PHP version 7
 *
 * @category Application
 * @package  Picha App
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Http\Controllers\Admin\Setting;

use App\Models\TranslatorLanguage;
use Illuminate\Http\Request;

use App\Handlers\Admin\Setting\Language\IndexHandler as LanguageIndexHandler;
use App\Handlers\Admin\Setting\Language\CreateHandler as LanguageCreateHandler;
use App\Handlers\Admin\Setting\Language\StoreHandler as LanguageStoreHandler;
use App\Handlers\Admin\Setting\Language\ShowHandler as LanguageShowHandler;
use App\Handlers\Admin\Setting\Language\EditHandler as LanguageEditHandler;
use App\Handlers\Admin\Setting\Language\UpdateHandler as LanguageUpdateHandler;
use App\Handlers\Admin\Setting\Language\DeleteHandler as LanguageDeleteHandler;
use App\Handlers\Admin\Setting\Language\UpdateTranslationHandler as LanguageUpdateTranslationHandler;
//

class LanguageController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        // Run middleware for Languages controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Languages.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $api = false)
    {
        return LanguageIndexHandler::handler($request, $api);
    }

    /**
     * Display a listing of the Languages.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function api_index(Request $request)
    {
        // get data from index method on this class
        return $this->index($request, true);
    }

    /**
     * Show the form for creating a new Languages.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return LanguageCreateHandler::handler($request);
    }

    /**
     * Store a newly created Languages in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return LanguageStoreHandler::handler($request);
    }

    /**
     * Display the specified Languages.
     *
     * @param  int  $id
     * @param  \App\Models\Language  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TranslatorLanguage $languages, $id = null)
    {
        return LanguageShowHandler::handler($request, $languages, $id);
    }

    /**
     * Show the form for editing the specified Languages.
     *
     * @param  int  $id
     * @param  \App\Models\Language  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TranslatorLanguage $languages, $id = null)
    {
        return LanguageEditHandler::handler($request, $languages, $id);
    }

    /**
     * Update the specified Languages in storage.
     *
     * @param  int  $id
     * @param  \App\Models\Language  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TranslatorLanguage $languages, $id = null)
    {
        return LanguageUpdateHandler::handler($request, $languages, $id);
    }

    /**
     * Remove the specified Languages from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Language  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TranslatorLanguage $languages, $id = null)
    {
        return LanguageDeleteHandler::handler($request, $languages, $id);
    }

    // 
    /**
     * Remove the specified Languages from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Language  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update_translation(Request $request)
    {
        return LanguageUpdateTranslationHandler::handler($request);
    }
}
