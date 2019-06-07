 <nav class="navbar    navbar-fixed-top navbar-expand-md navbar-dark" id="banner">
     <div class="container-fluid mr-4">
         <div class="row">
             <!-- Brand -->


             <!-- Toggler/collapsibe Button -->
             <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                 <span class="navbar-toggler-icon"></span>
             </button>

             <!-- Navbar links -->
             <div class="collapse navbar-collapse" id="collapsibleNavbar">
                 <a class="navbar-brand" href=""><img src="{{URL::asset('/img/icon.gif')}}" width="40" height="40"> گروه
                     <span> هیراد کویر </span></a>
                 <ul class="navbar-nav ml-auto">


                 </ul>
                 <form class="form-inline my-2 my-md-0">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text"><i class="custom-search fa fa-search"></i></span>
                         </div>
                         <input type="text" class="custom-form-control" id="username" placeholder="نام کالا یا برند">

                     </div>
                 </form>
                 <div  class=user-register>
                     @if(Auth::check())
                     <li> <a class=" show-drop" href="#">
                             {{ Auth::user()->username }}
                         </a>
                     </li>
                         <div class="user_drop">
                             <a href="{{url('user')}}">  <p><i class="fa fa-user"></i>پروفایل</p></a>
                             <a href="{{url('user/orders')}}">   <p><i class="fa fa-shopping-cart"></i>سفارشات من </p></a>
                             <a href="{{url('logout')}}">  <p><i class="fa fa-sign-out"></i>خروج از سایت </p></a>
                         </div>
                     @else

                     <li><a href="{{ url('login') }}">ورود / ثبت‌
                             نام</a></li>
                     @endif


                 </div>
                 <div class="cart-shop">
                     <li>
                         <a href="{{ url('Cart') }}">
                             <div class="btn-shopping-cart">
                                 <div class="shopping-cart-icon"><span class="fa fa-shopping-cart"></span></div>
                                 <div class="shopping-cart-text">
                                     <span style="float:right">سبد خرید</span>
                                     <span class="number-product-cart">{{ \App\Cart::count() }}</span>
                                 </div>
                             </div>
                         </a>
                     </li>
                 </div>
             </div>
         </div>
     </div>
 </nav>
  <div class="container-fluid menu">

      <div class="container">
          <div class="row">
              <ul class="list-inline" id="product_cat">
                  @foreach($category as $key=>$value)

                  <li    id="product_cat_li_<?= $value->id ?>">
                      <a href="{{ url('category').'/'.$value['cat_ename'] }}"><span>{{ $value['cat_name'] }}</span></a>
                      <span id="product_cat_span_<?= $value->id ?>" class="fa fa-chevron-down"></span>
                      <ul class="list-inline sub_menu1">
                          @foreach($value->getChild as $key2=>$value2)
                          <li>
                              <a href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename }}">
                                  {{ $value2->cat_name }}
                              </a>

                              <div class="menu_box">


                                  <?php
                                            $t=0;
                                            $d=1;
                                            ?>

                                  @foreach($value2->getChild as $key3=>$value3)

                                  <?php
    
                                                   $menu4=$value3->getChild2;
                                                ?>
                                  @if((11-$t)<sizeof($menu4) && $t>0)

                                      <?php
                                                        $t=0;
                                                        $d++;
    
                                                       ?>
                              </div>
                              @endif
                              @if($t==0)
                              <div class="menu_box_div_{{ $d }}">
                                  @endif
                                  <?php $t++; ?>


                                  <ul class="li_menu">
                                      <li>
                                          <a style="color:#16C1F3"
                                              href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename }}">
                                              {{ $value3->cat_name }}
                                          </a>
                                      </li>
                                      <?php
                                                        $j=0;
    
                                                        ?>
                                      @foreach($menu4 as $key4=>$value4)
                                      <?php $t++; ?>
                                      @if($j<11) <?php
                                                                  $url=url('/');
                                                                  $e=explode('_',$value4->cat_ename);
                                                                  if(sizeof($e)==3)
                                                                  {
                                                                     if($e[0]=='filter')
                                                                     {
                                                                        $url.='/search/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename.'?'.$e[1].'[0]='.$e[2];
                                                                     }
                                                                     else
                                                                     {
                                                                       $url.='/category/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename.'/'.$value4->cat_ename;
                                                                     }
                                                                  }
                                                                  else
                                                                  {
                                                                      $url.='/category/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename.'/'.$value4->cat_ename;
                                                                  }
                                                                 ?> <li><a
                                              href="{{ $url }}">{{ $value4->cat_name }}</a>
                          </li>

                          @else

                          @if(sizeof($menu4)>11)

                          <li><a href="{{ url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename.'/'.$value3->cat_ename }}"
                                  style="color:#16C1F3">مشاهده موارد بیشتر</a></li>
                          @endif

                          @endif

                          <?php $j++ ?>

                          @endforeach

                      </ul>


                      <?php
                                                        if($t>12)
                                                        {
                                                            $t=0;
                                                            $d++;
                                                          ?>
          </div><?php
                                                        }
    
                                                     ?>

          @endforeach



          @if(!empty($value2->img))

          <div class="cat_img" style="background:url('{{ url('upload').'/'.$value2->img }}')"></div>
          @endif

      </div>
      </li>
      @endforeach
      </ul>
      </li>
      @endforeach
      </ul>
  </div>
  </div>

  </div>
