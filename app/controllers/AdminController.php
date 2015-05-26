<?php

class AdminController extends BaseController {
    protected $layout = 'layouts.admin-test';
    public function fix(){
        if (Auth::check()) {
            if (Auth::user()->role != 0){ // not admin
                return Redirect::to(URL::action('HomeController@showWelcome'));
            }else{
                $items = Item::all();
                foreach ($items as $item) {
                    $value = Value::where(array('item_id' => $item->id , 'attr_id' => 1))->first();
                    if ($value == null) {
                        $new_value = new Value();
                        $new_value->item_id = $item->id;
                        $new_value->attr_id = 1;
                        $new_value->value = $item->name;
                        $new_value->save();
                    }
                }
                return "abcd";
            }
        }else {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        } 
        
    }

    // Admin function about Attribute
    public function showAttribute(){
        if (Auth::check()) {
            if (Auth::user()->role != 0){ // not admin
                return Redirect::to(URL::action('HomeController@showWelcome'));
            }

            $attributes = Attribute::paginate(10);
            $this->layout->content = View::make('admin.showattr')->with(array('attributes' => $attributes));
        }else {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        } 
    }

    public function addAttribute(){
        if (Auth::check()) {
            if (Auth::user()->role != 0){ // not admin
                return Redirect::to(URL::action('HomeController@showWelcome'));
            }

            // xử lý dữ liệu gửi lên
            if (Request::isMethod('post')){
                $validator = Attribute::validate(Input::all());  
                if ($validator->fails()) {
                    return Redirect::to(URL::action('AdminController@addAttribute'))->withInput()->withErrors($validator);     
                }

                $attr_name = Input::get('attr_name');
                $attr_type = Input::get('attr_type');
                $new_attr = Attribute::where(array(
                        "attr_name" => $attr_name
                    ))->first();

                if (is_null($new_attr)) {
                    $attr = new Attribute;
                    $attr->attr_name = $attr_name;
                    $attr->attr_type = $attr_type;
                    $attr->parent_id = '0';
                    $attr->status = '1';
                    $attr->save();
                    return Redirect::to(URL::action('AdminController@postEditAttribute', $attr->id))->with('message', 'Success !!!');;
                }else{
                    return Redirect::to(URL::action('AdminController@addAttribute'))->withInput()->withErrors(array('attr_name'=>'Attribute existed !!!')); 
                }
            }

            $this->layout->content = View::make('attribute.add');
        }else {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }  
    }

    public function postDeleteAttribute(){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        try {
            $input = Input::all();
            $id = $input['id'];

            $attr = Attribute::find($id);
            $attr->delete();
            $values = Value::where('attr_id', $id)->delete();
        } catch(Exception $e) {
            return Response::json("invalid");
        }
        
        return Response::json("Success");
    }
    
    public function postEditAttribute($id){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        
        if (Request::isMethod('post')){
            $validator = Attribute::validate(Input::all());
            
            if($validator->fails()){
                return Redirect::to(URL::action('AdminController@postEditAttribute', $id))->withInput()->withErrors($validator);
            }
            else {
                $id = Input::get('id');
                $attribute = Attribute::find($id);
                $attribute->attr_name = Input::get('attr_name');
                $attribute->attr_type = Input::get('attr_type');
                $attribute->save();
                return Redirect::to(URL::action('AdminController@postEditAttribute', $id))->withInput()->with(array('message' => "Success !!! "));
            }
        }

        $attribute = Attribute::find($id);
        if($attribute == null) 
            return Response::json(404);

        $this->layout->content = View::make('attribute.edit')->with(array('id' => $attribute->id,
                                                                            'attr_name' => $attribute->attr_name,
                                                                            'attr_type' => $attribute->attr_type
                                                                            ));
    }

    public function editAttrRange($id){
        if (Auth::check()) {
            if (Auth::user()->role != 0){ // not admin
                return Redirect::to(URL::action('HomeController@showWelcome'));
            }
            
            // xử lý dữ liệu gửi lên
            if (Request::isMethod('post')){
                $ranges = Input::get('range');
                $id = Input::get('id');

                $delete = Valuerange::where("attr_id", $id)->delete();
                foreach ($ranges as $range) {
                    if ($range != "") {
                        $new_value_range = new Valuerange();
                        $new_value_range->attr_id = $id;
                        $new_value_range->value_range = $range;
                        $new_value_range->save();
                    }
                }
                return Redirect::to(URL::action('AdminController@editAttrRange', $id))->with('message', 'Success !!!');;
            }
        

            $attribute = Attribute::find($id);
            $attr_ranges = Valuerange::where("attr_id",$id)->get();
            $this->layout->content = View::make("admin.showattrrange")->with(array("id"=>$id, "attribute" => $attribute , "attr_ranges" => $attr_ranges));

        }else {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }        

        
    }
    // END Admin function about Attribute


