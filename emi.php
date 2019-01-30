<!DOCTYPE html>
<html>
<head>
	<title>Emi Calculator</title>
	<script type="text/javascript">
				/*E = P * r (1+r)^n / ((1+r)^n - 1) 
				where E = Emi
 	 				  P = Principal Amount
 	 	 			  r = rate of interest per month (r/12/100)
 	  				  n=  no of months	 */
					  
		function calEMI()
		{
			
			var p   		= 0; // Principal Amount
			var r   		= 0; // Rate of Interest per month
			var r1  		= 0; // Rate of Interest per month (Extra variable)
			var n   		= 0; // no of months
			var E   		= 0; // Emi Per Month
			var totPayment = 0; // Total Payment (Principal + Interest)
			var totInt     = 0; // Total Interest Payable
			
			p = document.getElementById('loan_amount').value;
			r1 =  document.getElementById('interest_rate').value;
			n =  document.getElementById('loan_tenure').value;
			r = (r1/1200);
			E = p * r * Math.pow((1+r),n) / (Math.pow((1+r),n)- 1);
			totPayment = E * n;
			totInt	= totPayment - p;
			
			final_E = Math.round(E);
			final_E = Number(final_E).toLocaleString('en-IN');

			final_totInt = Math.round(totInt);
			final_totInt = Number(final_totInt).toLocaleString('en-IN');

			final_totPayment = Math.round(totPayment);
			final_totPayment = Number(final_totPayment).toLocaleString('en-IN');

			document.getElementById('perMonthEmi').innerHTML   = 'EMI Per Month:' + final_E;
			document.getElementById('totalInterest').innerHTML = 'Total Interest Payable:' + final_totInt;
			document.getElementById('totalPayment').innerHTML  = 'Total Payment:' + final_totPayment;
		}
	</script>
</head>
<body>


<form enctype="multipart/form-data" method="POST" class='form-horizontal form-wizard wizard-vertical' id="ssss">
<input type="text" name="loan_amount" id="loan_amount" placeholder="Loan Amount" value="" />

<input type="text" name="interest_rate" id="interest_rate" placeholder="Rate of Interest" value="" />

<input type="text" name="loan_tenure" id="loan_tenure" placeholder="no of months" value="" />
<input type="button" onClick="calEMI();" value ="Cal" />
</form>

<p id="perMonthEmi"></p>
<p id="totalInterest"></p>
<p id="totalPayment"></p>

<p style="text-transform:capitalize;">total income interest</p>




</body>
</html>