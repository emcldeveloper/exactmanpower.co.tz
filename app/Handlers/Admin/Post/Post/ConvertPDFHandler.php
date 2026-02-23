<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostType;
use App\Models\Location;
use App\Models\PostComment;
use App\Models\PostMedia;
use App\Models\PostMeta;
use App\Models\PostTag;
use Illuminate\Http\Request;

class ConvertPDFHandler
{
    /**
     * Display a listing of the Posts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler($file)
    {
        $files = [];
        $URL = config('backend.urls.process_file').'/process?file=';
        $filename = basename($file);
        $folder = substr($filename, 0, (strlen($filename) - 4));
        $output = dirname($file).'/'.$folder;

        if(true) {
            try {
                $content = file_get_contents($URL.asset('uploaded/'.$filename));
                $magazine_pages = json_decode($content);
            } catch (\Throwable $th) {
                throw $th;
            } 
        } else {
            if(!file_exists($output)) {
                mkdir($output);
                \Org_Heigl\Ghostscript\Ghostscript::setGsPath('C:\\Program Files\\gs\\gs9.50\\bin\\gswin64c.exe');
                $pdf = new \Spatie\PdfToImage\Pdf($file);
                $length = $pdf->getNumberOfPages();

                $pdf->setOutputFormat('jpeg');
                for ($i=1; $i <= $length; $i++) { 
                    $pagename = str_pad( $i, 4, "0", STR_PAD_LEFT );
                    $pdf->setPage($i)
                        // ->setResolution(144)
                        ->saveImage($output.'/'.$pagename.'.jpg');
                }
            }

            $files_array = scandir($output);
            $files = array_filter($files_array, function($item) {
                if($item == '.' || $item == '..') return false;

                return true;
            });
        }

        return $files;
    }
}