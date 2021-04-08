
@if(!empty($reports) && count($reports) > 0)
   <div class="left-right actve-drop-sec"> 
        <span class="span-main right-menu">
            Sort by: 
            <select class="form-group sortingSelect" name="sorting_on" onchange="applySorting();">
                <option 
                value="created_at"
                {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'created_at') ? 'selected="selected"' : '' }}
                >Newest</option>
                <option 
                value="oldest"
                {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'oldest') ? 'selected="selected"' : '' }}
                >Oldest</option>
            </select>
        </span>
    </div>
@endif

    <div class="inner-table-box">
            <div class="table-responsive">
            @if(!empty($reports) && count($reports) > 0)
            <table class="table report-main-table table-striped timesheettable">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">ID</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($reports as $key=>$report)
                    <tr> 
                        <td> 
                          {{  dateFormat($report->created_at) }}
                        </td>
                        <td>Payment</td>
                        <td>
                            @if($report->contract_type == '2')
                              {{  getMilestoneNames($report->earning_for) }}
                            @else
                              {{  getTimesheetNames($report->earning_for) }}
                            @endif
                        </td>
                        <td class="amount">
                        {{ !empty($settings->currency)  ? $settings->currency  : '$'}}{{ amountFormat($report->amount)}}
                        </td>
                        <td>{{ $report->charge_id }}</td>
                    </tr>
                @empty
                @endforelse
                </tbody> 
            </table>
                <!-- showing record  -->
                <!-- Showing {{($reports->currentPage()-1)* $reports->perPage()+($reports->total() ? 1:0)}} to {{($reports->currentPage()-1)*$reports->perPage()+count($reports)}}  of  {{$reports->total()}}  Results -->
            
                <!-- pagination buttons -->
                <div id="listing-pagination" > {!! $reports->onEachSide(0)->render() !!}</div>
            
            @else
                <div class="inner-table-box">
                    <div class="pt-30 text-center">
                        <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
                        <p class="no-work-yet"> 
                            No Reports yet.
                        </p>
                    </div>
                </div>
            @endif
    </div>	
</div>
<script>
    function applySorting(){
        var sorting_on = $('select[name="sorting_on"]').val();
        jobareaajax_path2 = jobareaajax_path+'?sortby='+sorting_on;
        console.log(jobareaajax_path2);
        job_areaGet(jobareaajax_path2, currentPage);
    }
</script>