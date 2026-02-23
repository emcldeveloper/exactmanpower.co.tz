<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\User;

use App\Models\User;
use Illuminate\Http\Request;

class SharedHandler
{
    public static function model(Request $req)
    {
        $model = (new User)->newQuery();

        if($req->is('admin/manage-users/admin/*') || $req->is('admin/manage-users/users/*')) {
            $model->admin();
        } elseif($req->is('admin/manage-users/support/*')) {
            $model->support();
        } elseif($req->is('admin/manage-users/blogger/*')) {
            $model->blogger();
        } elseif($req->is('admin/manage-users/seller/*')) {
            $model->seller();
        }

        return $model;
    }

    public static function title(Request $request)
    {
        $value = 'Admins';

        if($request->is('*/manage-users/users/*')) {
            $value = 'Admins';
        } elseif($request->is('*/manage-users/support/*')) {
            $value = 'Support';
        } elseif($request->is('*/manage-users/blogger/*')) {
            $value = 'Blogger';
        } elseif($request->is('*/manage-users/seller/*')) {
            $value = 'Seller';
        }

        return $value;
    }

    

    public static function route(Request $req, $action = 'edit')
    {
        $value = 'admin/manage-users/users/'.$action;

        if($req->is('*/manage-users/support/*')) {
            $value = 'admin/manage-users/support/'.$action;
        } elseif($req->is('*/admin/manage-users/users/*')) {
            $value = 'admin/manage-users/users/'.$action;
        } elseif($req->is('admin/manage-users/blogger/*')) {
            $value = 'admin/manage-users/blogger/'.$action;
        } elseif($req->is('admin/manage-posts/seller/*')) {
            $value = 'admin/manage-posts/seller/'.$action;
        }

        return $value;
    }
}