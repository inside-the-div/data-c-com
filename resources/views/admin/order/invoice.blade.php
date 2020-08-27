@extends('admin.layouts.master')

@section('title')
<title>Order | {{$billing->first_name}} {{$billing->last_name}}</title>
@endsection


@section('custom-css')

	<style>
		h3{
			margin: 0px;
			padding: 0px;
			font-size: 20px;
		}
		table th{
			text-align: center;
		}

		.heder-area{
			width: 100%;
			float: left;
		}
		.bill-from-area{
			width: 70%;
			float: left;
		}
		.logo-area{
			width: 20%;
			float: right;
			text-align: right;
			
		}
		.bill-to-area{
			width: 50%;
			float: left;
		}
		.invoice-details-area{
			width: 50%;
			float: right;
			text-align: right;
		}

		@media print {


		  body *{
		    visibility: hidden;
			overflow: hidden;
		  }

		  #section-to-print, #section-to-print * {
		    visibility: visible;
		  }
		  #section-to-print {
		    position: absolute;
		    left: 0;
		    top: 0;

		  }
		  .heder-area{
		  	width: 100%;
		  	float: left;
		  }
		  .bill-from-area{
		  	width: 70%;
		  	float: left;
		  }
		  .logo-area{
		  	width: 20%;
		  	float: right;
		  	text-align: right;
		  	
		  }
		  #code{
		  	width: 100px !important;
		  	background: red !important;
		  }

			textarea{
				border:0px !important;
			}

		}

	</style>

@endsection


@section('content')

	<div class="row">
		<div class="col-12">
			<div class="text-right">
				<button onclick="window.print()" class="btn-admin btn-edit">Print</button>
			</div>
		</div>
	</div>
	
	<div class="row">

		<div class="col-12 col-lg-10 col-xl-8 offset-lg-1 offset-lx-2" id="section-to-print">

			<div class="heder-area p-2">
				<div class="bill-from-area" >
					<h3>{{Session::get('title')}}</h3>
					<p>{{Session::get('address')}}</p>
					<p>{{Session::get('phone')}}</p>
					<p>{{Session::get('email')}}</p>
				</div>
				<div class="logo-area">
					<img src="{{Storage::url(Session::get('logo'))}}" alt="{{Session::get('title')}}" />
				</div>
			</div>


			<div class="heder-area p-2 mt-4">
				<div class="bill-to-area" >

					<h3><b>BILL TO</b></h3>
					<h3>{{$order->billing->first_name}}</h3>
					<p>{{$order->emergency_phone}}</p>
					<p>{{$order->billing->address}}</p>
					<p>{{$order->billing->email}}</p>
					
				</div>
				<div class="invoice-details-area">
					<h3><b>Invoice Details</b></h3>
					<p><b>Invoice No:</b> {{$order->order_code}}</p>
					<p><b>Order Date:</b> {{ $order->created_at->format('j F, Y')}}</p>
					<p><b>Invoice Date:</b> {{ date('d-M-Y')}}</p>
				</div>
			</div>
			
	


			<div class=" table-responsive p-2">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th >Name</th>
							<th>Code</th>
							<th >Quantity</th>
							<th>Unit Cost</th>
							<th>Amount</th>
						</tr>
					</thead>

					<tbody>
						@php
							$i = 0;
							$total = 0;
						@endphp
						@foreach($products as $product)

						@php
							$i++;

							$amount =  ($product->price * $products_qty_array[$i-1]);

							$total += $amount;
						@endphp

						<tr>
							<td>{{$i}}</td>
							<td>{{$product->name}}</td>
							<td>BA-P-123</td>
							<td>{{$products_qty_array[$i-1]}}</td>
							<td>{{$product->price}} Tk</td>
							<td>{{ $amount}} Tk</td>
							
						</tr>



						@endforeach
						<tr>
							<td colspan="5"><b>Total</b></td>
							<td ><b>{{$total}}</b></td>
						</tr>
						
						<tr>
							<td colspan="5"><b>Shipping Cost</b></td>
							<td ><b>{{$order->shipping->shipping_cost}} Tk</b></td>
						</tr>


						<tr>
							@php
								$grand_total = $total + $order->shipping->shipping_cost;
							@endphp
							<td colspan="5"><b>Grant Total</b></td>
							<td ><b>{{$grand_total}} Tk</b></td>

						</tr>

						<tr>
							<td colspan="5"><b>Paid</b></td>
							<td ><b>{{$order->payment_cost}} Tk</b></td>
						</tr>

						<tr>
							<td colspan="5"><b>Due</b></td>
							<td ><b>{{$grand_total - $order->payment_cost}} Tk</b></td>
						</tr>

						
					</tbody>
				</table>
			</div>

			<div class="row">
				<div class="col-12">
					<label for=""><b>Some Note:</b></label>
					<textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
				</div>
			</div>


			<div class="signature">
				<h5 class="text-right mt-5" style="border-top: 1px solid black; display: inline-block; float: left; padding: 2px 30px">Receiver</h5>
				<h5 class="text-right mt-5" style="border-top: 1px solid black; display: inline-block; float: right; padding: 2px 30px">{{Session::get('title')}}</h5>
			</div>

		</div>


	</div>

@endsection

@section('footer-section')
	
	<script>
		
	</script>

@endsection