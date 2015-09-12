@include('frontend.includes.head')

<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '481402502038511',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    @include('frontend.includes.topbar')

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    @include('frontend.includes.navbar')
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->



    @yield('content')
        <!-- /#content -->

        <!-- *** FOOTER ***
 _________________________________________________________ -->
@include('frontend.includes.footer')
 <script type='text/javascript'>
    window._sbzq||function(e){e._sbzq=[];
    var t=e._sbzq;t.push(["_setAccount",25683]);
    var n=e.location.protocol=="https:"?"https:":"http:";
    var r=document.createElement("script");
    r.type="text/javascript";r.async=true;
    r.src=n+"//static.subiz.com/public/js/loader.js";
    var i=document.getElementsByTagName("script")[0];
    i.parentNode.insertBefore(r,i)}(window);
 </script>

<script lang="javascript">
    // (function() {
    //     var _h1= document.getElementsByTagName('title')[0] || false;
    //     var product_name = ''; 
    //     if(_h1){
    //         product_name= _h1.textContent || _h1.innerText;
    //     }
    //     var ga = document.createElement('script'); 
    //     ga.type = 'text/javascript';
    //     ga.src = '//live.vnpgroup.net/js/web_client_box.php?hash=eddd662b66ff38f5233000c0410ff2d4&data=eyJoYXNoIjoiODU0MDU3OGMyMTliOTgwYjUxMDYyM2NhODJlZmI1NDIiLCJzc29faWQiOjI2MTU3NDR9&pname='+product_name;
    //     var s = document.getElementsByTagName('script');
    //     s[0].parentNode.insertBefore(ga, s[0]);
    // })();
</script>
 
</body>

</html>