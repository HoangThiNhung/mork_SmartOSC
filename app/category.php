<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\URL;
use App\Product;
class category extends Model {

	protected $table = 'category';
    //Chỗ này inset vào db

	public function insertCategory($parentID,$name)
    {
        //Đầu tiên check cái Parent ID đã có chưa
        if($parentID == 0)
        {
            if(is_null( $this->max('rgt') )){
                $this->lft = 1;
                $this->rgt = 2;
                $this->name = $name;
                $this->deep = 1;
                $this->save();
            } else {
                $maxRgt = $this->max('rgt');
                $this->lft = $maxRgt +1;
                $this->rgt = $maxRgt + 2;
                $this->name = $name;
                $this->deep = 1;
                $this->save();
            }
        } else {
            $parent = $this->find($parentID);
            if(!is_null($parent)){
                $this->where('lft','>=',$parent['rgt'])->increment('lft', 2);
                $this->where('rgt','>=',$parent['rgt'])->increment('rgt', 2);
                $this->lft = $parent['rgt'];
                $this->rgt = $parent['rgt'] +1;
                $this->name = $name;
                $this->deep = $parent['deep'] +1;
                $this->save();
            }
        }
    }

    //Hiển thị html dưới dạng cây ở trong trang Admin
    //sao không đc nhỉ. ĐÚng pas chưa đấy. đúng mà. để xem lại xem sao 
    public function htmlMenu($menus = array(), $lft = 0,$rgt = null,$deep = 0)
    {
        global $treeMenu;
        if ($lft == 0 && $rgt== null && $deep == 0) {
            $treeMenu .= '<ul>';
        }
        foreach ($menus as $key => $val) 
        {
                
            if ($val['lft'] > $lft && ($val['rgt'] < $rgt || is_null($rgt) ) && $val['deep'] ==($deep +1)) 
            {
                unset($menus[$key]);
                $treeMenu .= '<li>';
                $treeMenu .= $val['name'] . ' ----------------------------------------------' . '<a href="'.Asset('admin/category/del/'). '/' . $val['id'].'">  <button type="button" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i></button> </a>' . '<a href="'.Asset('admin/category/update/'). '/' . $val['id'].'">  <button type="button" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-edit"></i></button> </a>' ;
                if ($val['rgt'] != $val['lft'] +1) {
                    $treeMenu .= '<ul>';
                }
                $this->htmlMenu($menus, $val['lft'],$val['rgt'],$val['deep']);
                if ($val['rgt'] != $val['lft'] +1) {
                    $treeMenu .= '</ul>';
                }
                $treeMenu .= '</li>';
            }
                
        }
        if ($lft == 0 && is_null($rgt) && $deep == 0) {
            $treeMenu .= '</ul>';
        }
        return $treeMenu;   
    }


    // MENU LEFT
    public function menu_left($menus = array(), $lft = 0,$rgt = null,$deep = 0)
    {
        global $treeMenu;
        if ($lft == 0 && $rgt== null && $deep == 0) {
            $treeMenu .= "<ul class='nav nav-pills nav-stacked category-menu'>";
        }
        foreach ($menus as $key => $val) 
        {
            $slug = Product::convert_vi_to_en($val['name']);       
            if ($val['lft'] > $lft && ($val['rgt'] < $rgt || is_null($rgt) ) && $val['deep'] ==($deep +1)) 
            {
                unset($menus[$key]);
                $treeMenu .= "<li class='active'>";
                $treeMenu .="<a href='" . url('') . "/" . "category" . "/" . $val['id'] . "/" . $slug . ".html" . "'>";
                $treeMenu .= $val['name'];
                $treeMenu .= "</a>";
                if ($val['rgt'] != $val['lft'] +1) {
                    $treeMenu .= '<ul>';
                }
                $this->menu_left($menus, $val['lft'],$val['rgt'],$val['deep']);
                if ($val['rgt'] != $val['lft'] +1) {
                    $treeMenu .= '</ul>';
                }
                $treeMenu .= '</li>';
            }
                
        }
        if ($lft == 0 && is_null($rgt) && $deep == 0) {
            $treeMenu .= '</ul>';
        }
        return $treeMenu;   
    }


    // MENU LEFT
    public function menu_top($menus = array(), $lft = 0,$rgt = null,$deep = 0)
    {
        global $treeMenu;
        if ($lft == 0 && $rgt== null && $deep == 0) {
            $treeMenu .= "<ul class='nav nav-pills nav-stacked category-menu'>";
        }
        foreach ($menus as $key => $val) 
        {
            $slug = Product::convert_vi_to_en($val['name']);       
            if ($val['lft'] > $lft && ($val['rgt'] < $rgt || is_null($rgt) ) && $val['deep'] ==($deep +1)) 
            {
                unset($menus[$key]);
                $treeMenu .= "<div class='col-sm-6'>";
                $treeMenu .= "<li>";
                $treeMenu .= "<h3>";
                $treeMenu .="<a href='" . url('') . "/" . "category" . "/" . $val['id'] . "/" . $slug . ".html" . "'>";
                $treeMenu .= $val['name'];
                $treeMenu .= "</a>";
                $treeMenu .= "</h3>";
                
                if ($val['rgt'] != $val['lft'] +1) {
                    $treeMenu .= '<ul>';



                }

                $this->menu_top($menus, $val['lft'],$val['rgt'],$val['deep']);


                if ($val['rgt'] != $val['lft'] +1) {

                    $treeMenu .= '</ul>';
                    
                }
                $treeMenu .= '</li>';
                $treeMenu .= "</div>";
                
            }
                
        }
        if ($lft == 0 && is_null($rgt) && $deep == 0) {
            $treeMenu .= '</ul>';
        }
        return $treeMenu;   
    }    

}
