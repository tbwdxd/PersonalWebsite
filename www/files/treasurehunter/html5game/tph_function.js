function reporscore(datawrite) {
	result = getphp("fileio.php?cmd=reportscore&datawrite=" + datawrite, 0);
	return result;
}

function getphp(url,async) {
   if (window.XMLHttpRequest) {
      xmlObject = new XMLHttpRequest();
   } else {
      xmlObject = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xmlObject.open("GET",url,async);
   xmlObject.send(null);
   return xmlObject.responseText;
}