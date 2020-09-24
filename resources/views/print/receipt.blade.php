<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@lang('Receipt') {{ $receipt->id }}</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="{{ secure_asset('css/receipt.css') }}">
</head>
<body>
<div id="invoice">
	<div class="toolbar hidden-print">
		<div class="text-right">
			<button id="printInvoice" class="btn btn-info">
				<i class="fa fa-print"></i> @lang('Print')
			</button>
		</div>
		<hr>
	</div>
	<div class="invoice overflow-auto">
		<div style="min-width: 600px">
			<header>
				<div class="row">
					<div class="col">
						<a target="_blank" href="{{ config('app.url') }}">
							<img src="{{ secure_asset('storage/'.\Page::option('header')->logo) }}" data-holder-rendered="true" />
						</a>
					</div>
					<div class="col company-details">
						<h2 class="name">
							<a target="_blank" href="{{ config('app.url') }}">
								{{ config('app.name') }}
							</a>
						</h2>
						<div>@option('footer.address')</div>
						<div>@option('header.phone')</div>
						<div>@option('footer.email')</div>
					</div>
				</div>
			</header>
			<main>
				<div class="row contacts">
					<div class="col invoice-to">
						<div class="text-gray-light">@lang('Receipt for'):</div>
						<h2 class="to">{{ $receipt->client->name }}</h2>
						<div class="address">{{ $receipt->client->address }}</div>
						<div class="email"><a href="mailto:{{ $receipt->client->email }}">{{ $receipt->client->email }}</a></div>
					</div>
					<div class="col invoice-details">
						<h1 class="invoice-id">@lang('Receipt') {{ $receipt->id }}</h1>
						<div class="date">@lang('Date of receipt'): {{ $receipt->created_at }}</div>
					</div>
				</div>
				<table border="0" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th>#</th>
							<th class="text-left">@lang('Designation')</th>
							<th class="text-left">@lang('Brand')</th>
							<th class="text-right">@lang('Price')</th>
							<th class="text-right">@lang('Quantity')</th>
							<th class="text-right">@lang('Sum')</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($receipt->parts as $index => $part)
						<tr>
							<td class="no">{{ $index + 1 }}</td>
							<td class="text-left">
								<h3>{{ $part->title }}</h3>
								{{ $part->excerpt }} <br>
								@if($part->vehicles->isNotEmpty())
									@lang('Compatible with:') {{ $part->compatibility }}
								@endif
							</td>
							<td class="total">{{ $part->brand->name }}</td>
							<td class="unit">{{ $part->price }}</td>
							<td class="qty">{{ $part->pivot->quantity }}</td>
							<td class="total">{{ $part->price * $part->pivot->quantity }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						@if ($receipt->display_vat)
						<tr>
							<td colspan="2"></td>
							<td colspan="1"></td>
							<td colspan="2">@lang('Subtotal')</td>
							<td>{{ $receipt->subTotal }}</td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td colspan="1"></td>
							<td colspan="2">@lang('VAT') {{ $receipt->vat }}%</td>
							<td>{{ $receipt->vatValue }}</td>
						</tr>
						@endif
						<tr>
							<td colspan="2"></td>
							<td colspan="1"></td>
							<td colspan="2">@lang('Total')</td>
							<td>{{ $receipt->total }}</td>
						</tr>
					</tfoot>
				</table>
				<div class="thanks">@lang('Thank you!')</div>
				<div class="notices">
					<div>@lang('Notices'):</div>
					<div class="notice"></div>
				</div>
			</main>
			<footer>
				@lang('Invoice was created on a computer and is valid without the signature and seal.')
			</footer>
		</div>
		{{-- DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom --}}
		<div></div>
	</div>
</div>
<script src="{{ secure_asset('js/receipt.js') }}"></script>

</body>
</html>
