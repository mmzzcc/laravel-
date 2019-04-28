     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="/">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="goodslist">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="cart">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('index/js/style.js')}}"></script>
    <!--焦点轮换-->
    <script src="{{asset('index/js/jquery.excoloSlider.js')}}"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>