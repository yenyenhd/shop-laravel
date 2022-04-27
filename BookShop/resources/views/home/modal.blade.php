<div class="modal fade" id="my_modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div id="beforesend_quickview"></div>
            <div class="modal-body shop">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="product-flags madal">  
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="imgeone" role="tabpanel" >
                                        <div class="product_tab_img">
                                            <a href="#"><span id="product_quickview_image"></span></a>    
                                        </div>
                                    </div>
                                </div>
                                <div class="products_tab_button  modals">    
                                    <ul class="nav product_navactive" role="tablist">
                                        <span id="product_quickview_gallery"></span>
                                    </ul>
                                </div>    
                            </div>  
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <form>
                                {{ csrf_field() }}
                            <div id="product_quickview_value"></div>
                            <div class="modal_right">
                                <div class="shop_reviews">
                                    <div class="demo_product product_quickview_title">
                                        <h2 id="product_quickview_title"></h2> 
                                    </div>
                                    <div class="current_price">
                                        <span class="regular" id="product_quickview_price"></span>    
                                        <span class="regular_price" id="product_price_current" ></span>    
                                    </div>
                                    <div class="product_information product_modal">
                                        <div id="product_modal_content">
                                            <p id="product_quickview_desc"></p>    
                                        </div>
                                        <div class="product_variants">
                                            <div class="quickview_plus_minus">
                                                <span class="control_label">Quantity</span>
                                                <div class="quickview_plus_minus_inner">
                                                    <div class="cart-plus-minus">
                                                        <input type="number" value="1" min="1" name="qtybutton" class="cart-plus-minus-box cart_product_qty_">
                                                    </div>
                                                    <div class="add_button add_modal" id="product_quickview_button"></div>
                                                    
                                                       
                                                </div>
                                            </div>    
                                        </div> 
                                            
                                        <div class="cart_description">
                                            <p id="product_quickview_content"></p>    
                                        </div>
                                            
                                    </div>
                                    
                                    <div id="beforesend_quickview"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-default redirect-cart">Đi tới giỏ hàng</button>
                                      </div>
                                </div>    
                            </div>   
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="social-share">
                                <h3>Share this product</h3>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>    
                            </div>    
                        </div>    
                    </div>     
                </div>
            </div>    
        </div>
    </div>
</div>


<div class="modal fade" id="quick-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Giỏ hàng của bạn</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="show_quick_cart_alert"></div>
            <div id="show_quick_cart"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>