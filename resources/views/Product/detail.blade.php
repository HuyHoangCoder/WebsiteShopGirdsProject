@extends('layout')
@section('title')
    {{$sp->name}}
@endsection
@section('body')

     <!-- Start Item Details -->
     <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <div id="product-images" class="carousel slide">
                                <div class="carousel-inner">
                                  <div class="carousel-item active">
                                    <img src="{{asset('/')}}images/products/{{$sp->img}}" class="d-block w-100" alt="...">
                                  </div>
                                  @foreach ($sp->images as $item)
                                  <div class="carousel-item">
                                    <img src="{{asset('/')}}images/products/{{$item->img}}" class="d-block w-100" alt="...">
                                  </div>
                                  @endforeach
                                  
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#product-images" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#product-images" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                            <main id="gallery">
                                <div class="images">
                                    <img data-bs-target="#product-images" data-bs-slide-to="0"   src="{{asset('/')}}images/products/{{$sp->img}}" class="img" alt="#">
                                    @php
                                        $i=1   
                                    @endphp
                                    @foreach ($sp->images as $item)
                                    <img data-bs-target="#product-images" data-bs-slide-to="{{$i++}}" src="{{asset('/')}}images/products/{{$item->img}}" class="img" alt="">
                                    @endforeach
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{$sp->name}}</h2>
                            <p class="category"><i class="fa-solid fa-tag"></i> Category:
                                <a href="javascript:void(0)">
                                    {{$sp->category->name}}
                                </a>
                            </p>
                            <h3 class="price">
                                @if (isset($sp->sale_price))
                                    {{number_format($sp->sale_price)}}đ
                                    <span>{{number_format($sp->price)}}đ</span>
                                @else
                                    {{number_format($sp->price)}}đ
                                @endif
                            </h3>
                            <div class="row align-items-end">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group quantity">
                                        <label for="color">Quantity</label>
                                        <input type="number" class="form-control form-control-lg"
                                         value="1" min="1" max="{{$sp->instock}}" ng-model="quantity">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12">
                                    <div class="button cart-button">
                                        <button ng-click="addToCart({{$sp->id}}, quantity)" class="btn" style="width: 100%;">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block">
                    <h4>Details</h4>
                    {{$sp->description}}
                </div>
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="single-block give-review">
                            <h4>{{number_format($sp->rating, 1)}} (Overall)</h4>
                            <ul>
                                <li>
                                    <span>5 stars - 38</span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                  
                                </li>
                                <li>
                                    <span>4 stars - 10</span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                  
                                    <i class="fa-regular fa-star"></i>

                                </li>
                                <li>
                                    <span>3 stars - 3</span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </li>
                                <li>
                                    <span>2 stars - 1</span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </li>
                                <li>
                                    <span>1 star - 0</span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </li>
                            </ul>
                            <!-- Button trigger modal -->
                            @auth    
                            <button type="button" class="btn review-btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Leave a Review
                            </button>
                            @endauth

                            @guest
                                <div class="alert alert-warning">
                                    Bạn cần <a href="{{route('login')}}">đăng nhập</a> để đánh giá 
                                </div>
                            @endguest
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="single-block">
                            <div class="reviews">
                                <h4 class="title">Latest Reviews</h4>
                                <!-- Start Single Review -->
                                <div ng-repeat="bl in dsBL" class="single-review">
                                    <img src="assets/images/blog/comment1.jpg" alt="#">
                                    <div class="review-info">
                                        <h4>@{{bl.user_fullname}}
                                            <span>@{{bl.create_at | date:'dd/MM/yyyy HH:mm'}}
                                            </span>
                                        </h4>
                                        <ul class="stars">
                                            
                                            <li ng-show="bl.rating>=1"><i class="lni lni-star-filled"></i></li>
                                            <li ng-show="bl.rating>=2"><i class="lni lni-star-filled"></i></li>
                                            <li ng-show="bl.rating>=3"><i class="lni lni-star-filled"></i></li>
                                            <li ng-show="bl.rating>=4"><i class="lni lni-star-filled"></i></li>
                                            <li ng-show="bl.rating==5"><i class="lni lni-star-filled"></i></li>
                                         
                                            <li ng-show="bl.rating<5"><i class="lni lni-star"></i></li>
                                            <li ng-show="bl.rating<4"><i class="lni lni-star"></i></li>
                                            <li ng-show="bl.rating<3"><i class="lni lni-star"></i></li>
                                            <li ng-show="bl.rating<2"><i class="lni lni-star"></i></li>
                                            <li ng-show="bl.rating<1"><i class="lni lni-star"></i></li>
                                            
                                        </ul>
                                        <p>@{{bl.content}}</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Item Details -->

    <!-- Review Modal -->
    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="review-rating">Rating</label>
                                <select ng-model="rating" class="form-control" id="review-rating">
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review-message">Review</label>
                        <textarea class="form-control" id="review-message" ng-model="content" rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer button">
                    <button type="button" class="btn" ng-click="sendComment()">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Review Modal -->

@endsection

@section('viewFunction')
<script>
   viewFunction = function($scope, $http) {
    $scope.quantity = 1;
    $scope.dsBL = [];
    
    $scope.getComment = function() {
        $http.get('/api/comments/product/{{$sp->id}}').then(
            function(res) { // success
                if (res.data.status) {
                    $scope.dsBL = res.data.data;
                    console.log("Comments loaded successfully", $scope.dsBL);
                } else {
                    console.log("Error loading comments", res.data.message);
                }
            },
            function(res) { // error
                console.error("Error in API call", res);
            }
        );
    }
    
    $scope.getComment();
    
    $scope.sendComment = function() {
        $http.post('/api/comments', {
            'product_id': {{$sp->id}},
            'content': $scope.content,
            'rating': $scope.rating,
        }).then(
            function(res) {
                document.querySelector('.btn-close').click();
                $scope.content = '';
                $scope.rating = 5;
                $scope.getComment();
            },
            function(res) { // error
                console.error("Error in sending comment", res);
            }
        );
    }
}

</script>
@endsection