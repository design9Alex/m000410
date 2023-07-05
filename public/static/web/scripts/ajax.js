let _url = window.location.pathname;
//let filename = url.substring(url.lastIndexOf('/')+1);

let filename = _url.split('/')[2];
if(document.documentElement.lang == 'en') {
  filename = _url.split('/')[1];
}
//console.log(document.documentElement.lang);
//console.log(filename);

switch(filename){
  case 'news': document.write('<scr' + 'ipt type="text/javascript" src="/static/web/scripts/page/news.js"></scr' + 'ipt>'); break;
  case 'products': document.write('<scr' + 'ipt type="text/javascript" src="/static/web/scripts/page/products.js"></scr' + 'ipt>'); break;
  case 'financial-1': document.write('<scr' + 'ipt type="text/javascript" src="/static/web/scripts/page/financial-1.js"></scr' + 'ipt>'); break;
  case 'financial-2': document.write('<scr' + 'ipt type="text/javascript" src="/static/web/scripts/page/financial-2.js"></scr' + 'ipt>'); break;
  case 'career-1': document.write('<scr' + 'ipt type="text/javascript" src="/static/web/scripts/page/career-1.js"></scr' + 'ipt>'); break;
  case 'career-4': document.write('<scr' + 'ipt type="text/javascript" src="/static/web/scripts/page/career-4.js"></scr' + 'ipt>'); break;
  case 'contact': document.write('<scr' + 'ipt type="text/javascript" src="/static/web/scripts/page/contact.js"></scr' + 'ipt>'); break;

}

//Line分享
$("body").delegate('.share-line', 'click', function () {
  var pageTitle = encodeURIComponent(document.title);
  var thisURL = ' '+location.href;
  window.open('https://line.naver.jp/R/msg/text/?'.concat(pageTitle).concat(thisURL), 'pop', config = 'height=500,width=500');
});

//FB分享
$("body").delegate('.share-facebook', 'click', function () {
  var thisURL = encodeURIComponent(location.href);
  window.open('https://www.facebook.com/share.php?u='.concat(thisURL), 'pop', config = 'height=500,width=500');
});

//Google+
$("body").delegate('.share-google-plus', 'click', function () {
  var thisURL = encodeURIComponent(location.href);
  window.open('https://plus.google.com/share?url='.concat(thisURL), 'pop', config = 'height=500,width=500');
});

//twitter分享
$("body").delegate('.share-twitter', 'click', function () {
  var pageTitle = encodeURIComponent(document.title);
  var thisURL = encodeURIComponent(location.href);
  window.open('https://twitter.com/home?status='+pageTitle + "+".concat(thisURL),'pop', config='height=500,width=500');
});

//weibo分享
$("body").delegate('.share-weibo', 'click', function () {
  var pageTitle = encodeURIComponent(document.title);
  var thisURL = encodeURIComponent(location.href);
  window.open('http://service.weibo.com/share/share.php?url='.concat(thisURL),'pop', config='height=500,width=500');
});

//linkedin
$("body").delegate('.share-linkedin', 'click', function () {
  var pageTitle = encodeURIComponent(document.title);
  var thisURL = encodeURIComponent(location.href);
  window.open('https://www.linkedin.com/sharing/share-offsite/?url='.concat(thisURL),'pop', config='height=500,width=500');
});

$("body").delegate('.copy-link', 'click', function () {
  const value = $(this).attr('data-uri');
  const el = document.createElement('textarea');
  el.value = value;
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
});


$("body").delegate('.recordTrack', 'click', function () {
  let _table = $(this).attr('data-table');
  let _id = $(this).attr('data-id');

  $.ajax({
    url: '/saveTrack',
    type: "POST",
    cache:false,
    dataType: 'json',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {
      'id': _id,
      'table': _table,
    },

    // success
    success: function(json) {
    },
    error: function(json) {
    }
  });
});




function loadScript(url, callback, callbackError) {
  var script = document.createElement("script");
  script.type = "text/javascript";

  try {
    if (script.readyState) {  //IE
      script.onreadystatechange = function () {
        if (script.readyState === "loaded" || script.readyState === "complete") {
          script.onreadystatechange = null;
          callback();
        }
      };
    } else {
      //其餘瀏覽器支援onload
      script.onload = function () {
        //callback();
      };
    }


    script.src = url;

    document.getElementsByTagName("body")[0].appendChild(script);
  } catch (e) {
    if (null !== callbackError) callbackError(e);
  }
}