    // Admin function about User
    public function addUser(){
        if (Auth::check()) {
            if (Auth::user()->role != 0){ // not admin
                return Redirect::to(URL::action('HomeController@showWelcome'));
            }
            
            // xử lý dữ liệu gửi lên
            if (Request::isMethod('post')){
                $validator = User::validate(Input::all());  
                if ($validator->fails()) {
                    return Redirect::to(URL::action('AdminController@addUser'))->withInput()->withErrors($validator);     
                }

                $username = Input::get('username');
                $password = Input::get('password');
                $role = Input::get('role');
                $newuser = User::where(array(
                        "username" => $username
                    ))->first();

                if (is_null($newuser)) {
                    $user = new User;
                    $user->username = $username;
                    $user->password = md5($password);
                    $user->status = '1';
                    $user->role = $role;
                    $user->save();
                    return Redirect::to(URL::action('AdminController@addUser'))->with('message', 'Success !!!');;
                }else{
                    return Redirect::to(URL::action('AdminController@addUser'))->withInput()->withErrors(array('username'=>'username existed !!!')); 
                }
            }

            $this->layout->content = View::make('admin.adduser');


        }else {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }        
    }

    public function showUser(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        $users = User::where('status', 1)->paginate(10);
        $this->layout->content = View::make('admin.showuser')->with('users', $users);
    }

    public function showDeactiveUser(){
        if (Auth::check()) {
            if (Auth::user()->role != 0){ // not admin
                return Redirect::to(URL::action('HomeController@showWelcome'));
            }
            $users = User::where('status', 0)->paginate(10);
            $this->layout->content = View::make('admin.showdeactiveuser')->with('users', $users);
        }else {
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
    }

    public function changeAdminPermission(){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        try {
            $input = Input::all();
            $id = $input['id'];

            if($id == Auth::id()) 
                throw new Exception("same user id", 1);
                  
            $user = User::find($id);

            if($user->role == 0)
                $user->role = 1;
            elseif($user->role == 1) 
                $user->role = 0;

            $user->save();

        } catch(Exception $e) {
            return Response::json("invalid");
        }
        
        return Response::json("Success");
    }

    public function postBanUser(){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("invalid");

        try {
            $input = Input::all();
            $id = $input['id'];
            if($id == Auth::id()) 
                throw new Exception("same user id", 1);
            $user = User::find($id);
            if($user->status == 1)
                $user->status = 0;
            elseif($user->status == 0) 
                $user->status = 1;
            $user->save();
        } catch(Exception $e) {
            return Response::json("invalid");
        }
        return Response::json("Success");
    }
    // END Admin function about User


    // Admin function about Item
    public function showItem(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }


        $items = Item::orderBy('id', 'dsc')->paginate(10);

        $this->layout->content = View::make('admin.showitem')
                                    ->with('items', $items);
    }

    public function addItem(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }

