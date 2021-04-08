<h1 class="timesheet">
	@if(Auth::user()->user_type == '2') 
       Payments
    @else
       Earnings
    @endif
</h1>

  @if($payments->total() == 0 )  
   <img class="no-ta" src="../assets/img/no-trans.png"> 
   <p class="no-work-yet"> 
          @if(Auth::user()->user_type == '2') 
             No payments yet!
          @else
            No transactions yet!
          @endif
   </p>
  @else
   <div class="table-responsive job-list-4">
		<table class="table report-main-table table-striped">
		   <thead> 
		      <tr>
		         <th scope="col">Status</th>
		         <th scope="col">Payed For</th>
		         <th scope="col">Date</th>
		         <th scope="col">Amount</th>
		      </tr>
		   </thead>
		   <tbody>
		    @if($payments->total() >= 1 )
              @foreach($payments as $row)
				<tr>
					<td class="status paid">
					  {{ ($row->status == 2) ? 'Paid' : 'Pending' }}
					</td>
					<td>
					@if($contract->contract_type == '2')
					  {{  getMilestoneNames($row->earning_for) }}
					@else
					 {{  getTimesheetNames($row->earning_for) }}
					@endif
					</td>
					<td>
					 {{  dateFormat($row->created_at) }}
					</td>
					<td>
					  {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($row->amount)}}
					</td>
				</tr>
			  @endforeach
            @endif
		   </tbody> 
		   <tfoot>
		      <tr>
		         <td colspan="3" style="text-align:right;">In Total:</td>
		         <td><b>
				 {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($payments_sum)}}
				 </b></td>
		      </tr>									   
		   </tfoot>

		   
		</table>
</div>
   @endif