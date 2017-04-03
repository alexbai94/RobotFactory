<section id="main-content">
   <section class="wrapper">
      <div class="col-lg-9 main-chart">
         <div class = "container-fluid">
		 <form>
				<button type="submit" id="filter"  formaction="/History/dateSort">Sort by date</button>
				<button type="submit" id="filter"  formaction="/History/robotIDSort">Sort by robot ID</button>
		 </form>
            <table class="table" id="table_history">
			<!--
				<input type="checkbox" name="dateSort" value="dateSort" class="checkbox">Sort by date<br>
				<input type="checkbox" name="robotIDSort" value="robotIDSort" class="checkbox">Sort by robot ID<br><br>
			-->
			
               <tr>
                  <th>Transaction ID</th>
                  <th>Purchase Type</th>
                  <th>Robot ID</th>
                  <th>Parts ID</th>
                  <th>Shipment ID</th>
                  <th>Date</th>
					
               </tr>
               {history}
			  
               <tr>
				
                  <td>{transID}</td>
                  <td>{purchaseType}</td>
                  <td>{robotID}</td>
                  <td>{partsID}</td>
                  <td>{shipmentID}</td>
                  <td>{date}</td>
				
               </tr>
			   
               {/history}	
            </table>

         </div>
		 <?php echo $this->pagination->create_links(); ?>
      </div>
	  
	  <!--
	  <script>
			$(document).ready(function(){
				
				$('.checkbox').click(function() {
					
					console.log(69);
					
					if($('input[name="dateSort"]').is(':checked')) {
						var chkbox = $('input[name="dateSort"]:checked').val();
					}
					else if($('input[name="robotIDSort"]').is(':checked')) {
						var chkbox = $('input[name="robotIDSort"]:checked').val();
					}
					
					console.log(chkbox);
					
					$.ajax({
						
						type: 'POST',
						url: '<?php echo base_url();?>' + 'History/sorting',
						dataType:'text',
						data: {chkbox : chkbox},
						success: function(data) {
							console.log("reached success"+data);
						},
						error:function(){
                                    alert('ERROR: Server could not process your request');

                        }

					});
					
					
					
				});
				
			});
	  
	  
	  
	  </script>
	  -->
   </section>
</section>