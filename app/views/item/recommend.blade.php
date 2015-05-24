      
      <ul class="_list-item">
        <?php $count = 1; ?>
        @foreach($recommend_list as $key => $value)
        <?php 
          $item = Item::find($key);
          $img_attr = Value::where(array('item_id' => $item->id , 'attr_id' => '6'))->first()->value;
          if ($img_attr == null) {
            $img = "https://www.thegioididong.com/images/42/69783/iphone-6-plus-16gb-99.png";
          }else{
            $img = $img_attr;
          }

          $price_attr = Value::where(array('item_id' => $item->id , 'attr_id' => '20'))->first()->value;
          if ($price_attr == null) {
            $price = 0;
          }else{
            $price = $price_attr;
          }
          
          $attr_description = "";
          if (isset($critique_attr)) {
            foreach ($critique_attr as $key => $value) {
              if ($value != "") {
                $attr_value_object = Value::where(array('item_id' => $item->id , 'attr_id' => $key))->first();
                if ($attr_value_object != null) {
                  $attr_value = $attr_value_object->value;
                  $attr_name = Attribute::find($key)->attr_name;
                  $attr_description .= $attr_name . " " . $attr_value . ",  ";
                }
              }
            }
          }else{
            $os = Value::where(array('item_id' => $item->id , 'attr_id' => 7))->first();
            if ($os !=null) {
              $os_name = $os->value;
              $attr_description = $attr_description . $os_name . ",  ";
            };
            $battery = Value::where(array('item_id' => $item->id , 'attr_id' => 13))->first();
            if ($battery !=null) {
              $battery_name = $battery->value;
              $attr_description =  $attr_description . "Battery " . $battery_name . ",  ";
            };
            $ram = Value::where(array('item_id' => $item->id , 'attr_id' => 16))->first();
            if ($ram !=null) {
              $ram_name = $ram->value;
              $attr_description = $attr_description . "RAM " . $ram_name . "GB";
            };
              
          }

          if(Auth::check()) {
            $favorite = Favoriteitem::where(array('user_id' => Auth::user()->id, 'item_id' => $item->id))->first();
          }else{
            $favorite = null;
          }
          

        ?>



        <li>
          <span class="_stt">{{$count}}</span>
          <a href="{{ URL::action('ItemController@getShow', $item->id ) }}" data-images="{{$img}}">
            <img alt="{{$item->name}}" class="product-image" src="{{$img}}">
          </a>
          <div class="_content">
            <span class="product-price">
              {{number_format($price)}}
            </span>
              <p>{{$item->name}}</p>
              <p>{{$attr_description}}</p>
              @if(isset($favorite->item_id))
              <i class="glyphicon glyphicon-star"></i> <i>In Your favorite</i> <i class="glyphicon glyphicon-star"></i>
              @endif
            </div>
          </li>
        <?php $count += 1; ?>
        @endforeach
          
      </ul>
