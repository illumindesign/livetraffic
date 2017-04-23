/* Live Traffic Meter
   (c) 2011-2017 Illumin Design, Co.
   
   Written by: Bobby Ratliff
*/

var time_onpage = 0;
var XMLHttpRequestObject = false;
var resolution = screen.width+"x"+screen.height;
var available = screen.availWidth+"x"+screen.availHeight;

function getFlashVersion(){
  // ie
  try {
    try {
      // avoid fp6 minor version lookup issues
      // see: http://blog.deconcept.com/2006/01/11/getvariable-setvariable-crash-internet-explorer-flash-6/
      var axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.6');
      try { axo.AllowScriptAccess = 'always'; }
      catch(e) { return '6,0,0'; }
    } catch(e) {}
    return new ActiveXObject('ShockwaveFlash.ShockwaveFlash').GetVariable('$version').replace(/\D+/g, ',').match(/^,?(.+),?$/)[1];
  // other browsers
  } catch(e) {
    try {
      if(navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin){
        return (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]).description.replace(/\D+/g, ",").match(/^,?(.+),?$/)[1];
      }
    } catch(e) {}
  }
  return '0,0,0';
}
var flv = getFlashVersion().split(',').shift();

try {
  XMLHttpRequestObject = new ActiveXObject("MSXML2.XMLHTTP");
} catch (exception1) {
  try {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (exception2) {
    XMLHttpRequestObject = false;
  }
}

if (!XMLHttpRequestObject && window.XMLHttpRequest) {
  XMLHttpRequestObject = new XMLHttpRequest(); 
}

function send_stats ()
{
  var url = "livetraffic.php";
  
  if(XMLHttpRequestObject) {
    XMLHttpRequestObject.open("POST", url);
    XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    XMLHttpRequestObject.onreadystatechange = function()
    {
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        //alert(XMLHttpRequestObject.responseText);
        if (XMLHttpRequestObject.responseText == "continue") {
          if (time_onpage == 0) {time_onpage=1;}
          setTimeout("send_stats()", 2000);
          //alert(XMLHttpRequestObject.responseText);
        } else {
          setTimeout("send_stats()", 2000);
          //alert(XMLHttpRequestObject.responseText);
        }
      }
    }
    XMLHttpRequestObject.send("site="+c_site+"&page="+c_page+"&resolution="+resolution+"&available="+available+"&flv="+flv+"&time="+time_onpage);
  }
}

function counter_count ()
{
  time_onpage++;
  setTimeout("counter_count()", 1000);
}

send_stats();
counter_count();
