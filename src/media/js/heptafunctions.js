////////////////////////////////////////////////////
//            Get value from text input           //
////////////////////////////////////////////////////

function test(input)
{
	var Element = document.getElementById(input);

	alert(Element.value);

}

function IsNumeric(sText)

{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;


   for (i = 0; i < sText.length && IsNumber == true; i++)
      {
      Char = sText.charAt(i);
      if (ValidChars.indexOf(Char) == -1)
         {
         IsNumber = false;
         }
      }
   return IsNumber;

   }

function add_to_cart(input, iframe)
{
	var InputValue = document.getElementById(input).value;
	var UrlString;
	var Id = input.substr(4);

	if (IsNumeric(InputValue))
	{
		UrlString = '/o/basket.php?method=addItem&id='+Id+'&quantity='+InputValue;
		window.frames[iframe].location.href = UrlString;
		document.getElementById(input).value='';
		//document.getElementById(iframe).setAttribute('src', UrlString);
	} else
	{
		alert('Error: non-numeric input');
	}

}

function refresh_items(item1, item2)
{
		var URL = 'http://70.25.126.201/registration/paypal?tables='+item1+'&chairs='+item2;
		//alert(URL);
		document.location=URL;
		//window.location.href = URL;
		return false;
}