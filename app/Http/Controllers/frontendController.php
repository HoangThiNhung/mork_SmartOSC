<?php namespace App\Http\Controllers;

use App\Classifier;
use App\Http\Requests;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\category;
use App\Product;
use App\Slider;
use App\Comment;
use App\Order;
use App\Order_detail;
use App\Image;
use App\Color;
use App\Size;
use App\MapColor;
use App\MapSize;
use App\News;
use App\User;
use App\Recommend;
use App\newsComment;
use App\classification;
use Request;
use Input;
use Validator;
use PHPMailer;
use Auth;
use Hash;
use Mail;
use Redirect;
use Session;
use DB;

class frontendController extends Controller {


	public function getRegister(){
		return view ('auth.register');
	}

	public function postRegister(Request $Request){
		$input = Input::all();
		$rules = [
			'name' => 'required',
		 	'email' => 'required|email|unique:users,email',
		 	'password' => 'required',
		 	'password_confirmation' => 'required|same:password',
		];
		 $validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		 	return redirect('/register')->withErrors($validator);
		} else {
		 	$obj = new user;
		 	$obj->name = Input::get('name');
		 	$obj->email = Input::get('email');
			$obj->password = hash::make(Request::get('password'));
			$obj->status = 'unactive';
			$obj->active_token = md5(time());
			$obj->save();

		 	$obj->sendMail(Input::get('email'),Input::get('name'),$obj->active_token, $obj->id  );
		 	return redirect('/auth/login')->withErrors(['error' => 'Please check Email active account ']);
		}
		

		
	}
	public function getLogin(){
		return view('auth.login');
	}

	public function postLogin(){
		if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')]))
		{
     		echo 'dang nhap thanh cong';
		}else{
			echo 'dang nhap that bai';
		}
		
	}

	public function getActive(){
		return view('auth.active');
	}

	public function postActive(){
		$obj = new user;
		$obj->where('remember_token','=',Request::get('code'))->update(['status'=>'active']);
		return view('auth.login');
	}

	public function index(){
		$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
		$hot = new Product;
		$man = new Product;
		$slider = Slider::all();
		$hotman = $man ->getHotman();
		$hotPro = $hot ->getHotPro();
		$news = News::getNewsInIndex();
		$auth= User::all();
		return view ('frontend.pages.index',array(
													'menu_top'=>$menu_top, 
													'hotPro'=>$hotPro, 
													'hotman'=>$hotman,
													'slider'=>$slider,
													'news'=>$news,
													'auth'=>$auth
													));
	}

	public function detail($id){
		$product= Product::find($id);
		$rel = new Product;
		$img = Image::getImage($id);
		$color = Color::all();
		$size = Size::all();
		$mapColor = MapColor::getColor($id);
		$mapSize = MapSize::getSize($id);
		$cat = category::all();
		$rateAvg = Comment::getAvg($id);
		$count 	 = Comment::getCount($id);
		$review  = Comment::getreviewProduct($id);
		$relative = $rel->getRelative($product->category_id,$id);
		$obj = new category;
		// navbar
		$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());

		$temp=array(
          "id"        =>$product->id,
          "name"      =>$product->name,
          "thumbnail" =>$product->image,
          "price"     =>$product->price
        );

        $data=  Session::get('cookie');

      	//$data[$product->id]=$temp;
      	if(is_null($data)){
          $data[$product->id]=$temp;
        }elseif (isset($data[$product->id])) {
          unset($data[$product->id]);
          $data[$product->id]=$temp;
        }else {
          $data[$product->id]=$temp;
        }
        
        Session::put('cookie', $data);
		
		
		$menu =  $obj->menu_left($obj->all()->toArray());
		
		return view('frontend.pages.subpages.detail', array(
													'product'=>$product,
													'relative'=>$relative,
													'cat'=>$cat,
													'rateAvg'=>$rateAvg,
													'count'=>$count,
													'review'=>$review,
													'menu'=>$menu,
													'img'=>$img,
													'color'=>$color,
													'size'=>$size,
													'mapColor'=>$mapColor,
													'mapSize'=>$mapSize,

													'menu_top'=>$menu_top
													));
	}

	public function category($id){

		$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());

		$category = Product::getproductcate($id);
		$cat = category::all();
		return view('frontend.pages.category', array(
														'category'=>$category,
														'cat'=>$cat,
														'id'=>$id,
														'menu_top'=>$menu_top,
														));
	}

	public function search(){
		$key =  $_GET['keyword'];
		$data = Product::search($key);

		$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
		return view('frontend.pages.search',array('data'=>$data, 'menu_top'=>$menu_top ));
	}

	public function addreview($id){
		$data = Input::all();
		Comment::addreview($id,$data);
		return Redirect::back();
		//return Comment::addreview($id,$data);
	}

	public function delreview($id){
		Comment::find($id)->delete();
		return back();

	}

	public function addcart($id,$number){
		$request = Request::all();
    	$product=  Product::find($id);

    	if(isset($_POST['number'])){
    		$number = (float)$_POST['number'];
    	}
        
        $temp=array(
          "id"        =>$product->id,
          "name"      =>$product->name,
          "quantity"  =>$number,
          "thumbnail" =>$product->image,
          "price"     =>$product->price,
          "color"	  =>$request['color'],
          "size"	  =>$request['size']
        );

        $data=  Session::get('cart');
        if(is_null($data)){
          $data[$product->id]=$temp;
        }elseif (isset($data[$product->id])) {
          $data[$product->id]["quantity"]+=$number;
        }else {
          $data[$product->id]=$temp;
        }
        
        Session::put('cart', $data);

        //return Redirect::to("/")->with('success', "Đã thêm sản phẩm vào giỏ hàng. ");
        return Redirect::back();
    }

    public function getCart(){
    	$colors= Color::all();
    	$sizes= Size::all();
    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
		$product = new Product;
		$all = $product->getall()->take(5);
    	return view('frontend.pages.cart', array(
    										'colors'=>$colors,
    										'sizes' =>$sizes,
    										'menu_top'=>$menu_top,
    										'all'=>$all
    										));
    }

    public function deleteCart($id){
    	$data = Session::get('cart');
    	unset($data[$id]);
    	if(empty($data)){
    		Session::forget('cart');
    	}else Session::put('cart',$data);

    	return Redirect::back();
    }

    public function updatecart(Request $Request){
        $data= Input::all();
       	$ssData=Session::get('cart');
		$rules=array();

		foreach($ssData as $ss){
		   $ssData[$ss['id']]['quantity']=(float)$data["quantity{$ss['id']}"];
		   if((float)$data["quantity{$ss['id']}"]==0){
		   		$this->deletecart($ss['id']);
		   } 
		}       
		Session::put("cart",$ssData);
		return Redirect::to('cart');
    }

    public function getCheckout(){
    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
    	return view('frontend.pages.checkout',compact('menu_top'));
    }

    public function addOrder(OrderRequest $request){
    	$checkout = $request->all();
    	$data = Session::get('cart');
    	$orderid = Order::addOrder($checkout,$data);

    	foreach ($data as $key) {	
    		# code...
    		Order_detail::addOrder_detail($orderid,$key);
    	}

    	Session::forget('cart');
    	return redirect('/cart')->withErrors(['error' => 'Vui lòng kiểm tra email để xác nhận đơn hàng']);
    }

    public function news(){
    	$news = News::getList();
    	$author = User::all();
    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
    	return view('frontend.pages.listBlog', array('news'=>$news,
    												'author'=>$author,
    												'menu_top'=>$menu_top
    												));
    }

    public function post($id){
    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());

    	$news = News::getList();
    	$post = News::find($id);
    	$auth = User::all();
    	$count 	 = newsComment::getCount($id);
		$review  = newsComment::getreview($id);
    	return view('frontend.pages.post', array('post' =>$post,
    											'auth'=>$auth,
    											'news'=>$news,
    											'menu_top'=>$menu_top,
    											'count'=>$count,
    											'review'=>$review 
    											));
    }

    public function newsComment($id){
		$data = Input::all();
		newsComment::addreview($id,$data);
		return Redirect::back();
	}

	public function delreviewNews($id){
		newsComment::find($id)->delete();
		return back();

	}

    public function contact(){
    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
    	return view('frontend.pages.contact',compact('menu_top'));
    }

    public function tetris(){
    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
    	return view('frontend.pages.tetris',array('menu_top' =>$menu_top));
    }

    public function chat(){
    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
    	return view('frontend.pages.chat',array('menu_top' =>$menu_top ));
    }

    public function recommend(){


    	$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
    	return view('frontend.pages.recommend',array('menu_top' =>$menu_top ));
		//return view('frontend.pages.recommend');
    }

    public function recommend_analyze(){
    	$data = Input::all();

    	spl_autoload_register(function($class_name){
			$file_name = str_replace('\\', '/', $class_name);
			$file_name = str_replace('_', '/', $file_name);
			$file = dirname(__FILE__) . "/src/$file_name.php";
			if(is_file($file)) include $file;
		});

		$tokenizer = new Recommend;
		$classifier = new Classifier($tokenizer);

		$train = Recommend::all();
		// training file here
		foreach ($train as $key) {
			# code...
			$classifier->train($key['label'], $key['context']);
		}
		// $classifier->train('Hot', 'It is so hot');
		// $classifier->train('Cold', 'it is very cold');

		$groups = $classifier->classify($data['content']);
		$rec = classification::find($groups);
		$content = $data['content'];
		$nav = new category;
		$menu_top = $nav->menu_top($nav->all()->toArray());
		$pro = new Product;
		$product = $pro ->getRecommend($groups);
		return view('frontend.pages.result',array(
												'groups'=>$groups,
												'content'=>$content, 
												'menu_top'=>$menu_top,
												'rec'=>$rec,
												'product'=>$product
												));
		//return $groups;
    }
}
