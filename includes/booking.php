<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 *copyright All right reserved
 * Dec 10, 2010
 */


?>
<link rel="stylesheet" type="text/css" href="includes/css/custom-theme/jquery-ui-1.8.6.custom.css" />
<div class="indent" id="frmBooking" style="display:none;">
<form id="bkform" onsubmit="return false;" method="post" action="?a=subform">
<table>	
	<tbody><tr>
		<td colspan="4">
			<h3>Contact information</h3>
		</td>		
	</tr><tr>
		<td>First name:</td>
		<td><input type="text" class="req" name="first_name"></td>
	
		<td>Last name:</td>
		<td><input type="text" class="req" name="last_name"></td>
	</tr>
	<tr>
		<td>Country:</td>
		<td><input type="text" class="req" name="country"></td>
	
		<td>Email:</td>
		<td><input type="text" class="req" name="email"></td>
	</tr>
	<tr>
		<td>Phone:</td>
		<td><input type="text" class="req" name="phone"></td>
	
		<td>Room type:</td>
		<td>
			<select name="roomtype">
								<option value="Normal">Normal</option>
								<option value="Business class">Business class</option>
								<option value="Premium">Premium</option>
							</select>
		</td>
	</tr>
	<tr>
		<td>Your comment:</td>
		<td colspan="3">
			<textarea name="comment" cols="30" rows="5"></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2"><h3>Pick up information</h3></td>
	
		<td>Full name:</td>
		<td><input name="pfullname" id="pfullname" class=""/></td>
	</tr>
	<tr>
		<td>Departure From:</td>
		<td><input name="pdeparturefrom" id="pdeparturefrom" class=""/></td>
	
		<td>Flight number:</td>
		<td><input name="pflightnum" id="pflightnum" class=""/></td>
	</tr>
	<tr>
		<td>Departure time:</td>
		<td><input name="pdeparturetime" id="pdeparturetime" class="" /></td>
	
		<td>Bus company:</td>
		<td><input name="pbus" id="pbus" /></td>
	</tr>
	<tr>
		<td>Arrival time:</td>
		<td><input name="parrivaltime" id="parrivaltime" /></td>
	
		<td>Boat company:</td>
		<td><input name="pboat" id="pboat" /></td>
	</tr>
	<tr>
		<td colspan="2"><h3>Booking info</h3></td>
	
		<td>Check in:</td>
		<td><input value="2010-12-10" readonly="readonly" class="req" id="checkin_date" name="checkin_date"></td>
	</tr>
	<tr>
		<td>Check in:</td>
		<td><input value="2010-12-10" readonly="readonly" class="req" id="checkout_date" name="checkout_date"></td>
	
		<td>People num:</td>
		<td><input class="req" value="1" style="width: 20px;" name="pp_num"></td>
	</tr>
	<tr>
		<td>Code:</td>
		<td>
			<img align="bottom" title="Click on image to change" id="captcha" onclick="reloadImage(this);" src="?m=review&amp;a=getimage"> <a onclick="reloadImage(this);" href="javascript:void(0);">Reload code</a>
		</td>
	
		<td>
			Confirm code:
		</td>
		<td>
			<input type="text" id="code" name="code" class="req">
		</td>
	</tr>	
</tbody></table>
 </form>
<script>
	var err = "Plese fill in the highlight field with the valid information!";
	$(function(){	
		$("#checkin_date, #checkout_date").datepicker({"dateFormat":"yy-mm-dd"});
		/*$("#btnsub").click(function(){
			$("#frmBooking").find(".req").parent().parent().children("td").css("color","#BCA695");
			var isvalid = true;
			$("#frmBooking").find(".req").each(function(){
				if ($(this).val() == "")
				{
					$(this).parent().parent().children("td").css("color","red");
					isvalid = false;
				}
			});
			return;
			if (!isvalid)
			{
				alert(err);
				return;
			}
			var captchaValid = false;
			var c = $("#frmBooking").find("#code").val();
			$.ajax({async:false,url:"?m=review&amp;a=isvalidcaptcha&amp;",
				data: {"code":c},
				success:function(d)
				{
					if (parseInt(d) == 1) captchaValid = true;
				}
			});
			if (!captchaValid)
			{
				alert("Invalid input code");
				return;
			}
			$("#bkform").submit();
		}); 
		*/
	});
</script>
<script>
	 function reloadImage(obj)
	 {
		 var rnd = Math.random();
		 $("img[id=captcha]").attr("src","?m=review&a=getimage&rnd="+rnd);
	 }
	$(function(){
	 $("#frmBooking").dialog({"autoOpen":false,"width":"550px","modal":true,"title":"Booking",
			 buttons:{"Ok":function(){
		 $("#frmBooking .req").parent().parent().children("td").css("color","#BCA695");
			var isvalid = true;
			$("#frmBooking .req").each(function(){
				if ($(this).val() == "")
				{
					$(this).parent().parent().children("td").css("color","red");
					isvalid = false;
				}
			});
	
			if (!isvalid)
			{
				alert(err);
				return;
			}
			var captchaValid = false;
			$.ajax({async:false,url:"?m=review&a=isvalidcaptcha",
				data: {"code":$("#frmBooking #code").val()},
				success:function(d)
				{
					if (parseInt(d) == 1) captchaValid = true;
				}
			});
			if (!captchaValid)
			{
				alert("Invalid input code");
				return;
			}
			$("#bkform").submit();
			 }}
		 });
	 $(".btn_booking, #btnBooking").click(function(){		 
		 $("#frmBooking").dialog("open");
	 });

	 });
</script>
</div>