        $attributes = Attribute::all(); 
        $this->layout->content = View::make('item.add')->with(array('attributes' => $attributes));
    }

    public function postAddItem(){
        // validate
        $messages = array(
            '1.required' => 'Name field is required.',
            '20.required' => 'Price field is required.',
            '20.numeric' => 'Price field must be number format.',
            '6.required' => 'IMG field is required.',
        );
        $rules = array(
            '1' => 'required',
            '20' => 'required | numeric',
            '6' => 'required'
            );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if($validator->fails())
        {
            return Redirect::to(URL::action('AdminController@addItem'))->withErrors($validator);
        }
        else {
            $inputs = Input::all();
            $name = Input::get('1');
            $new_item = new Item;
            $new_item->name = $name;
            $new_item->status = '1';
            $new_item->save();
            $new_item_id = $new_item->id;
            foreach ($inputs as $key => $value) {
                if ($key != '_token')  {
                    if ($value != "") {
                        $new_value = new Value;
                        $new_value->item_id = $new_item_id;
                        $new_value->attr_id = $key;
                        $new_value->value = $value;
                        $new_value->save();
                    }
                }
            }
        }
        return Redirect::to(URL::action('AdminController@showItem'));
    }

    public function showBill(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
        $bills = Bill::where(array('status' => 0))->Paginate(12);

        foreach($bills as $bill)
        {
            $totalprice = 0;
            $user = User::find($bill->user_id);
            $bill['user'] = $user->username;

            $bill_items = BillItem::where(array('bill_id' => $bill->id))->get();
            foreach ($bill_items as $item) {
                $it = Item::findOrFail($item->item_id);
                $items_attr = $this->getOneItemAttributes($it);
                $totalprice += $items_attr['20'] * $item->number;            
            }
            $bill['amount'] = $totalprice;
        }

        $this->layout->content = View::make('admin.showbill')->with(array('bills' => $bills));
    }

    public function showConfirmBill(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
        $bills = Bill::where(array('status' => 1))->Paginate(12);
        foreach($bills as $bill)
        {
            $amount = 0;
            $user = User::find($bill->user_id);
            $bill['user'] = $user->username;

            $bill_items = BillItem::where(array('bill_id' => $bill->id))->get();
            foreach ($bill_items as $item) {
                $item_price = Value::where(array('item_id' => $item->id, 'attr_id' => '20'))->first();
                if ($item_price != null) {
                    $amount += $item_price->value * $item->number;
                }
            }
            $bill['amount'] = $amount;
        }
        $this->layout->content = View::make('admin.showconfirmbill')->with(array('bills' => $bills));
    }

    public function confirmBill(){
        if (Auth::user()->role != 0){ // not admin
            return Response::json(404);
        }
        $id = Input::get('id');
        try{
            $bill = Bill::findOrFail($id);
            if($bill->status == 1)
                $bill->status = 0;
            elseif($bill->status == 0)
                $bill->status = 1;
            $bill->save();
        } catch(Exception $e) {
            return Response::json('invalid');
        }
        return Response::json('Success');
    }

    public function deleteBill(){
        if (Auth::user()->role != 0){ // not admin
            return Response::json(404);
        }
        $id = Input::get('id');
        try {
            $bill = Bill::findOrFail($id);
            $bill_items = BillItem::where('bill_id', $id)->get();
            foreach ($bill_items as $item) {
                $item->delete();
            }
            $bill->delete();
        } catch(Exception $e) {
            return Response::json('invalid');
        }
        return Response::json('Success');
    }

    public function postDeleteItem(){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        try {
            $input = Input::all();
            $id = $input['id'];

            $item = Item::find($id);
            $old_values = Value::where('item_id', $id)->delete();
            $item->delete();
        } catch(Exception $e) {
            return Response::json("invalid");
        }
        return Response::json("Success");
    }

    public function postEditItem($id){
        if (!Auth::check() || Auth::user()->role != 0) 
            return Response::json("need admin right");
        
        $item = Item::find($id);
        
        if (Request::isMethod('post'))
        {
            // validate
            $messages = array(
            '1.required' => 'Name field is required.',
            '20.required' => 'Price field is required.',
            '20.numeric' => 'Price field must be number format.',
            '6.required' => 'IMG field is required.',
            );
            $rules = array(
                '1' => 'required',
                '20' => 'required | numeric',
                '6' => 'required'
                );
            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails()){
                return Redirect::to(URL::action('AdminController@postEditItem', $id))->withErrors($validator);
            }else {
                $item->name = Input::get('1');
                $item->save();

                $inputs = Input::all();
                $old_values = Value::where('item_id', $id)->delete();
                // var_dump($old_values);die;
                foreach ($inputs as $key => $value) {
                    if ($key != '_token') {
                         if ($value != "") {
                            Value::insert(array('item_id' => $id, 'attr_id' => $key , 'value' => $value));    
                         }
                        
                    }
                    
                }
            }
            return Redirect::to(URL::action('ItemController@getShow', $id));
        }

        
        if($item == null) 
            return Response::json(404);
        $attr = $this->getOneItemAttributes($item);
        $attributes = Attribute::all(); 
        $this->layout->content = View::make('item.edit')->with(array('item' => $item, 'attr' => $attr , 'attributes' => $attributes));
    }
    // END Admin function about Item

    // Admin function about System Setting
    public function postSysVar(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
        // Xử lý dữ liệu gửi lên
        $validator = Setting::validate(Input::all());  
        if ($validator->fails()) {
            return Redirect::to(URL::action('AdminController@showSystemVar'))->withInput()->withErrors($validator);     
        }
        $unchange = Input::get("unchange");
        $changed = Input::get("changed");
        $unchange_var = Setting::where('key','unchange')->first();
        if ($unchange_var == null) {
            $unchange_var = new Setting;
            $unchange_var->key = "unchange";
            $unchange_var->value = $unchange;
            $unchange_var->save();
        }else{
            $unchange_var->value = $unchange;
            $unchange_var->save();
        }
        $changed_var = Setting::where('key','changed')->first();
        if ($changed_var == null) {
            $changed_var = new Setting;
            $changed_var->key = "changed";
            $changed_var->value = $changed;
            $changed_var->save();
        }else{
            $changed_var->value = $changed;
            $changed_var->save();
        }
        return Redirect::to(URL::action('AdminController@showSystemVar'));
    }

    public function showSystemVar(){
        if (Auth::user()->role != 0){ // not admin
            return Redirect::to(URL::action('HomeController@showWelcome'));
        }
        // show system var         
        $unchange_var = Setting::where('key','unchange')->first();
        if ($unchange_var == null) {
            $unchange = 1;
        }else{
            $unchange = $unchange_var->value;
        }
        $changed_var = Setting::where('key','changed')->first();
        if ($changed_var == null) {
            $changed = 2;
        }else{
            $changed = $changed_var->value;
        }
        $this->layout->content = View::make('admin.showsystemvar')->with(array(
                                                                        'unchange' => $unchange,
                                                                        'changed' => $changed
                                                                        ));
    }
    // END Admin function about System Setting



 


}
