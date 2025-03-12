@extends('layout')
@section('title')
    Giỏ Hàng
@endsection
@section('body')

      <!-- Shopping Cart -->
      <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Price</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                <!-- Cart Single List list -->
                <div ng-repeat="sp in cart" class="cart-single-list">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="product-details.html"><img src="{{asset('/')}}images/products/@{{sp.img}}" alt="#"></a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name"><a href="">
                                @{{sp.name}}</a>
                            </h5>
                            
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input min="1" max="@{{sp.instock}}" type="number" ng-model="sp.quantity" ng-change="updateQuantity(sp.id, sp.quantity)">
                            </div>
                        </div>
                        <div  class="col-lg-2 col-md-2 col-12">
                            <p ng-show="sp.sale_price!=null">@{{sp.sale_price | number}}đ <br>
                                <del>@{{sp.price|number}}</del>
                            </p>
                            <p ng-show="sp.sale_price==null">@{{sp.price|number}}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p ng-show="sp.sale_price!=null">@{{sp.sale_price*sp.quantity | number}}đ</p>
                            <p ng-show="sp.sale_price==null">@{{sp.price*sp.quantity | number}}đ</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a ng-click="deleteFromCart($index)" class="remove-item" href="javascript:void(0)"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>

                </div>
                <!-- End Single List list -->
               
            </div>
            <form action="" method="post" class="row">
                @csrf
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-12">
                            <div class="right checkout-steps-form-style-1">
                                <h6>Thông tin giao hàng</h6>
                                <section class="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Full Name</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="Full name" required name="fullname" value="{{(Auth::check())?Auth::user()->name:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Phone</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="Phone" required name="phone" 
                                                    value="{{(Auth::check())?Auth::user()->phone:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Email Address</label>
                                                <div class="form-input form">
                                                    <input type="email" placeholder="Email Address" required name="email" 
                                                    value="{{(Auth::check())?Auth::user()->email:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>Address</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="Address" required name="address"
                                                    value="{{(Auth::check())?Auth::user()->address:''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <input type="checkbox" id="agree" name="agree" required>
                                            <label for="agree">
                                                <p>Tôi đã đọc và đồng ý tất cả các điều khoản của shop</p>
                                            </label>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="right">
                                <ul>
                                    <li>Cart Subtotal<span >@{{}}</span></li>
                                    <li>Shipping<span>Free</span></li>
                                    <li>You Save<span>$29.00</span></li>
                                    <li class="last">You Pay<span>$2531.00</span></li>
                                </ul>
                                <div class="button">
                                    <button type="submit" class="btn">Checkout</button>
                                    <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </form>
            
        </div>
    </div>
    <!--/ End Shopping Cart -->

@endsection
@section('viewFunction')
    <script>
        viewFunction = function($scope, $http){
            $scope.updateQuantity = function(id, quantity){
                $http.patch('/api/cart/'+id,{
                    quantity: quantity
                }).then(
                    function(res){
                        // $scope.$parent.cart = res.data.data;
                    }
                )
            }
        }
    </script>
@endsection