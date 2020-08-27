@extends('admin.layouts.master')

@section('title')
<title>All Orders</title>
@endsection


@section('content')

<div class="row mt-2">
	<div class="col-12 col-lg-6">
		<div class="card p-3 rounded-0">

			<div class="row">
				<div class="col-12 text-center">
					<h2 class="font-pt font-25">Orders</h2>
				</div>
			</div>
			<hr class="mb-3">
			<div class="row">
				<div class="col-11">

					<span class="">
						<input  id="order-from" class="font-pt" type="date" style="background: none; color: #333; border:1px solid #333; border-radius: 0px;">
					</span>

					<span class="">
						<input  id="order-to" class="font-pt" type="date" style="background: none; color: #333; border:1px solid #333; border-radius: 0px;">
					</span>

					<span class="">
						<select name="type" id="type" style="background: none; color: #333; border:1px solid #333; border-radius: 0px; width: 100px; height: 37px;text-align: center; margin-top: -2px;">
							<option value="from-to">From -> To</option>
							<option value="today">Today</option>
							<option value="yesterday">Yesterday</option>
							<option value="this-week">This Week</option>
							<option value="last-week">Last Week</option>
							<option value="this-month">This Month</option>
							<option value="last-month">Last Month</option>
							<option value="this-year">This Year</option>
							<option value="last-year">Last Year</option>
						</select>
					</span>

					<span>
						<button id="order-find" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Find" >
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>
					</span>
				</div>
				<div class="col-1 text-right">
					<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
				</div>
			</div>
			<hr class="mb-3">

			<div class="row">
				<div class="col-12 col-lg-4">

					<div class="card bg-info text-white p-3">
						<h3 class="text-white font-pt font-25">Total Orders</h3>
						<span id="show_total_order" class="number text-center font-30">0</span>
					</div>

				</div>
				<div class="col-12 col-lg-4">
					<div class="card bg-success text-white p-3">
						<h3 class="text-white font-pt font-25">Confirm Orders</h3>
						<span id="show_total_confirm_order" class="number text-center font-30">0</span>
					</div>
				</div>				

				<div class="col-12 col-lg-4">
					<div class="card bg-warning text-dark p-3">
						<h3 class="text-dark font-pt font-25">Confirm Orders</h3>
						<span id="show_total_pending_order" class="number text-center font-30">0</span>
					</div>
				</div>



			</div>
			<hr class="mb-3">

			<div class="row" style="max-height: 500px; overflow-y: scroll;">
				<div class="col-12">
					<table class="table table-striped table-dark display " >
						<thead>
							<tr align="center">
								<th scope="col">No</th>
								<th scope="col">Id</th>
								<th scope="col">Date</th>
								<th scope="col">Status</th>
								<th scope="col">Payment</th>
							</tr>
						</thead>
						<tbody id="order_table_data">
							@php 
							$i= 0;
							$total_confirm = 0;
							$pending = 0;
							@endphp
							@foreach($orders as $order)
							@php 
							$i++;

							if($order->status == 'confirm'){
								$total_confirm++;
							}else{
								$pending++;
							}
							@endphp
							<tr align="center">
								<th class="font-pt font-18" >{{$i}}</th>
								<td class="font-pt font-18">

									<a target="_blank" data-toggle="tooltip" data-placement="top" title="View" class="text-white" href="{{route('admin.order.show', ['id' => $order->id])}}">
										{{$order->order_code}}
									</a>


								</td>
								<td class="font-pt font-18">{{$order->created_at->format('Y-m-d')}}</td>
								<td class="font-pt font-18">{{$order->status}}</td>

								<td class="font-pt font-18">{{$order->payment}}</td>

							</tr>
							@endforeach
						</tbody>

						<input type="hidden" id="total_order" value="{{$i}}">
						<input type="hidden" id="total_confirm_order" value="{{$total_confirm}}">
						<input type="hidden" id="total_pending_order" value="{{$pending}}">


					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- website info area end -->

@endsection





@section('footer-section')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>

	var orders;

	$(document).ready(function(){



		var total_order = $("#total_order").val();
		var total_confirm_order = $("#total_confirm_order").val();
		var total_pending_order = $("#total_pending_order").val();

		$("#show_total_order").html(total_order);
		$("#show_total_confirm_order").html(total_confirm_order);
		$("#show_total_pending_order").html(total_pending_order);





		$("#type").change(function(){
			var type = $(this).val();

			if(type == 'from-to'){
				$("#order-from").removeAttr('disabled');
				$("#order-to").removeAttr('disabled');

			}else{
				$("#order-from").attr('disabled',true);
				$("#order-to").attr('disabled',true);
			}

		})



		$("#order-find").click(function(){


			var type = $("#type").val();



			if(type == 'from-to'){
				var order_from = $("#order-from").val();
				var order_to = $("#order-to").val();
			}else{
				var order_from = '----';
				var order_to = '----';
			}

			var time ={
				from:order_from,
				to:order_to,
				type:type
			};



			if(order_from == '' && type == 'from-to'){
				$("#order-from").focus();
				return false;
			}else if(order_to == '' && type == 'from-to'){
				$("#order-to").focus();
				return false;
			}else{
  			// fetch all orders
  			$.ajax({
  				type:'POST',
  				url:'/admin/reports/order/by/date',
  				data:time,
  				success:function(data){

  					console.log(data);
  					orders = data.orders;
  					$("#order_table_data").html("");
  					makeOrderTable(orders);
  			  	  } // end success
  			  	});
  			// end
  		}
  		
  	})





  })// end jquery




	function makeOrderTable(orders){
		var table = $("#order_table_data");

		for(var i=0;i<orders.length;i++){
			var order = orders[i];



			var tr = `

			<tr align="center">
			<th class="font-pt font-18" >`+(i+1)+`</th>
			<td class="font-pt font-18">

			<a target="_blank" data-toggle="tooltip" data-placement="top" title="View" class="text-white" href="/admin/order/show/`+order.id+`">
			`+order.order_code+`
			</a>


			</td>
			<td class="font-pt font-18">`+order.created_at.split('T')[0]+`</td>
			<td class="font-pt font-18">`+order.status+`</td>

			<td class="font-pt font-18">`+order.payment+`</td>

			</tr>

			`;

			table.append(tr);


		}
	}




	function makeOrderReport(from,to){


		var search_split_year_month_date_from = from.split('-');
		var search_year_from = Number(search_split_year_month_date_from[0]);
		var search_month_from = Number(search_split_year_month_date_from[1]);
		var search_date_from  = Number(search_split_year_month_date_from[2]);

		var search_split_year_month_date_to = to.split('-');
		var search_year_to = Number(search_split_year_month_date_to[0]);
		var search_month_to = Number(search_split_year_month_date_to[1]);
		var search_date_to  = Number(search_split_year_month_date_to[2]);




		for(var i=0;i<orders.length;i++){
			var order = orders[i];
			var order_year_month_date  = order.created_at.split('T')[0];
			var order_split_year_month_date = order_year_month_date.split('-');

			var order_year = Number(order_split_year_month_date[0]);
			var order_month = Number(order_split_year_month_date[1]);
			var order_date  = Number(order_split_year_month_date[2]);


			if(order_year >= search_year_from && order_year <= search_year_to){

				if(order_month >= search_month_from && order_month <= search_month_to){

					console.log("milec: "+ order_year_month_date);
				}
			}else{
				console.log("mile nai: "+order_year_month_date);
			}





		}
	}
</script>
@endsection