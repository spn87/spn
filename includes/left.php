<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 * copyright All right reserved
 * Oct 24, 2010
 */

?>
		<h3>Reservation:</h3>
        <form id="reservation-form" action="#">
            <fieldset>
            <div style="margin-bottom:5px;"><label>Check In:</label>
            <input id="chkin" class="chk" style="width:100px" value="<?php echo date('Y-m-d'); ?>" />
            </div>
            <div style="margin-bottom:5px;"><label>Check Out:</label>
            <input class="chk" id="chkout" style="width:100px" value="<?php echo date('Y-m-d'); ?>" />
            </div>
            <div style="margin-bottom:15px;"><label>Person(s):</label> &nbsp;<input value="1" type="text" id="person"/></div>
            <div style="color:red; text-align:center;" class="noAvail">Not available</div>
            <div class="button bBookingStatus">
            	<span>
            		<span><a id="btnBooking" href="javascript:void(0);">Book now</a></span>
            	</span>
            </div>
            <div class="button">
            	<span>
            		
            		<span><a id="chkAvail" href="javascript:void(0);">Check Availability</a></span>
            	</span>
            </div>
            </fieldset>
        </form>
        <script>
        var sdate = "";
        var edate = "";
        var p = 1;
        $(function(){
        		$("#chkin, #chkout").datepicker({"dateFormat":"yy-mm-dd"});
        		$(".noAvail").hide();
				$(".bBookingStatus").hide();
        		$("#chkAvail").click(function(){
        			sdate = $("#chkin").val();
        			edate = $("#chkout").val();
        			p = $("#person").val();
        			$.ajax(
        			{
        				"url":"?a=chka",
        				data:{"sdate":sdate,"edate":edate,"p":p},
        				success: function(d)
						{
							
							if (!isNaN(d))
							{
								if (d ==1)
								{
									$(".bBookingStatus").show();
									$(".noAvail").hide();
								} else
								{
									$(".bBookingStatus").hide();
									$(".noAvail").show();
								}
							} else
							{
								$(".bBookingStatus").hide();
								$(".noAvail").show();
							}
						}
						
        			}
        			);
        		});
        		
        	});
        </script>