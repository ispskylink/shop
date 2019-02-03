
    function CreateCookie(name, value, options={}){
    //    let date =new Date(new Date().getTime()+60*1000*30);
    //    document.cookie =uname+'='+id+';path=/;expires='+date.toUTCString();
      var  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += ";" + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
 // alert(updatedCookie);
    }
    function eraseCookie(name, flag=false){
   if (!flag){
        //  let theCookies = document.cookie.split(';'); 
        // // alert(theCookies[0]);
        // for(let i=1; i<=theCookies.length; i++){
           
            
        //     if (theCookies[i-1].indexOf(name)==1){
        //         let theCookie = theCookies[i-1].split('=');
        //        alert(theCookie[0]);
        //         let date =new Date(new Date().getTime()-60000);
        //         document.cookie = theCookie[0]+'='+'id'+';path=/;expires='+date.toUTCString();
        //     }
        // }
        CreateCookie(name, "", {
            expires: -600
          });
   }else{
    let theCookies = document.cookie.split(';');
  

    for(let i=0; i<=theCookies.length; i++){
        
        if (theCookies[i].replace(/\s+/, "").startsWith(name)){
            let theCookie = theCookies[i].split('=');
           
            CreateCookie(theCookie[0], "", {
                expires: -600
              });
        }
       
    } 
   }
      
        
    }
    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
          "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
      }