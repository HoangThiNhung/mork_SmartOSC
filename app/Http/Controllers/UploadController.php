<?php 
namespace App\Http\Controllers;

use Request;
use DB;
use Validator;
use Input;
use File;
use App\User;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('backend.pages.upload.uploadimages');
    }
}
?>